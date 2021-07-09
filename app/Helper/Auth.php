<?php

namespace App\Helper;

use App\Model\User;

class Auth
{
    public function login($user , $guard = "web" , $remember = null)
    {
        if ($guard == "web"){
           session()->set('email' , $user->email);
           if ($remember == true){
               $random = generateRandom(240);
               (new User())->update($user->id , [
                   'remember_token'=> $random,
               ]);
               cookie()->set('remember_token' , $random);
           }
           return true;
        }elseif($guard == "api")
        {
            $random = generateRandom(200);
            (new User())->update($user->id,[
                'api_token'=>$random,
            ]);
            return $random;
        }
    }//end login method

    public function check($guard = "web")
    {
        if ($guard == "web") {
            if (session()->exists('email')) {
                $user = (new User())->where('email', session('email'))->first();
                if ($user) {
                    return true;
                }
                session()->forget('email');
            }
            if (cookie()->exists('remember_token')) {
                $user = (new User())->where('remember_token', cookie('remember_token'))->first();
                if ($user) {
                    session()->set('email', $user->email);
                    return true;
                }
                cookie()->forget('remember_token');
                return false;
            }
            return false;
        } elseif ($guard == "api"){
            if (!empty($_SERVER['HTTP_AUTHORIZATION'])){
                $user_token = (new User())->where('api_token', $_SERVER['HTTP_AUTHORIZATION'])->first();
                if($user_token){
                    return true;
                }
            }
            return false;
        }//end check guard condition
    }//end check method

    public function user($guard = "web")
    {
        if ($guard == "web"){
            if (session()->exists('email')) {
                $user = (new User())->where('email',session('email'))->first();
                if (!is_null($user))
                    return $user;
                return false;
            }
            return false;
        }elseif($guard == "api"){
            if (!empty($_SERVER['HTTP_AUTHORIZATION'])){
                $user_token = (new User())->where('api_token', $_SERVER['HTTP_AUTHORIZATION'])->first();
                if(!is_null($user_token)){
                    return $user_token;
                }
            }
            return false;
        }//end check guard condition
    }//end user method

    public function logout($guard = "web")
    {
        if ($guard == "web") {
            if (cookie()->exists('remember_token')) {
                cookie()->forget('remember_token');
            }
            session()->forget('email');
        }elseif ($guard == "api"){
            $user_token = (new User())->where('api_token', $_SERVER['HTTP_AUTHORIZATION'])->first();
            if(!is_null($user_token) && $user_token != false){
                (new User())->update($user_token->id,[
                    'api_token'=>null,
                ]);
            }
            return null;
        }
    }//end logout method
}