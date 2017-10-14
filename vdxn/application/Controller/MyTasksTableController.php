<?php

namespace Mini\Controller;
use Mini\Model\Task;

class MyTasksTableController {
  public function sortCompletedTasks {
    $sortBy = $_POST['by'];
    $Task = new Task();

  }
  public function fetchCompletedTasks { // pagination
    // TODO
  }
  public function sortCreatedTasks {
    // TODO
  }
  public function fetchCreatedTasks { // pagination
    // TODO
  }
  public function sortCurrentBiddedTasks {
    // TODO
  }
  public function fetchCurrentBiddedTasks { // pagination
    // TODO
  }
  public function sortHistoryBiddedTasks {
    // TODO
  }
  public function fetchHistoryBiddedTasks { // pagination
    // TODO
    $offset = $_POST['offet'];
    $pagesize = $_POST['pagesize'];

  }
}
