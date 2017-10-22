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
    $tableHtml =''/* '<thead><tr><th data-col="title">Title</th>'.
                '<th data-col="description">Description</th>'.
                '<th data-col="created_at">Created At</th>'.
                '<th data-col="start_at">Start At</th>'.
                '<th data-col="completed_at">Completed At</th>'.
                '<th data-col="assignee_username">Assigned To</th>'.
                '<th data-col="creator_rating">Creator Rating</th>'.
                '<th data-col="assignee_rating">Assignee Rating</th></tr></thead>'*/;
    foreach($completed_tasks as $task) {
      $tableHtml .= '<tr>';
      foreach($task as $item) {
        $tableHtml .= "<td>$item</td>";
      }
      $tableHtml .= "<td><a href='/tasks/task?title=" .
            $task->title . "&creator_username=" .
            $_SESSION['user']->username .
            "'>Link</a></td>" . "<td><a href='/tasks/edittask?title=" .
            $task->title . "&creator_username=" .
            $_SESSION['user']->username .
            "'>Edit</a></td>".
            "<td><a href='/tasks/deletetask?title=" .
            $task->title . "&creator_username=" .
            $_SESSION['user']->username .
            "'>Delete</a></td>".
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
    $tableHtml = ''/* '<thead><tr><th data-col="title">Title</th>'.
                '<th data-col="description">Description</th>'.
                '<th data-col="created_at">Created At</th>'.
                '<th data-col="start_at">Start At</th>'.
                '<th data-col="updated_at">Last Updated At</th>'.
                '<th data-col="min_bid">Min Bid</th>'.
                '<th data-col="max_bid">Max Bid</th>'.
                '<th data-col="assignee_username">Assigned To</th>'.
                '<th data-col="creator_rating">Creator Rating</th>'.
                '<th data-col="assignee_rating">Assignee Rating</th></tr></thead>'*/;
    foreach($bidded_tasks as $task) {
      $tableHtml .= '<tr>';
      foreach($task as $item) {
        $tableHtml .= "<td>$item</td>";
      }
      $tableHtml .= "<td><a href='/tasks/task?title=" .
            $task->title . "&creator_username=" .
            $_SESSION['user']->username .
            "'>Link</a></td>" . "<td><a href='/tasks/edittask?title=" .
            $task->title . "&creator_username=" .
            $_SESSION['user']->username .
            "'>Edit</a></td>".
            "<td><a href='/tasks/deletetask?title=" .
            $task->title . "&creator_username=" .
            $_SESSION['user']->username .
            "'>Delete</a></td>".
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
    $tableHtml = ''/*'<thead><tr><th data-col="title">Title</th>'.
                '<th data-col="description">Description</th>'.
                '<th data-col="start_at">Start At</th>'.
                '<th data-col="curr_min_bid">Current Min bid</th>'.
                '<th data-col="curr_max_bid">Current Max bid</th>'.
                '<th data-col="myBid">My Bid</th>'.
                '<th data-col="creator_username">Created by</th>'.
                '<th data-col="creator_rating">Creator Rating</th>'.
                '<th data-col="assignee_rating">Assignee Rating</th></tr></thead>'*/;
    foreach($bidded_tasks as $task) {
      $tableHtml .= '<tr>';
      foreach($task as $item) {
        $tableHtml .= "<td>$item</td>";
      }
      $tableHtml .= "<td><a href='/tasks/task?title=" .
            $task->title . "&creator_username=" .
            $task->creator_username .
            "'>Link</a></td>" . "<td><a href='/tasks/edittask?title=" .
            $task->title . "&creator_username=" .
            $task->creator_username .
            "'>Edit</a></td>".
            "<td><a href='/tasks/deletetask?title=" .
            $task->title . "&creator_username=" .
            $task->creator_username .
            "'>Delete</a></td>".
      '</tr>';
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
    $tableHtml = ''/*'<thead><tr><th data-col="title">Title</th>'.
                '<th data-col="description">Description</th>'.
                '<th data-col="start_at">Start At</th>'.
                '<th data-col="myBid">My Bid</th>'.
                '<th data-col="winning_bid">Winning Bid</th>'.
                '<th data-col="creator_username">Created by</th>'.
                '<th data-col="assignee_username">Assigned To</th></tr></thead>'*/;
    foreach($history_tasks as $task) {
      $tableHtml .= '<tr>';
      foreach($task as $item) {
        $tableHtml .= "<td>$item</td>";
      }
      $tableHtml .= "<td><a href='/tasks/task?title=" .
            $task->title . "&creator_username=" .
            $task->creator_username .
            "'>Link</a></td>" . "<td><a href='/tasks/edittask?title=" .
            $task->title . "&creator_username=" .
            $task->creator_username .
            "'>Edit</a></td>".
            "<td><a href='/tasks/deletetask?title=" .
            $task->title . "&creator_username=" .
            $task->creator_username .
            "'>Delete</a></td>".
      '</tr>';
    }

    echo $tableHtml;
  }
}
