<?php
namespace Mini\Controller;
session_start();
use Mini\Model\Task;

class MytasksController
{
    public function index()
    {
        $Task = new Task();
        $user_tasks = $Task->getAllUserTasks($_SESSION['user']['username']);
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/mytasks/index.php';
        require APP . 'view/_templates/footer.php';
    }
}
