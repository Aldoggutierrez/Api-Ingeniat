<?php

namespace App;

use Routes\Routes;

class Request
{
    private $method;
    private $uri;
    private $resource;

    public function handle($request)
	{
        header( 'Content-Type: application/json' );
        $this->method = $request['REQUEST_METHOD'];
        $this->uri = $request['REQUEST_URI'];
        $this->validateUri();
        $this->validateMethod();
        call_user_func(array(new Routes(), $this->resource), $this->method,$_POST);
	}

    private function validateMethod()
    { 
        if (!in_array($this->method,Routes::$routes[$this->resource])) 
        {
            echo json_encode(['error' => "incorrect method $this->method"]);
            http_response_code(400);
            die();
        }
    }

    private function validateUri()
    {
        $uriData = explode('/',$this->uri);
        $this->resource = $uriData[2];
        if ($uriData[1] !== "api" || !array_key_exists($this->resource,Routes::$routes))
        {
            echo json_encode(['error' => ' endpoint does not exist ']);
            http_response_code(404);
            die();
        }
    }
}