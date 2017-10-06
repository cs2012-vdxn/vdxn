<?php

/**
 * Class DashboardController
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */

namespace Mini\Controller;
session_start();
use Mini\Model\Account;
class SettingsController
{
    public function index()
    {
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/settings/index.php';
        require APP . 'view/_templates/footer.php';
    }
    public function change_password()
    {
        if (empty($_POST["password_old"]) || empty($_POST["password_new"])
            || empty($_POST["password_new_confirm"])) {
            header('location: ' . URL . '/settings');
        }

        if ($_POST["password_new"] != $_POST["password_new_confirm"]) {
            header('location: ' . URL . '/settings');
        }

        $password_old = $_POST["password_old"];
        $password_new = $_POST["password_new_confirm"];

        $Account = new Account();
        $username = $_SESSION['user']->{'username'};
        if($Account->changePassword($username, $password_old, $password_new)) {
            echo "Password successfully changed.<a href='/settings'>Back</a>";
        } else {
            echo "Error<a href='/settings'>Back</a>";
        }
        //header('location: ' . URL . '/settings');
    }
}
