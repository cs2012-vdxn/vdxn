<?php
namespace Mini\Model;

use Mini\Core\Model;

class Account extends Model
{
  private $DEFAULT_FROM_DATE = '0000-00-00 00:00:00:000';
  private $DEFAULT_TO_DATE = '2999-00-00 00:00:00:000';

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

  function changePassword($username, $password_old, $password_new) {

    if(!$this->getUser($username, $password_old)) return false;

    $password_new_hash = password_hash($password_new, PASSWORD_DEFAULT);

    $sql = "UPDATE User SET `password_hash`='$password_new_hash'
      WHERE `username`='$username'";
    $query = $this->db->prepare($sql);
    return $query->execute();
  }

  function create($username, $email, $firstName, $lastName, $contactNumber, $password) {
    $time = date("Y-m-d H:i:s");
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO User
    (`username`,
      `first_name`,
      `last_name`,
      `password_hash`,
      `contact`,
      `email`,
      `created_at`,
      `updated_at`,
      `deleted_at`,
      `user_type`)
      VALUES (
        '$username',
        '$firstName',
        '$lastName',
        '$passwordHash',
        '$contactNumber',
        '$email',
        '$time',
        '',
        '',
        'User'
    );";
    $query = $this->db->prepare($sql);
    return $query->execute();
  }

  //==========================================
  // GETTING USER PROFILE ATTRIBUTES
  //==========================================
  /**
   * Retrieves a user's public profile, i.e. no password hash retrieved
   *
   * @param  String $username    Username to retrieve profile for
   * @return Object    Public profile of specified username
   */
  function getUserPublicProfile($username) {
    $sql = "SELECT username, first_name, last_name, contact, email, user_type, created_at
      FROM User WHERE `username`='$username'";
    $query = $this->db->prepare($sql);
    $query->execute();
    return $query->fetch();
  }

  /**
   * Computes and retrieves a user's overall rating.
   * Sums up and averages the ratings from all of the tasks this user did.
   * The SQL query also ensures that decimal values are rounded to the nearest
   * 2 decimal places.
   *
   * @param  String $username    Username to retrieve profile for
   * @return Float     Rating of this user, rounded to the nearest 2 decimal places
   */
  function getUserRating($username) {
    $sql = "SELECT ROUND(SUM(assignee_rating) / COUNT(assignee_rating), 2) AS rating
      FROM Task WHERE assignee_username = '" . $username . "'";
    $query = $this->db->prepare($sql);
    $query->execute();
    return floatval($query->fetch()->{'rating'});
  }




  //==========================================
  // ADMIN SYSTEM STATS FUNCTIONS
  //==========================================
  /**
   * Gets the no. of users who signed up between a specified datetime range.
   * Does not count admins.
   *
   * @param  String $from_date   Start Date in the format of YYYY-MM-DD hh:mm:ss:000
   * @param  String $to_date     End Date in the format of YYYY-MM-DD hh:mm:ss:000
   * @return Object    Number of users who signed up
   */
  public function getNumUsersSignedUp($from_date = NULL, $to_date = NULL) {
    $from_date = $from_date ? $from_date : $this->DEFAULT_FROM_DATE;
    $to_date = $to_date ? $to_date : $this->DEFAULT_TO_DATE;

    $sql = "SELECT COUNT(*) AS num_users
      FROM User
      WHERE user_type <> 'Admin'
      AND created_at BETWEEN '".$from_date."' AND '".$to_date."'";
    $query = $this->db->prepare($sql);
    $query->execute();
    return $query->fetch();
  }

}
