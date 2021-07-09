<?php
namespace App\Helper;

use App\Model\Model;

class Validation
{
    public $errors = [];
    public function validate($data , $ruleSet)
    {
        $validate = true;
        foreach($ruleSet as $key => $rules)
        {
            $rules = explode("|" , $rules);
            foreach($rules as $rule)
            {
                $methodName = "validate".ucfirst(strtolower($rule));
                $param = '';
                if ($pos = strpos($methodName , ":"))
                {
                    $param = substr($methodName , $pos+1);
                    $methodName = substr($methodName , 0,$pos);
                }
                $validate = $this->{$methodName}($data[$key] , $key , $param) && $validate;
            }
        }
        return $validate;
    }

    public function validateRequired($data , $label , $param)
    {
        if (mb_strlen($data) > 0)
            return true;
        $this->errors[$label][] = "$label is required";
        return false;
    }

    public function validateEmail($data , $label , $param)
    {
        if (filter_var($data , FILTER_VALIDATE_EMAIL))
            return true;
        $this->errors[$label][] = "$label is not validate";
        return false;
    }

    public function validateMin($data , $label , $param)
    {
        if (mb_strlen($data) > $param)
            return true;
        $this->errors[$label][] = "$label must be $param characters";
        return false;
    }

    public function validateUnique($data , $label , $param)
    {
        $db = new Model();
        $db->table = "users";
        $user = $db->where($label,$data)->first();
        if (!$user)
            return true;
        $this->errors[$label][] = "$label is not unique";
        return false;
    }

    public function validateMax($data , $label , $param)
    {
        if (mb_strlen($data) > $param){
            $this->errors[$label][] = "$label should not more $param characters";
            return false;
        }
        return true;
    }

    public function validateString($data , $label , $param)
    {
        if (is_string($data))
            return true;
        $this->errors[$label][] = "$label must be a string";
        return false;
    }//end validateString method

    public function getErrors()
    {
        return $this->errors;
    }

}