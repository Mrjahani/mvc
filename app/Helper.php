<?php

function dd()
{
    echo "<pre>";
    $fields = func_get_args();
    foreach ($fields as $field) {
        var_dump($field);
    }
    echo "</pre>";
    die();
}//end dd function

function session($field = null)
{
    $session = new \App\Helper\Session();
    if (is_null($field))
        return $session;
    return $session->get($field);
}//end session function

function cookie($field = null)
{
    $cookie = new \App\Helper\Cookie();
    if (is_null($field))
        return $cookie;
    return $cookie->get($field);
}//end cookie function

function request($field = null)
{
    $request = new \App\Helper\Request();
    if (is_null($field))
        return $request;
    return $request->input($field);
}// end request function


function jsonResponse($values, $status = 200)
{
    header("Content-Type:application/json", true, $status);
    $out = [];
    foreach ($values as $key => $value) {
        $out [][$key] = $value;
    }
    echo json_encode($out);
}


function cache($name , $value ,$time)
{
    $redis = new \Predis\Client();
    if ($redis->exists($name) && !is_null($redis->get($name))){
        return unserialize($redis->get($name));
    }
    $redis->setex($name , 60 * $time , serialize($value));
    return $value;
}// end cache function


function generateRandom($length = 100)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
} // end generateRandom function


function auth()
{
    $auth = new \App\Helper\Auth();
    return $auth;
}//end auth function


function csrf_token()
{
    $token = bin2hex(random_bytes(30));
    session()->set('csrf' , $token);
    return "<input type='hidden' name='_csrf' value=". $token . ">";
}//edn csrf_token function


function asset($dir)
{
    return $_SERVER['HTTP_HOST'] . DIRECTORY_SEPARATOR . $dir;
}//end asset function