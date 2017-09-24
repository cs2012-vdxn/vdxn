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
      $bids = $Task->getBids($tid);

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

    public function deletetask($tid)
    {
      require APP . 'view/_templates/header.php';
      $successful_delete = false;
      if($this->can_delete_task($tid, null))
      {
        $Task = new Task();
        if ($Task->deleteTask($tid))
        {
          $successful_delete = true;
        }
      }

      if ($successful_delete)
      {
        require APP . 'view/tasks/taskdeleted.php';
      }
      else
      {
        require APP . 'view/tasks/tasknotdeleted.php';
      }
      require APP . 'view/_templates/footer.php';
    }

    private function validate_new_tasks($params)
    {
      return isset($params['title']) && isset($params['details']);
    }

    private function can_delete_task($tid, $user)
    {
      return true;
    }
}
