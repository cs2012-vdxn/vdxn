<?php

namespace Mini\Model;

use Mini\Core\Model;

class Login extends Model
{
  private function saveUserData($data) {
    foreach ($mapping as $key => $value) {
      setcookie($key, $value, time() + (86400 * 30), "/");
    }
    if(count($_COOKIE) === 0) {
      // Cookies are disabled.
      // TODO: save to session
    }
  }
  public function authenticate($username, $password) {
    $userRecord = $this->getUser($username);
    if(empty($userRecord)) return;
    foreach($userRecord as $row) {
      if(password_verify ($password, $row->password_hash)) {
        // save the details in cookie
        echo($row->id);
        //unset($_COOKIE["userid"]);
        // setcookie("userid", '',  time() - 1);
        saveUserData({"userid" => ($row->id) });
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
