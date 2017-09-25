<?php

namespace Mini\Model;

use Mini\Core\Model;

class Login extends Model
{
  public function authenticate($username, $password) {
    $userRecord = getUser($username);
    if ($userRecord->num_rows === 0) return;
    echo ($userRecord['password_hash']);
    if(hash_password(password) === $userRecord['password_hash']) {
      // TODO: save the details in session
      return true;
    }
    return false;
  }
  function getUser($username) {
    $sql = "SELECT id, username, password_hash" +
    "FROM User" +
    "WHERE username=" + $username;
    $query = $this->db->prepare($sql);
    $query->execute();
    return $query->fetchAll();
  }
  function hash_password($password) {
    return password_hash($password, PASSWORD_DEFAULT);
  }
}
