<?php

/**
 * Class DashboardController
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
namespace Mini\Controller;
use Mini\Model\Login;
class LoginController
{
    public function index()
    {
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/login/index.php';
        require APP . 'view/_templates/footer.php';
        $Login = new Login();
        $Login->authenticate('abc', 'abc');
    }

}
