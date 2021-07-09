<?php
namespace App\Helper;

class Request
{
    public function input($field)
    {
        if ($this->isPost())
            return isset($_POST[$field]) ? htmlspecialchars($_POST[$field]) : '';

        return isset($_GET[$field]) ? htmlspecialchars($_GET[$field]) : '';
    }//end input method

    public function isGet($field)
    {
        return isset($_GET[$field]) ? htmlspecialchars($_GET[$field]) : '';
    }//end isGet method

    public function all()
    {
        if ($this->isPost())
            return isset($_POST) ? array_map('htmlspecialchars' , $_POST): null;

        return isset($_GET) ? array_map('htmlspecialchars' , $_GET): null;
    }//end all method

    public function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] == "POST";
    }//end isPost method

    public function wantsJson()
    {
        return $_SERVER['HTTP_ACCEPT'] == "application/json";
    }//end wantsJson method

    public function api($field = null)
    {
        $request_api = json_decode(file_get_contents("php://input"),true);
        if (is_null($field))
            return isset($request_api) ? array_map('htmlspecialchars',$request_api) : null;

        return isset($request_api[$field]) ? htmlspecialchars($request_api[$field]) : '';
    }//end api method
}