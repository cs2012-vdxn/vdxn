<?php

namespace Mini\Model;

use Mini\Core\Model;

class Login extends Model
{
  public function authenticate($username, $password) {
    $userRecord = $this->getUser($username);
    if(empty($userRecord)) return;
    foreach($userRecord as $row) {
      if(password_verify ($password, $row->password_hash)) {
        // TODO: save the details in session
        //  echo("Login successfully!");
        return true;
      }
    }
    echo ("Login failed.");
    return false;
  }
  function getUser($username) {
    $sql = "SELECT id, username, password_hash FROM User WHERE username = '".$username . "'";
    $query = $this->db->prepare($sql);
    $query->execute();
    return $query->fetchAll();
  }
  function hash_password($password) {
    return password_hash($password, PASSWORD_DEFAULT);
  }
}
