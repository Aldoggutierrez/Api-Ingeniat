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


    public function user()
    {
        UserController::store();
    }

    public function login()
    {
        LoginController::store();
    }

    public function post($method)
    {
        if ($method === 'POST') 
        {
            PostController::store();
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

    public function posts()
    {
        PostController::show();
    }
}
