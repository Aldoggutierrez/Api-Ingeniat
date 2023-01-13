<?php

namespace App;

use Routes\Routes;

class Request
{
    public $method;
    public $uri;
    public $resource;
    public $id;
    public $data;
    public $token;

    public function handle($request)
    {
        $this->method = $request['REQUEST_METHOD'];
        $this->uri = $request['REQUEST_URI'];
        $this->validateUri();
        $this->validateMethod();
        $this->setData();
        $this->getToken($request['HTTP_AUTHORIZATION']);
        call_user_func(array(new Routes(), $this->resource), $this);
    }

    private function validateMethod()
    {
        if (!in_array($this->method, Routes::$routes[$this->resource])) {
            header('Content-Type: application/json');
            http_response_code(400);
            return json_encode(['error' => "incorrect method $this->method"]);
        }
    }

    private function validateUri()
    {
        $uriData = explode('/', $this->uri);
        $this->resource = $uriData[2];
        $this->id = $uriData[3];
        if ($uriData[1] !== "api" || !array_key_exists($this->resource, Routes::$routes)) {
            header('Content-Type: application/json');
            http_response_code(404);
            return json_encode(['error' => 'endpoint does not exist']);
        }
    }
    private function getToken()
    {
        if (preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
            if (!is_null($matches[1])) {
                $this->token = $matches[1];
                return;
            }
        }

        header('Content-Type: application/json');
        http_response_code(400);
        return json_encode(['error' => ' Token not found']);
    }
    private function setData()
    {
        if ($this->method === 'PUT') parse_str(file_get_contents('php://input'), $this->data);
        if ($this->method === 'GET') $this->data = $_GET;
        if ($this->method === 'POST') $this->data = $_POST;
    }
}
