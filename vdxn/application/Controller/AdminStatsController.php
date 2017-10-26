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

date_default_timezone_set('UTC');
define("DEFAULT_FROM_DATE", "01-01-2015");
define("DEFAULT_TO_DATE", date("d-m-Y"));

class AdminStatsController {
  public function index() {
    $Task = new Task();
    $User = new Account();

    if(!isset($_SESSION['user'])) {
      header('location: ' . URL . 'login');
    }

    $validTimeRange = false;
    // The two values that affect the queries on the page

    if(isset($_GET['fromDate']) && isset($_GET['toDate'])) {
      $fromDate_arr  = explode('-', $_GET['fromDate']);
      $toDate_arr  = explode('-', $_GET['toDate']);
      if (checkdate($fromDate_arr[1], $fromDate_arr[0], $fromDate_arr[2]) &&
        checkdate($toDate_arr[1], $toDate_arr[0], $toDate_arr[2])) {

        $validTimeRange = true;
        $currentFromDate = $_GET['fromDate'];
        $currentToDate = $_GET['toDate'];
      }
    }

    if (!$validTimeRange) {
      $currentFromDate = DEFAULT_FROM_DATE;
      $currentToDate = DEFAULT_TO_DATE;
    }

    $currentFromDateTimeStamp = strtotime(date_format(date_create($currentFromDate), 'd-m-Y'));
    $currentToDateTimeStamp = strtotime(date_format(date_create($currentToDate), 'd-m-Y'));


    // Retrieve the number of completed/uncompleted tasks in range
    $num_tasks_com_uncom = $Task->getNumCompletedUncompletedTasks($currentFromDateTimeStamp, $currentToDateTimeStamp);
    $num_tasks_completed_in_range = $num_tasks_com_uncom->{'num_tasks_completed'};
    $num_tasks_uncompleted_in_range = $num_tasks_com_uncom->{'num_tasks_uncompleted'};

    // Retrieve the number of completed/uncompleted tasks
    $num_tasks_com_uncom_all_time = $Task->getNumCompletedUncompletedTasks();
    $num_tasks_completed_in_all_time = $num_tasks_com_uncom_all_time->{'num_tasks_completed'};
    $num_tasks_uncompleted_in_all_time = $num_tasks_com_uncom_all_time->{'num_tasks_uncompleted'};

    // Retrieve the number of completed/uncompleted tasks between a set of dates
    $num_tasks_completed_between_in_range = $Task->getNumCompletedTasksBetween($currentFromDateTimeStamp, $currentToDateTimeStamp)->{'num_tasks_completed'};

    // Test with this datetime range...You should see 56 tasks displayed
    // $num_tasks_completed_between = $Task->getNumCompletedTasksBetween(
    //    '2010-08-28 00:00:00:000', '2010-09-28 00:00:00:000')->{'num_tasks_completed'};

    // Retrieve the number of bids between a set of dates
    $num_bids_total_in_range = $Task->getNumBidsBetween(
      $currentFromDateTimeStamp, $currentToDateTimeStamp)->{'num_bids'};
    $num_bids_between_in_range = $Task->getNumBidsBetween(
      $currentFromDateTimeStamp, $currentToDateTimeStamp)->{'num_bids'};
    $avg_bids_per_task_in_range = $num_bids_total_in_range/
      ($num_tasks_completed_in_range + $num_tasks_uncompleted_in_range);
    $avg_bids_per_task_in_range = number_format((float)$avg_bids_per_task_in_range, 2, '.', '');

    $num_bids_total_in_all_time = $Task->getNumBidsBetween()->{'num_bids'};
    $num_bids_between_in_all_time = $Task->getNumBidsBetween()->{'num_bids'};
    $avg_bids_per_task_in_all_time = $num_bids_total_in_all_time/
      ($num_tasks_completed_in_all_time + $num_tasks_uncompleted_in_all_time);
    $avg_bids_per_task_in_all_time = number_format((float)$avg_bids_per_task_in_all_time, 2, '.', '');

    // Retrieve an array of task(s) with the largest number of bids (most popular tasks)
    $arr_most_pop_tasks = $Task->getMostPopularTasks();

    // Retrieve the number of users who ever signed up (doesn't count admins)
    $num_users_created = $User->getNumUsersSignedUp()->{'num_users'};

    // Retrieve the number of users who bidded at lesat once
    $num_users_bidded_at_least_once = $Task->getNumWhoBiddedAtLeastOnce()->{'num_users'};

    // Retrieve an array of all users who never bidded at all
    $arr_users_never_bidded = $User->getUsersNeverBidded();
    $arr_users_never_bidded_count = count($arr_users_never_bidded);

    //Retrieve number of completed tasks, bidded tasks, created tasks by month
    $arr_num_tasks_created_by_month = $Task -> getCountOfCreatedTasksByMonth();
    $arr_num_tasks_bidded_by_month = $Task -> getCountOfBiddedTasksByMonth();
    $arr_num_tasks_completed_by_month = $Task -> getCountOfCompletedTasksByMonth();
    $arr_month_names = array('Jan', 'Feb', 'Mar', 'April', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
    //manually construct the 2D array to be represented in bar chart
      $num_tasks_vs_bids_vs_completed_by_month = array_fill(0, 13 ,array_fill(0, 3, 0));
      $num_tasks_vs_bids_vs_completed_by_month[0] = array('Month 2017', 'Tasks Created', 'Bids Created','Tasks Completed');
      for($i = 1; $i <= 12; $i ++) {
          for($j = 0; $j <4; $j ++) {
              switch($j) {
                  case 0:
                      $num_tasks_vs_bids_vs_completed_by_month[$i][$j] = $arr_month_names[$i-1];
                      break;
                  case 1:
                      $num_tasks_vs_bids_vs_completed_by_month[$i][$j] = isset($arr_num_tasks_created_by_month[$i]->{'num_tasks_created'})? $arr_num_tasks_created_by_month[$i]->{'num_tasks_created'} :
                          0;
                      break;
                  case 2:
                      $num_tasks_vs_bids_vs_completed_by_month[$i][$j] = isset($arr_num_tasks_bidded_by_month[$i]->{'num_bids_created'})? $arr_num_tasks_bidded_by_month[$i]->{'num_bids_created'} :
                          0;
                      break;
                  case 3:
                      $num_tasks_vs_bids_vs_completed_by_month[$i][$j] = isset($arr_num_tasks_completed_by_month[$i]->{'num_tasks_completed'})? $arr_num_tasks_completed_by_month[$i]->{'num_tasks_completed'} :
                          0;
                      break;
              }
          }
      }
      $num_tasks_vs_bids_vs_completed_by_month = json_encode($num_tasks_vs_bids_vs_completed_by_month);
      echo ($num_tasks_vs_bids_vs_completed_by_month);

    // load views
    require APP . 'view/_templates/header.php';
    echo '<div class="container" style="padding-bottom: 100px;">';
    require APP . 'view/admin_stats/system_stats_date_picker.php';
    require APP . 'view/admin_stats/system_stats_user_section.php';
    require APP . 'view/admin_stats/system_stats_tasks_section.php';
    echo '</div>';
    require APP . 'view/_templates/footer.php';
  }

  function validateDate($date, $format = 'Y-m-d H:i:s')
  {
      $d = DateTime::createFromFormat($format, $date);
      return $d && $d->format($format) == $date;
  }
}
