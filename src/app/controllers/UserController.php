<?php

use Phalcon\Mvc\Controller;

class UserController extends Controller
{
    public function indexAction()
    {

    }

    public function signupAction()
    {
        
    }

    public function registerAction()
    {
        $user = new Users();
        if($this->request->getPost())
        {
            print_r($this->request->getPost());
            echo "inside register actoion";
        
        $user->assign(
            $this->request->getPost(),
            [

                'name',
                'email'
            ]
        );

        $success = $user->save(); //storinbg into db
        $this->view->success = $success;    //passing result to view

        if ($success) {
            $this->view->message = "Register succesfully";
        } else {
            $this->view->message = "Not Register succesfully due to following reason: <br>" . implode("<br>", $user->getMessages());
        }

    }

    }
}
