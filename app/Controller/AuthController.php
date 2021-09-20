<?php

namespace App\Controller;

use App\Model\User;

class AuthController extends Controller
{
    public function registerPage()
    {
        echo $this->view->render('auth/register');
    }
    public function register()
    {
        if ($this->check_csrf_token(request('_csrf'))) {
            $ruleSet = [
                'username'=>'required|email',
                'password' => 'required|min:6'
            ];

            if ($this->validation(request()->all() , $ruleSet)){
                $user = (new User())->create([
                    'username' => request('username'),
                    'email' => request('email'),
                    'password' => password_hash(request('password') , PASSWORD_DEFAULT),
                ]);
                if ($user)
                    $this->flash->success("user is success created");
                return true;
            }
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function loginPage()
    {
//        $this->render('auth.login');
        echo $this->view->render('auth/login');
    }

    public function login()
    {
        if ($this->check_csrf_token(request('_csrf'))) {
            $ruleSet = [
                'username'=>'required|email|string',
                'password' => 'required|min:6|max:10'
            ];
            if (!is_null(request()->all())) {

                if ($this->validation(request()->all() , $ruleSet)){
                    $user = (new User())->where('email',request('username'))->first();

                    if (!empty($user)){
                        $check = password_verify(request('password') , $user->password);
                        if ($check)
                            auth()->login($user , "web" , true);
                    }
                }
            }
        }
       header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}