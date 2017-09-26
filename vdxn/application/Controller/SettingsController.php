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
class SettingsController
{
    public function index()
    {
        if(!isset($_SESSION['user'])) {
            header('location: ' . URL . 'login');
        }
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/settings/index.php';
        require APP . 'view/_templates/footer.php';
    }
}
