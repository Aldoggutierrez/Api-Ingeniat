<?php

namespace App\Validators;

class LoginValidator
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
        if (!array_key_exists('email',$data) || !array_key_exists('password',$data)) 
        {
            return false;   
        }
        return true;
    }
}