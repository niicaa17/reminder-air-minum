<?php

use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

class Kernel
{

    protected $middlewareGroups = [
        'api' => [
            EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];
}