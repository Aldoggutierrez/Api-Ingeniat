<?php

namespace Routes;

use App\Controllers\UserController;
use App\Controllers\LoginController;
use App\Controllers\PostController;
use App\Request;

class Routes
{ 
    public static $routes = [
        "user" => ['POST'],
        "login" => ['POST'],
        "post" => ['GET','POST','PUT','DELETE'],
    ];


    public function user(Request $request)
    {
        UserController::store($request->data);
    }

    public function login(Request $request)
    {
        LoginController::store($request->data);
    }

    public function post(Request $request)
    {
        if ($request->method === 'GET') PostController::show($request);
        if ($request->method === 'POST') PostController::store($request);
        if ($request->method === 'PUT') PostController::update($request);
        if ($request->method === 'DELETE') PostController::destroy($request);
    }
}
