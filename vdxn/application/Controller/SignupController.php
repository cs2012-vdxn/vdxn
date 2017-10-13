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
      if (!empty($_POST["username"]) && !empty($_POST["password"])) {
        $Login = new Account();

        if($Login->authenticate($this->sanitize($_POST["username"]), $this->sanitize($_POST["password"]))) {
          header('location: ' . URL . 'tasks');
        } else {
          header('location: ' . URL . 'login');
        }
      } else {
        // TODO: echo "Please fill in both username and password";
        //header('location: ' . URL . 'login');
      }
    }
    function sanitize($data) {
      $data = trim($data);
      $data = stripslashes($data);
      return $data;
    }

}
