<?php

namespace App\Controllers;

use App\Validators\UserValidator;

class UserController
{
    public static function store($data)
    {
        $validate = new UserValidator($data);
        if ($validate) 
        {
            echo json_encode([
                "message" => "Bad data given"
            ]);
            http_response_code(400);
            die();
        }
        echo json_encode([
            "message" => "User created"
        ]);
        http_response_code(201);
        die();
    }
}