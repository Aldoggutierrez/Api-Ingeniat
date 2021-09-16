<?php

namespace App\Controllers;

use App\Validators\UserValidator;
use Database\Conection;

class UserController
{
    public static function store($data)
    {
        $validate = new UserValidator();
        if (!$validate->validate($data)) 
        {
            echo json_encode([
                "message" => "Bad data given"
            ]);
            http_response_code(400);
            die();
        }
        $data['password'] =  password_hash($data['password'],PASSWORD_BCRYPT);

        $dbConnection = new Conection;

        $success = $dbConnection->query("INSERT INTO users (name , last_name , email , password , role) 
        VALUES ('$data[name]','$data[last_name]','$data[email]','$data[password]','$data[role]');");

        if ($success) 
        {
            echo json_encode([
                "message" => "User created"
            ]);
            http_response_code(201);
            die();
        }

        echo json_encode([
            "message" => "Error user not created". $dbConnection->getErrror()
        ]);
        $dbConnection->closeConection();
        http_response_code(500);
        die();

        
    }
}