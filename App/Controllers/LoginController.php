<?php

namespace App\Controllers;

use App\Validators\LoginValidator;
use Database\Conection;
use Firebase\JWT\JWT;
use Carbon\Carbon;

class LoginController
{
    
    public static function store($data)
    {
        $validate = new LoginValidator;
        if (!$validate->validate($data)) 
        {
            echo json_encode([
                "message" => "Bad data given"
            ]);
            http_response_code(400);
            die();
        }

        $dbConnection = new Conection;
        $result = $dbConnection->query("SELECT * FROM users WHERE email='$data[email]'");
        if ($dbConnection->getNumberOfResults($result))
        {
            $user = $result->fetch_array( MYSQLI_ASSOC);

            if (password_verify($data['password'],$user['password'])) 
            {
                
                $timestamp = date_timestamp_get(Carbon::now()->addHour());
                $privateKey = <<<EOD
                -----BEGIN RSA PRIVATE KEY-----
                MIIJJwIBAAKCAgEAw3RH2E5qS4ourZ/vawqpNuksQ0odSTaw4yeCpuqUQFgbv6To
                /bzft7tGpyE5h/oKe4KiJixuMBobR5s2CXR+JKtP+2/kKO7yvMPycEK21cNugBy5
                8zQINHddWfp0oyVxsUr2vL/DEJ9A8KMC05UsyyLZQHVrSRS49D9d0pECZCJYUYjw
                eJBqm6RObn8XJK8K88nlFxxFcnFdqfb1H3rQvdXzdr4ftO1Hpw7MowfUk/MXCEHP
                9OmSPOEF6Wo6XH1dnE0vs6i6F+z55Qt0qOkGOo+Ic5UmIew3fUBIcE6xtpQwTa/Z
                KG+sseho1H7CTbs9Fw/Y6T1noKLvLAXI/PUoYVdvkab7K3ijWVwfq5U4GpVdlCxG
                eX67wl7++UeYVUnUEsm6q9TtTAcgaZKQNSd3+f5p+pl05BgcnVQ0uZvlPE5IaP4z
                ZlS8iImrTKJ8JZn3Bi4o02jVdsVr4kRYhFb4PJGExIFbrRCDjnq6dFFKY0l0x7gZ
                WcmDGsPjhR/GAKKvtQ0zLJtb75Ex4Ks56tL5uboB9Yu196e7Xx4ttoYSjGvShRSV
                p6h7C8G+cl5Wd1++fHbn+WmcdOhPPNZP7alVA8wTPUOln7BVwBc1zfckOMmpxkOL
                iAvAtnrE+onybPoMShki7v5iBqRooRB7IqI2j4POCFJL2UQAEI+GLSmkeAECAwEA
                AQKCAgAc6TBPYJn8fn4VFJk3fiY1hxwS//2A/OQBVbDPu9ceBWplWKFWFwAIj10O
                D64Q3P1784DEoMHTv6jVWLIPh/m4ttZn3M8k9uNU5K8Rx+x/hh7sOFORE9s614Up
                cBCcqUc98Fa66KqT5NqYPaSHY4NysL7t9/BcqQIKruzT3rs50JK7zMO1MbdzOkSX
                t5jWxkWadfy7BGWJXhd6sprjgykpS2Jt6AWMn6R/o4LFgr0A/W4kvIdkNMB63NYh
                BqOHVsvn+MrbilOsglMcfCtPaNiRBPYsEp3HWseCcWXFpv5GgXj7pM08W/hxgG0x
                MWbQVKfep2twZLLVYgR6wIhQUnscWF8FQ2LlGxb0bGvshnWfDqnoiLRf14HNC2pJ
                dx++U+5fxvAdmDGHpTBeO5VzdnIkIUO/R/u8LWt8K/Ldt1iYMsZ8pB4SK3oXn/dJ
                Vnt3bekZDH89mEO484HZCP1Is6Mm3cDkE7z77AhG7ViNHoor1UV5RW1UyIWVMTf2
                LaTwd68HmD1WkyuYOkJLwlmp4AbCKNdIy/c8a6kr+8R+BzcDR9e/Tlv3tP7tihGI
                Hrdif8Kf/BFpmgjbdynU1gaPy13nbhDZpwcs/yw6AVbKGt6OrThC4ev9Jxqfw7hQ
                Wb+4cZZVxPsuUncxO+VB/obKpkBChjjCVzj3i+FIzpmMvXmUoQKCAQEA+XIlarQE
                G2pd/9DMrSZPezo7NzGRsZH9lgl+xxLhwsgOH+CRiI/JbAU4TwWIHPvK365dOquF
                TyHN8vCCK6JQKFw1fZSTG+MLZ8J37sg0kEsxff12lwsWopBa9xL6dPtW+bsg8ytE
                mEafU5MxhQDaYoD2Z41hZqSLXu3COagdEzNXEk66fSftNsPdfdsVzicmNos63dN6
                SvW1CJtThQs9WFernLKV34OJ2E2XYnckuvpAsDmOZLsE1dOjRIHDhmhYO6J2fYaK    
                mwWH/zBfYyZ3StkADyzsYOastrDOZWkZXfBkqJ++DJqiBhkVQNHXKWyk+5kcftPL
                5hZz3iy1N3iV/QKCAQEAyJb4FPqBJu0Lie6dWf14zpXfx+ZcKJjuotfg0pDSPEsk
                KPu7ibU9+otxLDSO1TQ7tLvqzk66EuDjXAKgsg/p/9L4cB96SqRGGLIGrBN9BGAs
                Nxto3+kVGs7xpslgPUISnwemSQZSk7J6R9w/6sfp/jW3x9ez/j6xcIyRQxi1wJ49
                yA7+fW0ej5oPhObu9bNN3A0bPzvltBaJDKIhoBVYS9xD1ldr+Dh1DR3FRRax5M2J
                L7Ift8HC4y2XJM8DsCm0YqQ6EyiJKfwoUDJXIv/8cbE9gu/ggsUnH2VZWgmPJuOp
                /I5NDU8V8kaEebVpVpe4ZZQHPPYNIhpKWvxRd//HVQKCAQBpC//j2qFsJjQlufmn
                5V1NaK1tReu0GuXu3FrOXQ5D59nC5OCE4QCTA/O9m3fBtOuvnQ9X2MmQFI1VhKFc
                3MLi7En+c6Yr9UZlUMkO/rLcHT5fb3EUlK/Yj/Au4ogk4X+0NXDf1tXRRtRr7q3I
                9B4Do4mg/DILdrnWpUvI2ho8br95TzxL3peQG5XYHX4mTehSyfllV1zF2ol9cWQP
                wDb6UBlOKQrikNNpCuv4pHIMZ7z8OZDUrMmRfsnf3MHJhYG6w2Ug4ZrXQ9IMzoMt
                DxLnq1DSEzoMaLhNS1Hv9P2gyM6rEHKJfklDRibkIDp7EGy+I7GTW4Afik8LPkqm
                bJrFAoIBAFMLDVHCE84FvQ0xmDs1UNpV+ftMR0MXbVRFg3IpOqBzi1jcPtvYCPy8
                1fGzIJ7rrPw6AA/BUA+YwwfInraZGAstUGU64uob8Fkw+soql0tEdYmq81QfrvkW
                S7z9CbbSr9re09zPnUhAT5eIe327ngf8PUWi64WKdvNdfpYEmNpRqMo2Su2qS0iw
                Q1SGNs/Jl6ZOVsVrCsHvwnVUeg9IRvHBEuSd9LkixnLTrGPZ7XQIE4+HctIkiYZ7
                zWMTwTchTOi5jMF5uq+DET2CWcjHqb933TtkC9KXxIae8srvwjAbeLhyQTwNTcyr
                nRS2IhITZefHzOdUBkPkFnxskV3YqrECggEAW19ZJRC9/9+VZSyfqNlTElvW6sVq
                h3uMsIuVNWdaZP6sGzsysXtLn1qR/tLO+6nk8ESyHteLTZlYjzJp8TCyRkEmish3
                N1gkQhLAIBRPHjqfR9RnqC1W2fXHzin4npBlWRROsWqDO7oBdW+2qKqTZvNLgJAr
                mdHa/Jx5w2ZvCyr15MkRZPnrZZ9ZMqoSj4rqpPzhHQa8NdzYril13uQ2G1UnbaY4
                Tg3ZWoEb8ZCrCKdIOrkFhhFTky5KZo/zmNqQ7FYsvW7NYVuUtT17Ta5Iwhp/0ZjZ
                SmljJhfubt9x9jWprvY/suXwRmSz1oaZfzFa19fZ6bE406WR4In3rZ6tBQ==
                -----END RSA PRIVATE KEY-----
                EOD;
                $payload = [
                    "id" => $user['id'],
                    "name" => $user['name'],
                    "role" => $user['role'],
                    "expire" => $timestamp
                ];

                $token = JWT::encode($payload,$privateKey,'RS256');
                echo json_encode([
                    "message" => "succesful login",
                    "TOKEN" => $token
                ]);
                http_response_code(200);
                die();
            }

            echo json_encode([
                "message" => "Inocorrect password"
            ]);
            http_response_code(403);
            die();
        }
        
        echo json_encode([
            "message" => "User does not exist"
        ]);
        http_response_code(400);
        die();
        
    }
}