<?php

namespace app\Controller\Api;

use App\Controller\Controller;
use App\Model\User;

class UserController extends Controller
{
    public $user_repository;


    public function index()
    {
        if (auth()->check('api')) {
            $user = new User();
            $users = $user->all();
            return jsonResponse(['users'=> $users] , 200);
        }else {
            jsonResponse(['errors'=>'unauthorized'], 401);
        }
    }

    public function user()
    {
        if (auth()->check('api')) {
            if (request()->wantsJson())
                jsonResponse(['user'=>auth()->user('api')],200);
        }else {
            jsonResponse(['errors'=>'unauthorized'], 401);
        }
    }
}