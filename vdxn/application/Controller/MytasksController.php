<?php
namespace Mini\Controller;
session_start();
use Mini\Model\Task;

class MytasksController
{
    public function index()
    {
        $Task = new Task();
        $username = $_SESSION['user']->username;
        $user_tasks = $Task->getAllUserTasks($username);
        $completed_tasks = $Task->getAllHistoryUserTasks($username);
        $bidded_tasks = $Task->getAllCurrentBiddedTasks($username);
        $history_bidded_tasks = $Task->getAllHistoryBiddedTasks($username);
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/mytasks/index.php';
        require APP . 'view/_templates/footer.php';
    }
}
