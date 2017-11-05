<?php

namespace Mini\Controller;
session_start();
use Mini\Model\Task;

class TableController {
  public function fetchCompletedTasks() {
    $order_by = $_POST['order_by'];
    $offset = $_POST['offset'];
    $pagesize = $_POST['pagesize'];
    $dir = $_POST['dir'];
    $Task = new Task();
    $username = $_SESSION['user']->username;
    $completed_tasks = $Task->getAllHistoryUserTasks($username, $offset, $pagesize, $order_by, $dir);
    $tableHtml ='';
    foreach($completed_tasks as $task) {
      $tableHtml .= '<tr>';
      foreach($task as $task_attribute => $item) {
        if ($task_attribute == 'title') {
          $tableHtml .= "<td><a href='/tasks/task?title=".$task->title."&creator_username=".$_SESSION['user']->username."'>$item</a></td>";
        } else {
          $tableHtml .= "<td>$item</td>";
        }
      }

      $tableHtml .= "<td style='border-top: white 5px solid; border-right: white 5px solid; border-bottom: white 5px solid;'>
             <a class='btn btn-embossed btn-sm btn-danger' style='margin-left: 5px; margin-right: 5px;' href='/tasks/deletetask?title=" .
            $task->title . "&creator_username=" .
            $_SESSION['user']->username .
            "'><span class='fui-trash'></span>Delete</a></td>".
      '</tr>';
    }
    echo $tableHtml;
  }

  public function fetchCreatedTasks() {
    $order_by = $_POST['order_by'];
    $offset = $_POST['offset'];
    $pagesize = $_POST['pagesize'];
    $dir = $_POST['dir'];
    $Task = new Task();
    $username = $_SESSION['user']->username;
    $bidded_tasks = $Task->getAllUserTasks($username, $offset, $pagesize, $order_by, $dir);
    $tableHtml = '';
    foreach($bidded_tasks as $task) {
      $tableHtml .= '<tr>';
      foreach($task as $task_attribute => $item) {
        if ($task_attribute == 'title') {
          $tableHtml .= "<td><a href='/tasks/task?title=".$task->title."&creator_username=".$_SESSION['user']->username."'>$item</a></td>";
        } else {
          $tableHtml .= "<td>$item</td>";
        }
      }
      if(!isset($task->assignee_username)) {
      $tableHtml .=  "<td style='border-top: white 5px solid; border-right: white 5px solid; border-bottom: white 5px solid;'>
            <a class='btn btn-embossed btn-sm btn-primary' style='margin-left: 10px; margin-right: 5px;'
            href='/tasks/edittask?title=" .
            $task->title . "&creator_username=" .
            $_SESSION['user']->username .
            "'><span class='fui-new'></span> Edit</a></td>";
      }
      $tableHtml .= "<td style='border: white 5px solid;'>
            <a class='btn btn-embossed btn-sm btn-danger' style='margin-left: 5px; margin-right: 5px;'
            href='/tasks/deletetask?title=" .
            $task->title . "&creator_username=" .
            $_SESSION['user']->username .
            "'><span class='fui-trash'></span> Delete</a></td>".
      '</tr>';
    }

    echo $tableHtml;
  }

  public function fetchCurrentBiddedTasks() {
    $order_by = $_POST['order_by'];
    $offset = $_POST['offset'];
    $pagesize = $_POST['pagesize'];
    $dir = $_POST['dir'];
    $Task = new Task();
    $username = $_SESSION['user']->username;
    $bidded_tasks = $Task->getAllCurrentBiddedTasks($username, $offset, $pagesize, $order_by, $dir);
    $tableHtml = '';
    foreach($bidded_tasks as $task) {
      $tableHtml .= '<tr>';
      foreach($task as $task_attribute => $item) {
        if ($task_attribute == 'title') {
          $tableHtml .= "<td><a href='/tasks/task?title=".$task->title."&creator_username=".$task->creator_username."'>$item</a></td>";
        } else {
          $tableHtml .= "<td>$item</td>";
        }
      }
    }

    echo $tableHtml;
  }

  public function fetchHistoryBiddedTasks() {
    $order_by = $_POST['order_by'];
    $offset = $_POST['offset'];
    $pagesize = $_POST['pagesize'];
    $dir = $_POST['dir'];
    $Task = new Task();
    $username = $_SESSION['user']->username;
    $history_tasks = $Task->getAllHistoryBiddedTasks($username, $offset, $pagesize, $order_by, $dir);
    $tableHtml = '';
    foreach($history_tasks as $task) {
      $tableHtml .= '<tr>';
      foreach($task as $task_attribute=>$item) {
        if ($task_attribute == 'title') {
          $tableHtml .= "<td><a href='/tasks/task?title=".$task->title."&creator_username=".$task->creator_username."'>$item</a></td>";
        } else {
          $tableHtml .= "<td>$item</td>";
        }
      }

    }

    echo $tableHtml;
  }
}
