<?php
namespace Mini\Controller;
session_start();
use Mini\Model\Task;

class MytasksController
{
    public function index()
    {
        $this->getCreatedTasks();
    }
    public function getCreatedTasks()
    {
      $Task = new Task();
      $username = $_SESSION['user']->username;
      $user_tasks = $Task->getAllUserTasks($username);
      $history_tasks = $Task->getAllHistoryUserTasks($username);
      $num_user_tasks = count($user_tasks);
      $num_history_tasks = count($history_tasks);
      // load views
      require APP . 'view/_templates/header.php';
      require APP . 'view/mytasks/dropdown.php';
      require APP . 'view/mytasks/created.php';
      require APP . 'view/_templates/footer.php';
    }
    public function getBiddedTasks()
    {
      $Task = new Task();
      $username = $_SESSION['user']->username;
      $user_tasks = $Task->getAllCurrentBiddedTasks($username);
      $history_tasks = $Task->getAllHistoryBiddedTasks($username);
      $num_user_tasks = count($user_tasks);
      $num_history_tasks = count($history_tasks);
      // load views
      require APP . 'view/_templates/header.php';
      require APP . 'view/mytasks/dropdown.php';
      require APP . 'view/mytasks/bidded.php';
      require APP . 'view/_templates/footer.php';
    }
}
