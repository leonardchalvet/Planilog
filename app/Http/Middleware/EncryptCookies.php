<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    /**
     * The names of the cookies that should not be encrypted.
     * (Has be used for cookies defined in JS, not in Laravel)
     *
     * @var array
     */
    protected $except = [
        "cookies_policy"
    ];
}
