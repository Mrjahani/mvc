<?php

namespace App\Controller;

use App\Helper\Validation;
use app\view;
use http\Env\Response;
use League\Plates\Engine;
use Plasticbrain\FlashMessages\FlashMessages;

class Controller
{
    public $view;
    public $flash;
    public function __construct()
    {
        $this->view = new Engine(__DIR__."/../../views");
        $this->flash = new FlashMessages();
    }

    public function validation($data , $ruleSet)
    {
        $valid = new Validation();
        if (!request()->wantsJson()){
            if ($valid->validate($data,$ruleSet)){
                return true;
            }else{
                foreach ($valid->getErrors() as $error){
                    $this->flash->error($error[0]);
                }
                return false;
            }
        }else{
            $data = json_decode(file_get_contents('php://input'), true);
            if ($valid->validate($data,$ruleSet)){
                return true;
            }else{
                $list = [];
                foreach ($valid->getErrors() as $error){
                    $list[] = $error[0];
                }
                jsonResponse(['errors'=>$list] , 422);
            }
        }
    }

    public function render($viewpath , $data = null)
    {
        view::render($viewpath , $data);
    }


    public function check_csrf_token($request_csrf)
    {
        if (session('csrf') != $request_csrf){
            $this->flash->error("invalid csrf token");
            return false;
        }
        return true;
    }
}