<?php
namespace App\Controller;
echo "<br/>class User include";
class User
{
    public $view;

    public function loginAction()
    {
        echo "<br/>LoginAction!!";
        //include "../modelUser.php";
        //$user = new modelUser();
        //$user->setName('Dima');
    }
}