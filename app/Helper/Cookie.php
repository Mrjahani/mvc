<?php

namespace App\Helper;

class Cookie
{
    public function exists($field)
    {
        return array_key_exists($field , $_COOKIE);
    }//end method exists

    public function get($field)
    {
        return isset($_COOKIE[$field]) ? $_COOKIE[$field] : '';
    }//end get method

    public function set($key , $value , $time = '+30 day')
    {
        setcookie($key , $value , strtotime($time));
    }//edn set method

    public function forget($field)
    {
        setcookie($field , '' , strtotime('-5 day'));
    }//end forget method
}