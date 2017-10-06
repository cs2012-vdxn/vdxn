<?php
namespace Mini\Controller;
session_start();
use Mini\Model\Account;
class LogoutController
{
    public function index()
    {
      if(isset($_SESSION['user']))
      {
        $_SESSION['user'] = null;
      }
      header('location: ' . URL);
    }
}
