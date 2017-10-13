<?php
/**
 * Class SignupController
 *
 */
namespace Mini\Controller;
session_start();
use Mini\Model\Account;
class SignupController
{
    public function index()
    {
      if(isset($_SESSION['user'])) {
        header('location: ' . URL . 'dashboard');
      }
      // load views
      require APP . 'view/_templates/header.php';
      require APP . 'view/signup/index.php';
      require APP . 'view/_templates/footer.php';
    }
    public function submitForm()
    {
      if (!empty($_POST["username"]) &&
          !empty($_POST["email"]) &&
          !empty($_POST["firstName"]) &&
          !empty($_POST["lastName"]) &&
          !empty($_POST["contactNumber"]) &&
          !empty($_POST["password"]) &&
          !empty($_POST["password2"])) {

        $Account = new Account();

        if($Account->create(
          $this->sanitize($_POST["username"]),
          $this->sanitize($_POST["email"]),
          $this->sanitize($_POST["firstName"]),
          $this->sanitize($_POST["lastName"]),
          $this->sanitize($_POST["contactNumber"]),
          $this->sanitize($_POST["password"]))) {

          header('location: ' . URL . 'login');

        } else {
          header('location: ' . URL . 'signup');
        }
      } else {
        header('location: ' . URL . 'signup');
      }
    }
    function sanitize($data) {
      $data = trim($data);
      $data = stripslashes($data);
      return $data;
    }

}
