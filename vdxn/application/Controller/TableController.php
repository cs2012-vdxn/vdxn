<?php

namespace Mini\Controller;
use Mini\Model\Task;

class TableController {
  public function fetchCompletedTasks {
    // TODO
  }

  public function fetchCreatedTasks {
    // TODO
  }

  public function fetchCurrentBiddedTasks {
    // TODO
  }

  public function fetchHistoryBiddedTasks {
    $order_by = $_POST['order_by'];
    $offset = $_POST['offet'];
    $pagesize = $_POST['pagesize'];
    $Task = new Task();
    $username = $_SESSION['user']->username;
    $history_tasks = $Task->getAllHistoryBiddedTasks($username, $offset, $pagesize, $order_by);
    $tableHtml = '<table border="1">'.
                '<th>Title</th>'.
                '<th>Description</th>'.
                '<th>Start At</th>'.
                '<th>My Bid</th>'.
                '<th>Winning Bid</th>'.
                '<th>Created by</th>'.
                '<th>Assigned To</th></tr>';
    foreach($history_tasks as $task) {
      $tableHtml += '<tr>';
      foreach($task as $item) {
        $tableHtml += "<td>$item</td>";
      }
      $tableHtml += "<td><a href='/tasks/task?title=" .
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
    $tableHtml +=  '</table>';
    return $tableHtml;
  }
}
