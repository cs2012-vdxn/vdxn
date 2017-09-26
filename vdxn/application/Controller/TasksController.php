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

      $user = 2;
      $hasUserBid = $this->has_user_bid_on_task($tid, $user);
      $isTaskOwner = $this->is_task_owner($task, $user);

      require APP . 'view/_templates/header.php';
      require APP . 'view/tasks/task.php';
      require APP . 'view/_templates/footer.php';
    }

    public function newtask()
    {
      require APP . 'view/_templates/header.php';
      if($this->validate_task($_POST))
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
      $Task = new Task();

      if($this->validate_task($_POST))
      {
        //TODO
        $clean_task_params = $_POST;
        if($Task->editTask($tid, $clean_task_params)) {
          require APP . 'view/tasks/taskedited.php';
        } else {
          die("ERROR TO CATCH");
        }
      } else
      {
        $task = $Task->getTask($tid);
        require APP . 'view/tasks/edit.php';
      }
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

    public function newbid($tid)
    {
      require APP . 'view/_templates/header.php';

      $clean_bid_params = $_POST;

      $bid = 10;
      $Task = new Task();
      if ($Task->createTaskBid($tid, $bid, $clean_bid_params))
      {
        require APP . 'view/tasks/bidcreated.php';
      }
      else
      {
        die("Bid creation error");
      }

      require APP . 'view/_templates/footer.php';
    }

    public function bids($tid)
    {
      $Task = new Task();

      $task = $Task->getTask($tid);
      $bids = $Task->getBids($tid);

      require APP . 'view/_templates/header.php';
      require APP . 'view/tasks/bids.php';
      require APP . 'view/_templates/footer.php';
    }

    private function validate_task($params)
    {
      return isset($params['title']) && isset($params['description']);
    }

    private function can_delete_task($tid, $user)
    {
      return true;
    }

    private function has_user_bid_on_task($tid, $user)
    {
      $Task = new Task();
      if ($Task->getUserBidForTask($tid, $user))
      {
        return true;
      } else
      {
        return false;
      }
    }

    private function is_task_owner($task, $user)
    {
      if (!$task || !$user) return false;
      // TODO as $user is current assumed to be an integer
      return ($task->{'creator_id'}) == $user;
    }
}
