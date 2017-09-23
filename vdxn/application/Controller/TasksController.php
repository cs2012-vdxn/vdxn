<?php
namespace Mini\Controller;

use Mini\Model\Task;

class TasksController
{
    public function index()
    {
        $Task = new Task();
      // getting all songs and amount of songs
        $tasks = $Task->getAllTasks();
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/tasks/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function task($tid)
    {
      $Task = new Task();

      $task = $Task->getTask($tid);

      require APP . 'view/_templates/header.php';
      require APP . 'view/tasks/task.php';
      require APP . 'view/_templates/footer.php';
    }

    public function newtask()
    {
      require APP . 'view/_templates/header.php';
      require APP . 'view/tasks/new.php';
      require APP . 'view/_templates/footer.php';
    }
}
