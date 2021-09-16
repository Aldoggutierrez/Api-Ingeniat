<?php

namespace App;

use Routes\Routes;

class Request
{
    private $method;
    private $uri;
    private $resource;
    private $id;

    public function handle($request)
	{
        header( 'Content-Type: application/json' );
        $this->method = $request['REQUEST_METHOD'];
        $this->uri = $request['REQUEST_URI'];
        $this->validateUri();
        $this->validateMethod();
        $token = $this->getToken($request['HTTP_AUTHORIZATION']);
        if( $this->method === 'PUT')
        {
            parse_str(file_get_contents('php://input'),$put_vars);
            $_POST =$put_vars;
        }
        call_user_func(array(new Routes(), $this->resource),$this->id, $this->method,$_POST,$token);
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
        $this->id = $uriData[3];
        if ($uriData[1] !== "api" || !array_key_exists($this->resource,Routes::$routes))
        {
            echo json_encode(['error' => 'endpoint does not exist']);
            http_response_code(404);
            die();
        }
    }
    private function getToken()
    {
        if (! preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) 
        {
            echo json_encode(['error' => 'Token not found in request']);
            http_response_code(400);
            die();
        }
        $token = $matches[1];
        if (!$token) 
        {
            echo json_encode(['error' => ' Token not found']);
            http_response_code(400);
            die();    
        }
        return $token;
    }
}