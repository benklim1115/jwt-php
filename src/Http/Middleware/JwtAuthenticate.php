<?php

declare(strict_types= 1);

namespace App\Http\Middleware;

use App\Http\Response;
use App\Http\Request;


class JwtAuthenticate implements MiddlewareInterface{

    public function process(Request $request, RequestHandlerInterface $handler): Response {
        //implement process() method
        
    }

}