<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller; // DO NOT REMOVE!
use Illuminate\Support\Facades\Log;

class GitController extends Controller
{

    public function githubWebhook()
    {
        app('debugbar')->disable();

        // test :
        //curl -i -X POST -H 'Content-Type: application/json' -d '{"toto": "tata"}' http://planilog.local/git-webhook
        $data = json_decode(file_get_contents('php://input'), true);

        //$dir = dirname(__FILE__)."/../../../";
        $dir = "/homez.254/planilogml/planilog";

        $ref = $data["ref"] ?? "none";
        if ($ref != "refs/heads/master") {
            return response($data, 200);
        }

        $res = "init...";

        $cmd = "cd $dir && ./gitwebhook2.sh";

        /*
        //$php="/usr/local/php7.2/bin/php"; // OVH
        $php="/usr/local/bin/php";  // local
        $git="/usr/bin/git";
        $cmd .= " && $php artisan env";
        $cmd .= " && $php artisan down";             // Mode maintenance
        $cmd .= " && $git pull";                     // mise à jour des sources
        $cmd .= " && $php artisan cache:clear";
        //$cmd .= " && $php artisan config:cache";
        //$cmd .= " && php artisan route:cache";
        //$cmd .= " && $php artisan view:cache";
        //$cmd .= " && $php artisan up";               // Mode live
        */

        $res .= shell_exec($cmd);

        // Check si tout s'est bien passé

        if (file_exists(storage_path('framework').'/down')) {
            Log::channel('slack')->critical(
                  "*ATTENTION, UNE ERREUR EST SURVENUE LORS DU DEPLOIEMENT !*\n"
                . "Une fois l'erreur corrigée, remettre en ligne le site avec\n"
                . "```php artisan up```");
        }
        else {
            Log::channel('slack')->info("auto déploiement terminé.");
        }
        echo $cmd.PHP_EOL;
        echo $res.PHP_EOL;

        return response($res, 200);

    }
}
