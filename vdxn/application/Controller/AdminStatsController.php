<?php

/**
 * Class AdminStatsController
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */

namespace Mini\Controller;
session_start();
use Mini\Model\Login;

class AdminStatsController {
  public function index() {
    if(!isset($_SESSION['user'])) {
      header('location: ' . URL . 'login');
    }

    // load views
    require APP . 'view/_templates/header.php';
    require APP . 'view/admin_stats/system_stats.php';
    require APP . 'view/_templates/footer.php';
  }
}
