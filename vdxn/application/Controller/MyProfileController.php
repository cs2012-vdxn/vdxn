<?php

/**
 * Class MyProfileController
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */

namespace Mini\Controller;
session_start();
use Mini\Model\Login;
use Mini\Model\Account;
use Mini\Model\ProfilePicture;

class MyProfileController {
    public function index() {
      $user = $this->getPublicUserProfile();
      $pictureLink = URL . 'img/default_avatar.png';

      $profilePicture = new ProfilePicture();
      $pictureLink = $profilePicture->getPictureLink($_SESSION['user']->{'username'});

      // load views
      require APP . 'view/_templates/header.php';
      if ($user) {
        require APP . 'view/myprofile/profile.php';
      } else {
        require APP. 'view/myprofile/profile_not_found.php';
      }
      require APP . 'view/_templates/footer.php';
    }

    /**
     * Retrieves the public profile of a User object specified by the GET
     * parameter in the URL
     *
     * @return Object    User object along with this user's overall rating
     */
    private function getPublicUserProfile() {
      $User = new Account();

      if (isset($_GET['username'])) {
        $user = $User->getUserPublicProfile($_GET['username']);
        if ($user) {
          // When we can find a user in the system
          $user->{'assignee_rating'} = $User->getUserRating($_GET['username']);
          $user->{'creator_rating'} = $User->getUserCreatorRating($_GET['username']);
          return $user;
        }
      }
      return NULL;
    }
}
