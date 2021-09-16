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


    public function user($id,$method,$json)
    {
        UserController::store($json);
    }

    public function login($id,$method,$json)
    {
        LoginController::store($json);
    }

    public function post($id,$method,$json,$token)
    {
        if ($method === 'POST') 
        {
            PostController::store($json,$token);
        }
        if ($method === 'PUT') 
        {
            var_dump($json);
            PostController::update($id,$json,$token);
        }
        if ($method === 'DELETE') 
        {
            PostController::destroy($id,$json,$token);
        }
        
    }

    public function posts($id,$method,$json,$token)
    {
        PostController::show($json,$token);
    }
}
