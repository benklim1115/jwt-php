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
        if(!$authHeader) {
            return new Response(
                "Auth token missing",
                401,
                ["WWW-Authenticate" => "Bearer error='missing_token'"]
            );
        }

        //Isolate the token (remove Bearer)
        $token = preg_replace("/^Bearer\s*/", "", $authHeader);

        //Try to decode
        try{
            $decoded = JWT::decode($token, new Key($this->jwtSecretKey, "HS256"));
            //Do what you want with claims then pass back to RequestHandler if possible
            return $handler->handle($request);
        } catch(ExpiredException) {
            //catch whatever exceptions you wanna handle individually
            return new Response("Auth token has expired", 401, ["WWW-Authenticate" => "Bearer error='missing_token'"]);
        } catch(\UnexpectedValueException|\DomainException) {
            return new Response("Auth token is invalid", 401, ["WWW-Authenticate" => "Bearer error='invalid_token'"]);
        }
        


        
    }

}