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

class MyProfileController
{
    public function index()
    {
        if(!isset($_SESSION['user'])) {
          header('location: ' . URL . 'login');
        }

        $pictureLink = '/public/img/default_avatar.png';
        $username = $_SESSION['user']->{'username'};
        $email = $_SESSION['user']->{'email'};
        $contact = $_SESSION['user']->{'contact'};
        $rating = 4.7; // Can be computed using aggregates
        $earnings_this_month = '202.70'; // Can be computed using aggregates

        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/myprofile/profile.php';
        require APP . 'view/_templates/footer.php';
    }
}
