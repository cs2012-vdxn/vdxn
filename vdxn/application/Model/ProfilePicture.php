<?php
namespace Mini\Model;
define('NUMBER_OF_PICS', 5);
define('PROFILE_PICTURE_DIRECTORY', URL . 'img/profiles/');

use Mini\Core\Model;

class ProfilePicture extends Model
{
  public function getPictureLink($username) {

    // Simple function to reduce $username to a single value
    $val = crc32($username) % NUMBER_OF_PICS;
    return PROFILE_PICTURE_DIRECTORY . $val . '.jpg';
  }
}
