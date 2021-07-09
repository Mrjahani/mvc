<?php

namespace App\Controller\Api;

use App\Controller\Controller;
use App\Model\User;

class AuthController extends Controller
{

    public function register()
    {
        $ruleSet = [
            'username'=>'required|email',
            'password' => 'required|min:6'
        ];

        if ($this->validation(request()->api() , $ruleSet)){
            $user = (new User())->create([
                'username' => request('username'),
                'email' => request('email'),
                'password' => password_hash(request()->api('password') , PASSWORD_DEFAULT),
            ]);
            if ($user)
                $this->flash->success("user is success created");
            return true;
        }
    }//end register method


    public function login()
    {
        $ruleSet = [
            'username'=>'required|email|string',
            'password' => 'required|min:6|max:10'
        ];

        if ($this->validation(request()->api() , $ruleSet)){
            $user = (new User())->where('email',request()->api('username'))->first();
            if (!empty($user)){
                $check = password_verify(request()->api('password') , $user->password);

                if ($check)
                    $token = auth()->login($user  , "api");

                jsonResponse(['token'=>$token], 200);
            }
        }
    }//end login method

    public function logout()
    {
        auth()->logout('api');
        jsonResponse(['token'=>""], 200);

    }//end logout method
}