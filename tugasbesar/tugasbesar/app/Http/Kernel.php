<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $routeMiddleware = [
    // Other middlewares
    'is_admin' => \App\Http\Middleware\CheckAdmin::class,
];

}

