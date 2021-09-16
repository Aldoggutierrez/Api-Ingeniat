<?php

namespace Routes;

use App\Controllers\UserController;
use App\Controllers\LoginController;
use App\Controllers\PostController;

class Routes
{ 
    public static $routes = [
        "user" => ['POST'],
        "login" => ['POST'],
        "post" => ['POST','PUT','DELETE'],
        "posts" => ['GET'],
    ];


    public function user($method,$json)
    {
        UserController::store($json);
    }

    public function login($method,$json)
    {
        LoginController::store($json);
    }

    public function post($method,$json)
    {
        if ($method === 'POST') 
        {
            PostController::store($json);
        }
        if ($method === 'PUT') 
        {
            PostController::update();
        }
        if ($method === 'DELETE') 
        {
            PostController::destroy();
        }
        
    }

    public function posts($method,$json)
    {
        PostController::show();
    }
}
