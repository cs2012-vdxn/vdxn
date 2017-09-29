<?php
namespace Mini\Model;

use Mini\Core\Model;

class Login extends Model
{
  public function authenticate($username, $password) {
    $userRecord = $this->getUser($username, $password);

    if(empty($userRecord)) {
      $_SESSION['user'] = null;
      return false;
    } else {
      $_SESSION['user'] = $userRecord;
      return true;
    }
  }
  function getUser($username, $password) {
    $sql = "SELECT username, password_hash, contact, email, user_type FROM User WHERE
      `username`='$username'";
    $query = $this->db->prepare($sql);
    $query->execute();
    $result = $query->fetch();

    $verify = password_verify($password, $result->{'password_hash'});
    if ($verify) {
      return $result;
    } else {
      return null;
    }
  }
}
