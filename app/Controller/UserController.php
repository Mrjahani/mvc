<?php
namespace App\Controller;

use App\Model\User;

class UserController extends Controller
{

    public function index()
    {
        $user = new User();
        $users = $user->select()->all();
        cache('users' , $users , 30);
        echo $this->view->render("home" , compact('users'));

//        $this->render('home',compact('users'));
    }

    public function home()
    {
        var_dump("welcome to home page");
    }


}