<?php

namespace App\Controllers;

use App\Validators\PostValidator;

class PostController
{
    public static function show()
    {
        echo "hola desde PostController store";
    }

    public static function store($data)
    {
        $validate = new PostValidator($data);
        if ($validate) 
        {
            echo json_encode([
                "message" => "Bad data given"
            ]);
            http_response_code(400);
            die();
        }
        echo json_encode([
            "message" => "Post created"
        ]);
        http_response_code(201);
        die();
    }

    public static function update()
    {
        echo "hola desde PostController update";
    }

    public static function destroy()
    {
        echo "hola desde PostController destroy";
    }
}