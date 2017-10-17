<?php

namespace Mini\Controller;

session_start();

use Mini\Model\Task;

class TasksController {
    public function index() {
      $Task = new Task();
      // getting all songs and amount of songs
      $tasks = $Task->getAllTasks();
      // load views
      require APP . 'view/_templates/header.php';
      require APP . 'view/tasks/index.php';
      require APP . 'view/_templates/footer.php';
    }

    public function task() {
      $Task = new Task();

      $username = $_SESSION['user']->{'username'};
      $title = isset($_GET['title']) ? $_GET['title'] : "";
      $creator_username = isset($_GET['creator_username']) ? $_GET['creator_username'] : "";

      $task = $Task->getTask($title, $creator_username);
      $bids = $Task->getTopNBids($title, $creator_username, 3, 'ASC');
      $bid = $Task->getUserBidForTask($title, $username);

      // echo '<p>' . var_dump($task) . '</p>';
      // echo '<p>' . var_dump($bids) . '</p>';

      $hasUserBid = $this->has_user_bid_on_task($task->title, $username);
      $isTaskOwner = $this->is_task_owner($task, $username);

      require APP . 'view/_templates/header.php';

      echo '<div class="container-fluid col-md-offset-2 col-md-8 col-xs-8 col-xs-offset-2" style="padding-bottom: 100px;">';
      require APP . 'view/tasks/task.php';
      echo '</div>';

      require APP . 'view/_templates/footer.php';
    }

    public function newtask() {
      require APP . 'view/_templates/header.php';
      if ($this->validate_task($_POST)) {
          //TODO
          $clean_task_params = $_POST;
          $Task = new Task();
          $task = $Task->createTask($clean_task_params);
          require APP . 'view/tasks/taskcreated.php';
      } else {
          require APP . 'view/tasks/new.php';
      }
      require APP . 'view/_templates/footer.php';
    }

    public function edittask() {
      $title = $_GET['title'];
      $creator_username = $_GET['creator_username'];

      require APP . 'view/_templates/header.php';
      $Task = new Task();

      if ($this->validate_task($_POST)) {
          //TODO
          $clean_task_params = $_POST;
          if ($Task->editTask($title, $creator_username, $clean_task_params)) {
              require APP . 'view/tasks/taskedited.php';
          } else {
              die("ERROR TO CATCH");
          }
      } else {
          $task = $Task->getTask($title, $creator_username);
          require APP . 'view/tasks/edit.php';
      }
      require APP . 'view/_templates/footer.php';
    }

    public function deletetask() {
      require APP . 'view/_templates/header.php';
      $title = $_GET['title'];
      $creator_username = $_GET['creator_username'];
      $successful_delete = false;
      if (true) {
          $Task = new Task();
          if ($Task->deleteTask($title, $creator_username)) {
              $successful_delete = true;
          }
      }

      if ($successful_delete) {
          require APP . 'view/tasks/taskdeleted.php';
      } else {
          require APP . 'view/tasks/tasknotdeleted.php';
      }
      require APP . 'view/_templates/footer.php';
    }





    //==========================================
    // BIDDING FUNCTIONS
    //==========================================
    public function newbid() {
      $Task = new Task();

      // TODO Input Validation
      $task_title = isset($_GET['title']) ? $_GET['title'] : "";
      $task_creator_username = isset($_GET['creator_username']) ? $_GET['creator_username'] : "";
      $bid_amount = isset($_POST['bid_amount']) ? (int)$_POST['bid_amount'] : "";
      $bid_details = isset($_POST['bid_details']) ? $this->sanitize($_POST['bid_details']) : "";

      // Save this bid to database
      $Task->createTaskBid($task_title, $task_creator_username, $bid_amount, $bid_details);

      // Redirect back to this task's page
      header('location: ' . URL . 'tasks/task?title=' . $task_title . '&creator_username=' . $task_creator_username);
    }

    public function edit_bid() {
      $Task = new Task();
      $username = $_SESSION['user']->{'username'};

      // TODO Input Validation
      $task_title = isset($_GET['title']) ? $_GET['title'] : "";
      $task_creator_username = isset($_GET['creator_username']) ? $_GET['creator_username'] : "";
      $bid_amount = isset($_POST['edited_bid_amount']) ? (int)$_POST['edited_bid_amount'] : "";
      $bid_details = isset($_POST['edited_bid_details']) ? $this->sanitize($_POST['edited_bid_details']) : "";

      $Task->editTaskBid($task_title, $task_creator_username, $username, $bid_amount, $bid_details);

      // Redirect back to this task's page
      header('location: ' . URL . 'tasks/task?title=' . $task_title . '&creator_username=' . $task_creator_username);
    }

    public function del_bid() {
      $Task = new Task();
      $username = $_SESSION['user']->{'username'};

      // TODO Input Validation
      $task_title = isset($_GET['title']) ? $_GET['title'] : "";
      $task_creator_username = isset($_GET['creator_username']) ? $_GET['creator_username'] : "";

      $Task->deleteTaskBid($task_title, $task_creator_username, $username);

      // Redirect back to this task's page
      header('location: ' . URL . 'tasks/task?title=' . $task_title . '&creator_username=' . $task_creator_username);
    }






    //==========================================
    // TASKS SEARCH FUNCTIONS
    //==========================================
    public function searchByTitle() {
      $Task = new Task();

      $search_string = preg_replace("/[^A-Za-z0-9]/", " ", $_POST['query']);

      // REMOVED because we can connect to the DB from methods in the Task Model
      // $search_string = $test_db->real_escape_string($search_string);

      $html = '
        <tr>
          <td>Title</td>
          <td>Description</td>
          <td>Create time</td>
          <td>Updated time</td>
          <td>Expiry</td>
          <td>Event Date</td>
          <td>Min Bid</td>
          <td>Max Bid</td>
          <td>Tasker</td>
        </tr>';

      // Check if length is more than 1 character
      if (strlen($search_string) >= 1 && $search_string !== ' ') {

        // Do the search
        $result_array = $Task->findAllTasksContaining($search_string);

        // REMOVED because we can find the tasks by using methods from the Task Model
        // $result = $test_db->query($query);
        // while($results = $result->fetch_array()) {
        //     $result_array[] = $results;
        // }

        // Check for results
        if (isset($result_array)) {
          foreach ($result_array as $result) {
            // Output strings and highlight the matches
            $d_title = preg_replace("/" . $search_string . "/i", "<b>" . $search_string . "</b>", $result->title);
            $d_description = $result->description;
            $d_createTime = $result->created_at;
            $d_updateTime = $result->updated_at;
            $d_expiry = isset($result->end_at) ? $result->end_at : null;
            $d_eventDate = isset($result->start_at) ? $result->start_at : null;
            $d_minBid = $result->min_bid;
            $d_maxBid = $result->max_bid;
            $d_tasker = $result->assignee_username;
            // Replace the items into above HTML
            $o = str_replace('Title', $d_title, $html);
            $o = str_replace('Description', $d_description, $o);
            $o = str_replace('Create time', $d_createTime, $o);
            $o = str_replace('Updated time', $d_updateTime, $o);
            $o = str_replace('Expiry', $d_expiry, $o);
            $o = str_replace('Event Date', $d_eventDate, $o);
            $o = str_replace('Min Bid', $d_minBid, $o);
            $o = str_replace('Max Bid', $d_maxBid, $o);
            $o = str_replace('Tasker', $d_tasker, $o);
            // Output it
            echo($o);
          }
        } else {
          // Replace for no results
          $o = str_replace('Title', '<span class="label label-danger">No Tasks Found</span>', $html);
          $o = str_replace('Description', '', $o);
          $o = str_replace('Create time', '', $o);
          $o = str_replace('Updated time', '', $o);
          $o = str_replace('Expiry', '', $o);
          $o = str_replace('Event Date', '', $o);
          $o = str_replace('Min Bid', '', $o);
          $o = str_replace('Max Bid', '', $o);
          $o = str_replace('Tasker', '', $o);
          // Output
          echo($o);
        }
      } else {
        $query = 'SELECT * FROM Task';

        // Do the search
        $result_array = $Task->getAllTasks();

        // REMOVED because we can find all tasks by using methods from the Task Model
        // $result = $test_db->query($query);
        // while ($results = $result->fetch_array()) {
        //     $result_array[] = $results;
        // }

        // Check for results
        foreach ($result_array as $result) {
          // Output strings and highlight the matches
          $d_title =  $result->title;
          $d_description = $result->description;
          $d_createTime = $result->created_at;
          $d_updateTime = $result->updated_at;
          $d_expiry = isset($result->end_at) ? $result->end_at : null;
          $d_eventDate = isset($result->start_at) ? $result->start_at : null;
          $d_minBid = $result->min_bid;
          $d_maxBid = $result->max_bid;
          $d_tasker = $result->assignee_username;
          // Replace the items into above HTML
          $o = str_replace('Title', $d_title, $html);
          $o = str_replace('Description', $d_description, $o);
          $o = str_replace('Create time', $d_createTime, $o);
          $o = str_replace('Updated time', $d_updateTime, $o);
          $o = str_replace('Expiry', $d_expiry, $o);
          $o = str_replace('Event Date', $d_eventDate, $o);
          $o = str_replace('Min Bid', $d_minBid, $o);
          $o = str_replace('Max Bid', $d_maxBid, $o);
          $o = str_replace('Tasker', $d_tasker, $o);
          // Output it
          echo($o);
        }
      }
    }

    //==========================================
    // PRIVATE HELPER FUNCTIONS
    //==========================================
    private function validate_task($params) {
      return isset($params['title']) && isset($params['description']);
    }

    private function can_delete_task($tid, $user) {
      return true;
    }

    private function has_user_bid_on_task($title, $username) {
      $Task = new Task();
      if ($Task->getUserBidForTask($title, $username)) {
        return true;
      } else {
        return false;
      }
    }

    private function is_task_owner($task, $username) {
      return $task->creator_username == $username;
    }

    private function sanitize($data) {
      $data = trim($data);
      $data = stripslashes($data);

      // We need to escape single and double quotes or our prepared SQL
      // statements will throw a Syntax Error
      $data = str_replace('"', '', $data);
      $data = str_replace("'", '', $data);

      return $data;
    }

}
