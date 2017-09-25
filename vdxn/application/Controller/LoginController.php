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
    }
    public function submitForm()
    {
      if (isset($_POST["username"]) && isset($_POST["password"]) && !empty($_POST["username"]) && !empty($_POST["username"]) ) {
        $Login = new Login();
        if($Login->authenticate($this->sanitize($_POST["username"]), $this->sanitize($_POST["password"]))) {
          header('location: ' . URL . 'tasks');
        } else {
          header('location: ' . URL . 'login');
        }
      } else {
        // TODO: echo "Please fill in both username and password";
      }
    }
    function sanitize($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

}
