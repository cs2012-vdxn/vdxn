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
use Mini\Model\Login;

class DashboardController
{
    public function index()
    {
        if(!isset($_SESSION['user'])) {
            header('location: ' . URL . 'login');
        }

        // For the profile tab
        $name = $_SESSION['user']->{'username'};
        $last_name = '[last name]';
        $phone = "[phone number]";
        $email = '[email]';
        $rating = "[rating]";
        $earnings_this_month = "[amount]";

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

    /**
     * Handles an admin's search for specific tasks in the database.
     * Able to filter out tasks by creator name, doer name and title for now (TODO - advanced feature).
     *
     * @return View Table of all tasks retrieved in search results
     */
    public function adminSubmitSearch() {
      $taskcreator = isset($_POST['taskCreator']) ? $_POST['taskCreator'] : null;
      $taskdoer = isset($_POST['taskDoer']) ? $_POST['taskDoer'] : null;
      $tasktitle = isset($_POST['taskTitle']) ? $_POST['taskTitle'] : null;

      require APP . 'view/dashboard/admin/managedtasks.php';
    }

    /**
     * Handles an admin's search for specific users in the database.
     * Able to filter out users by name, email and phone number
     *
     * @return View Table of all users retrieved in search results
     */
    public function adminSubmitSearchUser() {
      $username = isset($_POST['userName']) ? $_POST['userName'] : null;
      $useremail = isset($_POST['userEmail']) ? $_POST['userEmail'] : null;
      $userphone = isset($_POST['userPhone']) ? $_POST['userPhone'] : null;

      // TODO: Some function to retrieve list of users here
      $userrating = 4.3;

      require APP . 'view/dashboard/admin/managedusers.php';
    }

    // [Natasha] TODO: Check whether this current user is an admin or not
    function userIsAdmin() {
      return true;
    }


}
