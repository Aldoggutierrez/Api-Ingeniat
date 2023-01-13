<?php

namespace App\Controllers;

use App\Validators\PostValidator;
use Database\Conection;
use App\TokenDecoder;
use App\Request;


class PostController
{
    public static function show(Request $request)
    {
        $payload = TokenDecoder::decodeToken($request->token);
        if ($payload['role'] === 'medio' || $payload['role'] === 'alto medio' || $payload['role'] === 'alto') 
        {
            $dbConnection = new Conection;
            $result = $dbConnection->query("SELECT title,description,created_at,created_by,creator_role 
            FROM posts WHERE active=1;");
            if ($dbConnection->getNumberOfResults($result) > 0)
            {
                $posts = $result->fetch_all(MYSQLI_ASSOC);
                var_dump($posts);
                //echo json_encode([
                //    "posts" => $posts
                //]);
                $dbConnection->closeConection();
                http_response_code(200);
                die();
            }
            echo json_encode([
                "message" => "There are no posts"
            ]);
            $dbConnection->closeConection();
            http_response_code(200);
            die();
        }

        echo json_encode([
            "message" => "You don't have permission to acces the posts"
        ]);
        http_response_code(403);
        die();
    }

    public static function store($data,$token)
    {
        if (empty($token))
        {
            echo json_encode([
                "message" => "Invalid token"
            ]);
            http_response_code(403);
        }
        $validate = new PostValidator($data);
        if (!$validate->validate($data)) 
        {
            echo json_encode([
                "message" => "Bad data given"
            ]);
            http_response_code(400);
            die();
        }

        $payload = TokenDecoder::decodeToken($token);

        if ($payload['role'] === 'medio alto' || $payload['role'] === 'alto medio' || $payload['role'] === 'alto') 
        {
            $dbConnection = new Conection;
            $success = $dbConnection->query("INSERT INTO posts (title , description , created_by , creator_role , 
            created_at) VALUES ('$data[title]','$data[description]','$payload[name]','$payload[role]',NOW()); ");
            
            if ($success)
            {
                echo json_encode([
                    "message" => "Post created"
                ]);
                $dbConnection->closeConection();
                http_response_code(201);
                die();
            }

            echo json_encode([
                "message" => "Error post not created",
                "errors" => $dbConnection->getErrror()
            ]);
            $dbConnection->closeConection();
            http_response_code(500);
            die();
        }

        echo json_encode([
            "message" => "You don't have the permission to add new posts"
        ]);
        http_response_code(403);
        die();
    }

    public static function update($id,$data,$token)
    {
        if (empty($token))
        {
            echo json_encode([
                "message" => "Invalid token"
            ]);
            http_response_code(403);
        }
        $validate = new PostValidator($data);
        if (!$validate->validate($data)) 
        {
            echo json_encode([
                "message" => "Bad data given"
            ]);
            http_response_code(400);
            die();
        }
        var_dump($data);

        $payload = TokenDecoder::decodeToken($token);

        if ($payload['role'] === 'alto medio' || $payload['role'] === 'alto') 
        {
            $dbConnection = new Conection;
            $success = $dbConnection->query("UPDATE posts SET title='$data[title]' ,
            description='$data[description]' WHERE id='$id' ");
            if ($success)
            {
                echo json_encode([
                    "message" => "Post updated"
                ]);
                $dbConnection->closeConection();
                http_response_code(200);
                die();
            }
            echo json_encode([
                "message" => "Error post not updated",
                "errors" => $dbConnection->getErrror()
            ]);
            $dbConnection->closeConection();
            http_response_code(500);
            die();
        }

        echo json_encode([
            "message" => "You don't have the permission to edit posts"
        ]);
        http_response_code(403);
        die();
    }

    public static function destroy($id,$data,$token)
    {
        if (empty($token))
        {
            echo json_encode([
                "message" => "Invalid token"
            ]);
            http_response_code(403);
        }
        $payload = TokenDecoder::decodeToken($token);

        if ($payload['role'] === 'alto')
        {
            $dbConnection = new Conection;
            $success = $dbConnection->query("UPDATE posts SET active=0 WHERE id='$id' ");
            if ($success)
            {
                echo json_encode([
                    "message" => "Post deleted"
                ]);
                $dbConnection->closeConection();
                http_response_code(200);
                die();
            }
            echo json_encode([
                "message" => "Error post not deleted",
                "errors" => $dbConnection->getErrror()
            ]);
            $dbConnection->closeConection();
            http_response_code(500);
            die();
        }
        echo json_encode([
            "message" => "You don't have the permission to delete posts"
        ]);
        http_response_code(403);
        die();
    }
}