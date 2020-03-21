<?php
namespace App\Controller;

class Index
{
    public $view;

    public function indexAction()
    {
        //include "./App//Model/modelUser.php";
        $this->view->userModel = new \App\Model\modelUser();
        echo "<br/>IndexAction!!";
        //$user = new modelUser();
        //$user->setName('Dima');
    }

    public function userProfileAction()
    {
       // include "../modelUser.php";
        //$user = new modelUser();
        //$user->load($_GET['id']);
       // $this->view->user = $user;
    }
}