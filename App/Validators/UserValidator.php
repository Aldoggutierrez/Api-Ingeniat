<?php

namespace App\Validators;

class UserValidator
{
    public function validate($data)
    {
        if (!$this->validateValues($data) && !$this->validateKey($data)) 
        {
            return false;
        }
        return true;
    }

    private function validateValues($data)
    {
        foreach ($data as $key => $value) 
        {
            if (empty($value))
            {
                echo"$key cant be null";
                return false;
            }
        }
        return true;
    }

    private function validateKey($data)
    {
        if (!array_key_exists('name',$data))
        {
            echo "name is required";
            return false;
        }
        if (!array_key_exists('last_name',$data))
        {
            echo "last_name is required";
            return false;
        }
        if (!array_key_exists('email',$data))
        {
            echo "email is required";
            return false;
        }
        if (!array_key_exists('password',$data))
        {
            echo "password is required";
            return false;
        }
        if (!array_key_exists('role',$data))
        {
            echo "role is required";
            return false;
        }
        return true;
    }
}