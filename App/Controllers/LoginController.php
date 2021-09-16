<?php

namespace App\Controllers;

class LoginController
{
    
    public static function store($data)
    {
        echo json_encode([
            "message" => "Access granted"
        ]);
        http_response_code(200);
        die();
    }
}