<?php
namespace App\Helper;

class Session
{
    public function exists($field)
    {
        return array_key_exists($field , $_SESSION);
    }//end method exists

    public function get($field)
    {
        return isset($_SESSION[$field]) ? $_SESSION[$field] : '';
    }//end get method

    public function set($key , $value)
    {
        $_SESSION[$key] = $value;
    }//edn set method

    public function forget($field)
    {
        unset($_SESSION[$field]);
        session_destroy();
    }//end forget method
}