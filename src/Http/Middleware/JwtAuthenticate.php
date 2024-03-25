<?php

declare(strict_types= 1);

namespace App\Http\Middleware;

use App\Http\Response;
use App\Http\Request;


class JwtAuthenticate implements MiddlewareInterface{

    //constructor
    public function __construct(private string $jwtSecretKey) {
        
    }


    public function process(Request $request, RequestHandlerInterface $handler): Response {
       
        //Get the Authorization header
        $authHeader = $request->getServerVariable("HTTP_AUTHORIZATION");

        //Return failed auth if missing


        //Isolate the token (remove Bearer)


        //Try to decode
        //Do what you want with claims then pass back to RequestHandler if possible
        //catch whatever exceptions you wanna handle individually

        
    }

}