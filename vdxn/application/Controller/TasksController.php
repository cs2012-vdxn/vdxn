<?php

namespace Mini\Controller;

session_start();

use Mini\Model\Task;
use Mini\Model\Account;

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

    //==========================================
    // TASK FUNCTIONS
    //==========================================
    public function task() {
      $Task = new Task();
      $User = new Account();

      $username = $_SESSION['user']->{'username'};
      $title = isset($_GET['title']) ? $_GET['title'] : "";
      $creator_username = isset($_GET['creator_username']) ? $_GET['creator_username'] : "";

      $task = $Task->getTask($title, $creator_username);
      $bids = $Task->getBids($title, $creator_username);
      $bids_leaderboard = $Task->getTopNBids($title, $creator_username, 3, 'ASC');
      $bid = $Task->getUserBidForTask($title, $username);
      $category = $Task -> getCategoryOfTask($title, $creator_username);
      $tags = $Task -> getTagsOfTask($title, $creator_username);

      // Get the public profile of this task's doer & overall rating if
      // a doer has already been assigned
      $assignee = $User->getUserPublicProfile($task->{'assignee_username'});
      if ($assignee) {
        $assignee->rating = $User->getUserRating($assignee->{'username'});
      }

      // Get the current state of this task
      // e.g. Whether a doer was assigned, whether this task is completed and whether the
      //      creator / doer was rated already
      $completed_at = $Task->getTaskCompletedDate($title, $creator_username)->{'completed_at'};
      $creator_rating = $Task->getTaskCreatorRating($title, $creator_username)->{'creator_rating'};
      $assignee_rating = $Task->getTaskDoerRating($title, $creator_username)->{'assignee_rating'};

      // echo '<p>' . var_dump($task) . '</p>';
      // echo '<p>' . var_dump($bids) . '</p>';

      $isAdmin = $_SESSION['user']->{'user_type'} == 'Admin';
      $hasUserBid = $this->has_user_bid_on_task($task->title, $username);
      $isTaskOwner = $this->is_task_owner($task, $username);
      $isTaskAssignee = $this->is_task_assignee($task, $username);

      require APP . 'view/_templates/header.php';

      echo '<div class="container-fluid col-md-offset-2 col-md-8 col-xs-8 col-xs-offset-2" style="padding-bottom: 100px;">';
      require APP . 'view/tasks/task.php';
      echo '</div>';

      require APP . 'view/_templates/footer.php';
    }

    //==========================================
    // TASK SET CRUD FUNCTIONS
    //==========================================
    public function newtask() {
      require APP . 'view/_templates/header.php';
      if ($this->validate_task($_POST)) {
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
    // TASK SET STATE FUNCTIONS
    // For assigning bidders, marking as complete or rating
    //==========================================
    public function assign_bidder() {
      $Task = new Task();
      $task_creator_username = $_SESSION['user']->{'username'}; // Assumes logged in user IS the task creator

      // TODO Input Validation
      $task_title = isset($_GET['title']) ? $_GET['title'] : "";
      $task_creator_username = isset($_GET['creator_username']) ? $_GET['creator_username'] : "";
      $task_assignee_username = isset($_GET['assignee_username']) ? $_GET['assignee_username'] : "";

      // Assign this bidder to this task
      $Task->assignBidderToTask($task_title, $task_creator_username, $task_assignee_username);

      // Redirect back to this task's page
      header('location: ' . URL . 'tasks/task?title=' . $task_title . '&creator_username=' . $task_creator_username);
    }

    public function mark_as_complete() {
      $Task = new Task();
      $task_creator_username = $_SESSION['user']->{'username'}; // Assumes logged in user IS the task creator

      // TODO Input Validation
      $task_title = isset($_GET['title']) ? $_GET['title'] : "";

      // Mark this task as completed
      $Task->markTaskAsComplete($task_title, $task_creator_username);

      // Redirect back to this task's page
      header('location: ' . URL . 'tasks/task?title=' . $task_title . '&creator_username=' . $task_creator_username);
    }

    public function rate_creator() {
      $Task = new Task();

      // TODO Input Validation
      $task_title = isset($_GET['title']) ? $_GET['title'] : "";
      $task_creator_username = isset($_GET['creator_username']) ? $_GET['creator_username'] : "";
      $creator_rating = isset($_POST['task_creator_rating']) ? floatval($_POST['task_creator_rating']) : "";

      // Rate this task creator
      $Task->rateTaskCreator($task_title, $task_creator_username, $creator_rating);

      // Redirect back to this task's page
      header('location: ' . URL . 'tasks/task?title=' . $task_title . '&creator_username=' . $task_creator_username);
    }

    public function rate_assignee() {
      $Task = new Task();

      // TODO Input Validation
      $task_title = isset($_GET['title']) ? $_GET['title'] : "";
      $task_creator_username = isset($_GET['creator_username']) ? $_GET['creator_username'] : "";
      $doer_rating = isset($_POST['task_doer_rating']) ? floatval($_POST['task_doer_rating']) : "";

      // Rate this task doer
      $Task->rateTaskDoer($task_title, $task_creator_username, $doer_rating);

      // Redirect back to this task's page
      header('location: ' . URL . 'tasks/task?title=' . $task_title . '&creator_username=' . $task_creator_username);
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

    /**
     * search task by title, category and tags.
     */
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
          <td>Event Date</td>
          <td>Expiry</td>
          <td>Min Bid</td>
          <td>Max Bid</td>
          <td>Creator</td>
          <td>Assignee</td>
          <td>Completed At</td>
          <td>Category</td>
          <td>Tags</td>
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
              $category = $Task -> getCategoryOfTask($result->title, $result->creator_username);
              $tags = $Task -> getTagsOfTask($result->title, $result->creator_username);
            $d_title_bold = preg_replace("/" . $search_string . "/i", "<b>" . $search_string . "</b>", $result->title);
              $d_title = "<a href='/tasks/task?title=" .
                  $result->title . "&creator_username=" .
                  $result->creator_username .
                  "'> $d_title_bold </a>";
            $d_description = $result->description;
            $d_createTime = $result->created_at;
            $d_expiry = isset($result->end_at) ? $result->end_at : null;
            $d_eventDate = isset($result->start_at) ? $result->start_at : null;
            $d_minBid = $result->min_bid;
            $d_maxBid = $result->max_bid;
            $d_creator = $result->creator_username;
              $d_assignee = $result -> assignee_username;
              $d_category = preg_replace("/" . $search_string . "/i", "<b>" . $search_string . "</b>", $category);
              $d_tags = preg_replace("/" . $search_string . "/i", "<b>" . $search_string . "</b>", $tags);
            // Replace the items into above HTML
            $o = str_replace('Title', $d_title, $html);
            $o = str_replace('Description', $d_description, $o);
            $o = str_replace('Create time', $d_createTime, $o);
            $o = str_replace('Expiry', $d_expiry, $o);
            $o = str_replace('Event Date', $d_eventDate, $o);
            $o = str_replace('Min Bid', $d_minBid, $o);
            $o = str_replace('Max Bid', $d_maxBid, $o);
            $o = str_replace('Creator', $d_creator, $o);
              $o = str_replace('Assignee', $d_assignee, $o);
              $o = str_replace('Completed At', '', $o);
              $o = str_replace('Category', $d_category, $o);
              $o = str_replace('Tags', $d_tags, $o);
            // Output it
            echo($o);
          }
        } else {
          // Replace for no results
          $o = str_replace('Title', '<span class="label label-danger">No Tasks Found</span>', $html);
          $o = str_replace('Description', '', $o);
          $o = str_replace('Create time', '', $o);
          $o = str_replace('Expiry', '', $o);
          $o = str_replace('Event Date', '', $o);
          $o = str_replace('Min Bid', '', $o);
          $o = str_replace('Max Bid', '', $o);
          $o = str_replace('Creator', '', $o);
            $o = str_replace('Assignee', '', $o);
            $o = str_replace('Completed At', '', $o);
            $o = str_replace('Category', '', $o);
            $o = str_replace('Tags', '', $o);
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
            $category = $Task -> getCategoryOfTask($result->title, $result->creator_username);
            $tags = $Task -> getTagsOfTask($result->title, $result->creator_username);
            $d_title = "<a href='/tasks/task?title=" .
                $result->title . "&creator_username=" .
                $result->creator_username .
                "'> $result->title </a>";
          $d_description = $result->description;
          $d_createTime = $result->created_at;
          $d_expiry = isset($result->end_at) ? $result->end_at : null;
          $d_eventDate = isset($result->start_at) ? $result->start_at : null;
          $d_minBid = $result->min_bid;
          $d_maxBid = $result->max_bid;
          $d_creator = $result->creator_username;
          $d_assignee = $result -> assignee_username;
          // Replace the items into above HTML
          $o = str_replace('Title', $d_title, $html);
          $o = str_replace('Description', $d_description, $o);
          $o = str_replace('Create time', $d_createTime, $o);
          $o = str_replace('Expiry', $d_expiry, $o);
          $o = str_replace('Event Date', $d_eventDate, $o);
          $o = str_replace('Min Bid', $d_minBid, $o);
          $o = str_replace('Max Bid', $d_maxBid, $o);
          $o = str_replace('Creator', $d_creator, $o);
            $o = str_replace('Assignee', $d_assignee, $o);
            $o = str_replace('Completed At', '', $o);
            $o = str_replace('Category', $category, $o);
            $o = str_replace('Tags', $tags, $o);
          // Output it
          echo($o);
        }
      }
    }

    //==========================================
    // TASK SORTING FUNCTIONS
    //==========================================

    public function filterByAttributes() {
        $Task = new Task();
        $str = $_POST['query'];
        // REMOVED because we can connect to the DB from methods in the Task Model
        // $search_string = $test_db->real_escape_string($search_string);

        $html = '
        <tr>
          <td>Title</td>
          <td>Description</td>
          <td>Create time</td>
          <td>Event Date</td>
          <td>Expiry</td>
          <td>Min Bid</td>
          <td>Max Bid</td>
          <td>Creator</td>
          <td>Assignee</td>
          <td>Completed At</td>
          <td>Category</td>
          <td>Tags</td>
        </tr>';

        // Check if length is more than 1 character
        if (strlen($str) >= 1 && $str != " ") {

            // Do the search
            $result_array = $Task->sortAllTasks($str);

            // Check for results
            if (isset($result_array)) {
                foreach ($result_array as $result) {
                    // Output strings and highlight the matches
                    $category = $Task -> getCategoryOfTask($result->title, $result->creator_username);
                    $tags = $Task -> getTagsOfTask($result->title, $result->creator_username);
                    $d_title = "<a href='/tasks/task?title=" .
                        $result->title . "&creator_username=" .
                        $result->creator_username .
                        "'> $result->title </a>";
                    $d_description = $result->description;
                    $d_createTime = $result->created_at;
                    $d_expiry = isset($result->end_at) ? $result->end_at : null;
                    $d_eventDate = isset($result->start_at) ? $result->start_at : null;
                    $d_minBid = $result->min_bid;
                    $d_maxBid = $result->max_bid;
                    $d_creator = $result->creator_username;
                    $d_assignee = $result -> assignee_username;
                    // Replace the items into above HTML
                    $o = str_replace('Title', $d_title, $html);
                    $o = str_replace('Description', $d_description, $o);
                    $o = str_replace('Create time', $d_createTime, $o);
                    $o = str_replace('Expiry', $d_expiry, $o);
                    $o = str_replace('Event Date', $d_eventDate, $o);
                    $o = str_replace('Min Bid', $d_minBid, $o);
                    $o = str_replace('Max Bid', $d_maxBid, $o);
                    $o = str_replace('Creator', $d_creator, $o);
                    $o = str_replace('Assignee', $d_assignee, $o);
                    $o = str_replace('Completed At', '', $o);
                    $o = str_replace('Category', $category, $o);
                    $o = str_replace('Tags', $tags, $o);
                    // Output it
                    echo($o);
                }
            } else {
                // Replace for no results
                $o = str_replace('Title', '<span class="label label-danger">No Tasks Found</span>', $html);
                $o = str_replace('Description', '', $o);
                $o = str_replace('Create time', '', $o);
                $o = str_replace('Expiry', '', $o);
                $o = str_replace('Event Date', '', $o);
                $o = str_replace('Min Bid', '', $o);
                $o = str_replace('Max Bid', '', $o);
                $o = str_replace('Creator', '', $o);
                $o = str_replace('Assignee', '', $o);
                $o = str_replace('Completed At', '', $o);
                $o = str_replace('Category', '', $o);
                $o = str_replace('Tags', '', $o);
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
                $category = $Task -> getCategoryOfTask($result->title, $result->creator_username);
                $tags = $Task -> getTagsOfTask($result->title, $result->creator_username);
                $d_title = "<a href='/tasks/task?title=" .
                    $result->title . "&creator_username=" .
                    $result->creator_username .
                    "'> $result->title </a>";
                $d_description = $result->description;
                $d_createTime = $result->created_at;
                $d_expiry = isset($result->end_at) ? $result->end_at : null;
                $d_eventDate = isset($result->start_at) ? $result->start_at : null;
                $d_minBid = $result->min_bid;
                $d_maxBid = $result->max_bid;
                $d_creator = $result->creator_username;
                $d_assignee = $result -> assignee_username;
                // Replace the items into above HTML
                $o = str_replace('Title', $d_title, $html);
                $o = str_replace('Description', $d_description, $o);
                $o = str_replace('Create time', $d_createTime, $o);
                $o = str_replace('Expiry', $d_expiry, $o);
                $o = str_replace('Event Date', $d_eventDate, $o);
                $o = str_replace('Min Bid', $d_minBid, $o);
                $o = str_replace('Max Bid', $d_maxBid, $o);
                $o = str_replace('Creator', $d_creator, $o);
                $o = str_replace('Assignee', $d_assignee, $o);
                $o = str_replace('Completed At', '', $o);
                $o = str_replace('Category', $category, $o);
                $o = str_replace('Tags', $tags, $o);
                // Output it
                echo($o);
            }
        }
    }

    //==========================================
    // TASK FILTER FUNCTIONS
    //==========================================

    public function filterTasks() {
        $Task = new Task();
        $str = $_POST['query'];

        $html = '
        <tr>
          <td>Title</td>
          <td>Description</td>
          <td>Create time</td>
          <td>Event Date</td>
          <td>Expiry</td>
          <td>Min Bid</td>
          <td>Max Bid</td>
          <td>Creator</td>
          <td>Assignee</td>
          <td>Completed At</td>
          <td>Category</td>
          <td>Tags</td>
        </tr>';

        // Check if length is more than 1 character
        if (strlen($str) >= 1 && $str != " ") {

            // Do the search
            $result_array = $Task->filterAllTasks($str);

            // Check for results
            if (isset($result_array)) {
                foreach ($result_array as $result) {
                    // Output strings and highlight the matches
                    $category = $Task -> getCategoryOfTask($result->title, $result->creator_username);
                    $tags = $Task -> getTagsOfTask($result->title, $result->creator_username);
                    $d_title = "<a href='/tasks/task?title=" .
                        $result->title . "&creator_username=" .
                        $result->creator_username .
                        "'> $result->title </a>";
                    $d_description = $result->description;
                    $d_createTime = $result->created_at;
                    $d_expiry = isset($result->end_at) ? $result->end_at : null;
                    $d_eventDate = isset($result->start_at) ? $result->start_at : null;
                    $d_minBid = $result->min_bid;
                    $d_maxBid = $result->max_bid;
                    $d_creator = $result->creator_username;
                    $d_assignee = $result -> assignee_username;
                    // Replace the items into above HTML
                    $o = str_replace('Title', $d_title, $html);
                    $o = str_replace('Description', $d_description, $o);
                    $o = str_replace('Create time', $d_createTime, $o);
                    $o = str_replace('Expiry', $d_expiry, $o);
                    $o = str_replace('Event Date', $d_eventDate, $o);
                    $o = str_replace('Min Bid', $d_minBid, $o);
                    $o = str_replace('Max Bid', $d_maxBid, $o);
                    $o = str_replace('Creator', $d_creator, $o);
                    $o = str_replace('Assignee', $d_assignee, $o);
                    $o = str_replace('Completed At', '', $o);
                    $o = str_replace('Category', $category, $o);
                    $o = str_replace('Tags', $tags, $o);
                    // Output it
                    echo($o);
                }
            } else {
                // Replace for no results
                $o = str_replace('Title', '<span class="label label-danger">No Tasks Found</span>', $html);
                $o = str_replace('Description', '', $o);
                $o = str_replace('Create time', '', $o);
                $o = str_replace('Expiry', '', $o);
                $o = str_replace('Event Date', '', $o);
                $o = str_replace('Min Bid', '', $o);
                $o = str_replace('Max Bid', '', $o);
                $o = str_replace('Creator', '', $o);
                $o = str_replace('Assignee', '', $o);
                $o = str_replace('Completed At', '', $o);
                $o = str_replace('Category', '', $o);
                $o = str_replace('Tags', '', $o);
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
                $category = $Task -> getCategoryOfTask($result->title, $result->creator_username);
                $tags = $Task -> getTagsOfTask($result->title, $result->creator_username);
                $d_title = "<a href='/tasks/task?title=" .
                    $result->title . "&creator_username=" .
                    $result->creator_username .
                    "'> $result->title </a>";
                $d_description = $result->description;
                $d_createTime = $result->created_at;
                $d_expiry = isset($result->end_at) ? $result->end_at : null;
                $d_eventDate = isset($result->start_at) ? $result->start_at : null;
                $d_minBid = $result->min_bid;
                $d_maxBid = $result->max_bid;
                $d_creator = $result->creator_username;
                $d_assignee = $result -> assignee_username;
                // Replace the items into above HTML
                $o = str_replace('Title', $d_title, $html);
                $o = str_replace('Description', $d_description, $o);
                $o = str_replace('Create time', $d_createTime, $o);
                $o = str_replace('Expiry', $d_expiry, $o);
                $o = str_replace('Event Date', $d_eventDate, $o);
                $o = str_replace('Min Bid', $d_minBid, $o);
                $o = str_replace('Max Bid', $d_maxBid, $o);
                $o = str_replace('Creator', $d_creator, $o);
                $o = str_replace('Assignee', $d_assignee, $o);
                $o = str_replace('Completed At', '', $o);
                $o = str_replace('Category', $category, $o);
                $o = str_replace('Tags', $tags, $o);
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

    private function is_task_assignee($task, $username) {
      return $task->assignee_username == $username;
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
