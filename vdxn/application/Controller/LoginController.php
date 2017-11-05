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
session_start();
use Mini\Model\Account;
class LoginController
{
    public function index()
    {
      if(isset($_SESSION['user'])) {
        header('location: ' . URL . 'dashboard');
      }

      $error_msg_no_username_or_password = NULL;
      if (isset($_GET["error"]) && $_GET["error"] == 'no_username_or_password') {
        $error_msg_no_username_or_password = 'Please input your username / password!';
      }

      $error_msg_no_such_user = NULL;
      if (isset($_GET["error"]) && $_GET["error"] == 'no_such_user') {
        $error_msg_no_such_user = 'Incorrect login credentials. Please try again.';
      }

      // load views
      require APP . 'view/_templates/header.php';
      require APP . 'view/login/index.php';
      require APP . 'view/_templates/footer.php';
    }

    public function submitForm()
    {
      if (!empty($_POST["username"]) && !empty($_POST["password"])) {
        $Login = new Account();

        if($Login->authenticate($this->sanitize($_POST["username"]), $this->sanitize($_POST["password"]))) {
          header('location: ' . URL . 'tasks');
        } else {
          header('location: ' . URL . 'login?error=no_such_user');
        }
      } else if (empty($_POST["username"]) || empty($_POST["password"])) {
        header('location: ' . URL . 'login?error=no_username_or_password');
      }
    }
    function sanitize($data) {
      $data = trim($data);
      $data = stripslashes($data);
      return $data;
    }

}
