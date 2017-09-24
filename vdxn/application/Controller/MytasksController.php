<?php
namespace Mini\Controller;

use Mini\Model\Task;

class MytasksController
{
    public function index()
    {
        $Task = new Task();
        // TO REMOVE
        $_SESSION['user_id'] = 1;
        $user_tasks = $Task->getAllUserTasks($_SESSION['user_id']);
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/mytasks/index.php';
        require APP . 'view/_templates/footer.php';
    }
}
