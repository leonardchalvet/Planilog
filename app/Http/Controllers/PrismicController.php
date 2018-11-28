<?php

namespace app\Http\Controllers;

use App\Http\Controllers\Controller;  // DO NOT REMOVE!
use App\Http\Services\PrismicContentProvider;
use App\Http\Services\PrismicLinkResolver as PrismicLinkResolver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Prismic\Api;
use Prismic\LinkResolver;
use Prismic\Predicates;
use Barryvdh\Debugbar\Facade as Debugbar;
use ResourceBundle;


class PrismicController extends Controller
{
    /** @var PrismicContentProvider */
    private $contentProvider;
    private $linkResolver;
    private $api;


    public function __construct(PrismicContentProvider $contentProvider, PrismicLinkResolver $linkResolver)
    {
        $this->contentProvider = $contentProvider;
        $this->linkResolver = $linkResolver;
        $this->locale = config('laravellocalization.prismic_locales')[LaravelLocalization::getCurrentLocale()];
        $this->api = Api::get(env('PRISMIC_API'));

    }

    /**
     * Generic page is used when there is no subdocument in the page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function genericPage(Request $request)
    {
        // Get asked page
        $page = $request->route()->action['page'];

        $document = $this->contentProvider->getSimplePage($page, $this->locale);

        if ($request->has("debug")) dd($document);

        return view($page, [
            'doc' => $document
        ]);
    }

    /**
     * Feature page
     * @param Request $request
     * @param string $type
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function genericTypePage(Request $request, string $type, string $slug)
    {
        $document = $this->contentProvider->getSimpleType($type, $slug);

        if ($request->has("debug")) dd($document);

        return view('repeatable_'.$type, [
            'doc' => $document
        ]);
    }
    public function client(Request $request, string $slug)
    {
        return $this->genericTypePage($request, 'client', $slug);
    }

    public function fonctionnalite(Request $request, string $slug)
    {
        return $this->genericTypePage($request, 'feature', $slug);
    }

    public function domaine(Request $request, string $slug)
    {
        $document = $this->contentProvider->getSimpleType('domaine', $slug);


        // Get business case
        $case = null;
        if ($document->business_case_button_link->link_type != "Any") {
            $uid = $document->business_case_button_link->uid;
            $case = $this->contentProvider->getSimpleType('client', $uid);
        }

        if ($request->has("debug")) dd($document, $case);

        return view('repeatable_domaine', [
            'doc' => $document,
            'case' => $case
        ]);

    }


    /**
     * Action for Prismic preview
     * - Get token from Prismic
     * - Set cookie so that next api call to this document will retrieve draft version instead of published version
     * - Redirect to the document
     * @param Request $request
     * @return redirect to preview page
     */
    public function preview(Request $request)
    {
        $token = $request->input('token');
        $url = $this->contentProvider->getPreviewUrl($token);
        return response(null, 302)->header('Location', $url);
    }

}

