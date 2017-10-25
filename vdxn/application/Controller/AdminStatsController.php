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
use Mini\Model\Task;
use Mini\Model\Account;

class AdminStatsController {
  public function index() {
    $Task = new Task();

    if(!isset($_SESSION['user'])) {
      header('location: ' . URL . 'login');
    }

    // Retrieve the number of completed/uncompleted tasks
    $num_tasks_com_uncom = $Task->getNumCompletedUncompletedTasks();
    $num_tasks_completed = $num_tasks_com_uncom->{'num_tasks_completed'};
    $num_tasks_uncompleted = $num_tasks_com_uncom->{'num_tasks_uncompleted'};

    // Retrieve the number of completed/uncompleted tasks between a set of dates
    $num_tasks_completed_between = $Task->getNumCompletedTasksBetween()->{'num_tasks_completed'};
    // Test with this datetime range...You should see 56 tasks displayed
    // $num_tasks_completed_between = $Task->getNumCompletedTasksBetween(
    //    '2010-08-28 00:00:00:000', '2010-09-28 00:00:00:000')->{'num_tasks_completed'};

    // Retrieve the number of bids between a set of dates
    $num_bids_total = $Task->getNumBidsBetween()->{'num_bids'};
    // Test with this datetime range...You should see 8 bids displayed
    $num_bids_between = $Task->getNumBidsBetween(
      '2010-08-28 00:00:00:000', '2017-09-28 00:00:00:000')->{'num_bids'};

    // Retrieve an array of task(s) with the largest number of bids (most popular tasks)
    $arr_most_pop_tasks = $Task->getMostPopularTasks();



    // load views
    require APP . 'view/_templates/header.php';
    require APP . 'view/admin_stats/system_stats.php';
    require APP . 'view/_templates/footer.php';
  }
}
