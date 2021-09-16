<?php

namespace App\Validators;

class PostValidator
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
        foreach ($data as $key => $value) {
            if (empty($value))
            {
                return false;
            }
        }
        return true;
    }

    private function validateKey($data)
    {
        if (!array_key_exists('title',$data) || !array_key_exists('description',$data)) 
        {
            return false;   
        }
        return true;
    }
}