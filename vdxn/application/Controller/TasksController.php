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
      if($this->validate_new_tasks($_POST))
      {
        //TODO
        $clean_task_params = $_POST;
        var_dump($_POST);
        $Task = new Task();
        $task = $Task->createTask($clean_task_params);
        require APP . 'view/tasks/taskcreated.php';
      } else
      {
        require APP . 'view/tasks/new.php';
      }
      require APP . 'view/_templates/footer.php';
    }

    public function edittask($tid)
    {
      require APP . 'view/_templates/header.php';
      require APP . 'view/tasks/edit.php';
      require APP . 'view/_templates/footer.php';
    }

    private function validate_new_tasks($params)
    {
      return isset($params['title']) && isset($params['details']);
    }
}
