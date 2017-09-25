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
use Mini\Model\Login;

class DashboardController
{
    public function index()
    {
        // For the profile tab
        $name = 'Natasha';
        $last_name = 'Koh';
        $phone = "91390523";
        $email = 'natasha_kss@hotmail.com';
        $rating = 4.5;
        $earnings_this_month = 202.90;

        // For the task tab
        $num_ongoing_tasks = 4;
        $num_pending_tasks = 2;
        $num_completed_tasks = 7;
        $num_total_tasks = $num_ongoing_tasks + $num_pending_tasks + $num_completed_tasks;

        // load views
        require APP . 'view/_templates/header.php';
        if ($this->userIsAdmin()) {
          require APP . 'view/dashboard/admin/dashboard.php';
        } else {
          require APP . 'view/dashboard/user/dashboard.php';
        }
        require APP . 'view/_templates/footer.php';
    }

    // [Natasha] TODO: Check whether this current user is an admin or not
    function userIsAdmin() {
      return true;
    }
}
