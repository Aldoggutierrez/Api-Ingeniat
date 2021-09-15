<?php

namespace Routes;

use App\Controllers\UserController;

class Routes
{ 
    public static $routes = [
        "users" => ['GET'],
        "user" => ['GET','POST','PUT','DELETE']
    ];
}
