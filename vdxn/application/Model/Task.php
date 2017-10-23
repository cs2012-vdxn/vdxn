<?php

namespace Mini\Model;

use Mini\Core\Model;

class Task extends Model
{
    /**
     * Get all tasks from database
     */
     public function getAllTasks()
     {
         $sql = 'SELECT * FROM Task';
         $query = $this->db->prepare($sql);
         $query->execute();
         return $query->fetchAll();
     }

    public function getTask($title, $creator_username)
    {
      $sql = "SELECT * FROM Task WHERE title='$title' AND creator_username='$creator_username'";
      $query = $this->db->prepare($sql);
      $query->execute();
      return $query->fetch();
    }

    public function getAllUserTasks($tkername, $offset = NULL, $limit = NULL, $order_by = NULL, $dir = 'ASC')
    {
      $sql = $this->getAllUserTasksQuery($tkername, $offset, $limit, $order_by, $dir);
      $query = $this->db->prepare($sql);
      $query->execute();
      return $query->fetchAll();
    }

    public function getAllUserTasksQuery($tkername, $offset = NULL, $limit = NULL, $order_by = NULL, $dir = 'ASC')
    {
      $sql = "SELECT title, description, created_at,
      start_at, updated_at, min_bid, max_bid, assignee_username, creator_rating,
      assignee_rating
      FROM Task WHERE creator_username='$tkername' AND completed_at IS NULL";
      if(isset($order_by)) {
        if(!isset($dir)) {
          $dir = 'ASC';
        }
        $sql .= " ORDER BY $order_by $dir";
      }
      if(isset($limit)) {
        $sql .= " LIMIT $limit";
      }
      if(isset($offset)) {
        $sql .= " OFFSET $offset";
      }

      return $sql;
    }

    public function getAllHistoryUserTasks($tkername, $offset = NULL, $limit = NULL, $order_by = NULL, $dir = 'ASC')
    {
      // tasks created by this user and has been completed
      $sql = $this->getAllHistoryUserTasksQuery($tkername, $offset, $limit, $order_by, $dir);
      $query = $this->db->prepare($sql);
      $query->execute();
      return $query->fetchAll();
    }

    public function getAllHistoryUserTasksQuery($tkername, $offset = NULL, $limit = NULL, $order_by = NULL, $dir = 'ASC')
    {
      $sql = "SELECT title, description, created_at,
      start_at, completed_at, assignee_username, creator_rating,
      assignee_rating
      FROM Task WHERE creator_username='$tkername' AND completed_at IS NOT NULL";
      if(isset($order_by)) {
        if(!isset($dir)) {
          $dir = 'ASC';
        }
        $sql .= " ORDER BY $order_by $dir";
      }
      if(isset($limit)) {
        $sql .= " LIMIT $limit";
      }
      if(isset($offset)) {
        $sql .= " OFFSET $offset";
      }
      return $sql;
    }

    public function getAllCurrentBiddedTasks($bdername,$offset = NULL, $limit = NULL, $order_by = NULL, $dir = 'ASC')
    {
      // tasks this user has bidded for
      $sql = $this->getAllCurrentBiddedTasksQuery($bdername, $offset, $limit, $order_by, $dir);
      $query = $this->db->prepare($sql);
      $query->execute();
      return $query->fetchAll();
    }

    public function getAllCurrentBiddedTasksQuery($bdername, $offset = NULL, $limit = NULL, $order_by = NULL, $dir = 'ASC')
    {
      $sql = "SELECT title, description,
      start_at, MIN(b2.amount) as curr_min_bid, MAX(b2.amount) as curr_max_bid, myBid /* my current bid */,
      creator_username, creator_rating,
      assignee_rating
      FROM (
      SELECT title, description,
      start_at, b1.amount as myBid /* my current bid */,
      creator_username, creator_rating,
      assignee_rating FROM
      Task
      INNER JOIN Bid b1 ON Task.creator_username=b1.task_creator_username AND Task.title = b1.task_title
      WHERE b1.bidder_username='$bdername' AND Task.assignee_username IS NULL) t
      INNER JOIN Bid b2 ON b2.task_title = t.title AND b2.task_creator_username = t.creator_username";
      if(isset($order_by)) {
        if(!isset($dir)) {
          $dir = 'ASC';
        }
        $sql .= " ORDER BY $order_by $dir";
      }
      if(isset($limit)) {
        $sql .= " LIMIT $limit";
      }
      if(isset($offset)) {
        $sql .= " OFFSET $offset";
      }
      return $sql;
    }

    public function getAllHistoryBiddedTasks($bdername, $offset = NULL, $pagesize = NULL, $order_by = NULL, $dir = 'ASC')
    {
      // tasks this user has bidded for and has had an assignee chosen
      $sql = $this->getAllHistoryBiddedTasksQuery($bdername, $offset, $pagesize, $order_by, $dir);
      $query = $this->db->prepare($sql);
      $query->execute();
      return $query->fetchAll();
    }

    public function getAllHistoryBiddedTasksQuery($bdername, $offset = NULL, $limit = NULL, $order_by = NULL, $dir = 'ASC') {
      $sql = "SELECT title, description,
      start_at, myBid, winningBid.amount as winning_bid, creator_username,
      assignee_username
      FROM
      ((SELECT title, description,
      start_at, myBid.amount as myBid, creator_username,
      assignee_username FROM Task
      INNER JOIN Bid myBid ON Task.creator_username=task_creator_username AND Task.title = myBid.task_title
      INNER JOIN User ON username=bidder_username
      WHERE bidder_username='$bdername' AND assignee_username IS NOT NULL) t
      INNER JOIN Bid winningBid ON winningBid.bidder_username=t.assignee_username AND t.title = winningBid.task_title
      INNER JOIN User winner ON winner.username = t.assignee_username)";
      if(isset($order_by)) {
        if(!isset($dir)) {
          $dir = 'ASC';
        }
        $sql .= " ORDER BY $order_by $dir";
      }
      if(isset($limit)) {
        $sql .= " LIMIT $limit";
        if(isset($offset)) {
          $sql .= " OFFSET $offset";
        }
      }

      return $sql;
    }

    /**
     * Find all tasks whose title matches the string pattern.
     *
     * @param $search_string   String pattern to be matched
     * @return mixed
     */

    public function findAllTasksContaining($search_string)
    {
      $sql = 'SELECT * FROM (Task t LEFT JOIN Tag_task g ON t.title = g.task_title AND t.creator_username = g.task_creator_username) 
              LEFT JOIN Category_task c ON t.title = c.task_title AND t.creator_username = c.task_creator_username
              WHERE t.title LIKE "%' . $search_string . '%"  OR g.tag_name LIKE "%' . $search_string . '%" OR c.category_name LIKE "%' . $search_string . '%"';
      $query = $this->db->prepare($sql);
      $query->execute();
      return $query->fetchAll();
    }

    /**
     * Sort all tasks by given attributes.
     *
     * @param $attribute_str
     * @return mixed
     */

    public function sortAllTasks($attribute_str) {
        $sql = "SELECT Task.title, Task.description, Task.created_at, Task.updated_at, Task.start_at, Task.end_at,
        Task.min_bid, Task.max_bid, Task.creator_username, Task.assignee_username, Task.completed_at, 
        Task.remarks, TIMESTAMPDIFF(SECOND, Task.end_at, Task.start_at) AS duration FROM Task ORDER BY $attribute_str";
        echo $sql;
        $query = $this -> db -> prepare($sql);
        $query -> execute();
        return $query -> fetchAll();
    }

    public function createTask($task_params)
    {
      $sql = "INSERT INTO `mini`.`Task`
      (
      `title`,
      `description`,
      `created_at`,
      `updated_at`,
      `start_at`,
      `min_bid`,
      `max_bid`,
      `creator_username`,
      `assignee_username`,
      `deleted_at`,
      `completed_at`,
      `creator_rating`,
      `assignee_rating`)
      VALUES (
      '".$task_params['title']."',
      '".$task_params['description']."',
      '2017-09-24 03:09:10',
      '2017-09-24 03:09:10',
      '2017-09-27 04:10:14',
      '5',
      '100',
      '".$_SESSION['user']->username."',
      NULL,
      NULL,
      NULL,
      NULL,
      NULL)";
      $tags_string = $task_params['tagsinput'];
      $tags_arr = explode(",", $tags_string);
      for($i = 0; $i < sizeof($tags_arr); $i++) {
          if($this -> existsTag($tags_arr[$i])) {
              $this->createTagTask($tags_arr[$i], $_SESSION['user']->username, $task_params['title'], '2017-09-24 03:09:10');
          } else {
              $this -> createTag($tags_arr[$i], '2017-09-24 03:09:10');
              $this->createTagTask($tags_arr[$i], $_SESSION['user']->username, $task_params['title'], '2017-09-24 03:09:10');
          }
      }
      $this -> createCategoryTask($_SESSION['user']->username,$task_params['title'], $task_params['category'],'2017-09-24 03:09:10');
      $query = $this->db->prepare($sql);
      return $query->execute();
    }

    public function createCategoryTask($creator_name, $task_title, $task_category,$created_at) {
         $sql = "INSERT INTO `mini`.`Category_task`
         (`category_name`,
         `task_title`,
         `task_creator_username`,
         `created_at`,
         `updated_at`,
         `deleted_at`)
         VALUES (
         '".$task_category."',
         '".$task_title."',
         '".$creator_name."',
         '".$created_at."',
         NULL,
         NULL
         )";
         $query = $this -> db -> prepare($sql);
         return $query -> execute();
    }

    /**
     * check if a tag exists in the database, and return a boolean value of whether the tag exists.
     *
     * @param $tag_name Name of the tag
     * @return bool     Boolean value indicating whether tag exists in Tag table.
     */
    public function existsTag($tag_name) {
         $sql = "SELECT COUNT(*) AS count FROM Tag WHERE Tag.name = '$tag_name'";
         $query = $this -> db -> prepare($sql);
         $query -> execute();
         $result = $query -> fetch();
         return $result -> count != 0;
    }

    /**
     * Create a tag instance in Tag table
     *
     * @param $tag_name     Name of tag
     * @param $created_at   Time of tag creation
     * @return mixed
     */

    public function createTag($tag_name, $created_at) {
        $sql = "INSERT INTO `mini`.`Tag`
         (`name`,
         `created_at`,
         `updated_at`,
         `deleted_at`)
         VALUES (
         '".$tag_name."',
         '".$created_at."',
         NULL,
         NULL
         )";
        $query = $this -> db -> prepare($sql);
        return $query -> execute();
    }

    /**
     * Create an instance of tag-task relationship in Tag_task table.
     *
     * @param $tag_name          Name of tag
     * @param $creator_name      Username of task creator
     * @param $task_title        Title of task
     * @param $created_at        Time of task creation
     * @return mixed
     */
    public function createTagTask($tag_name, $creator_name, $task_title, $created_at){
        $sql = "INSERT INTO `mini`.`Tag_task`
         (`tag_name`,
         `task_creator_username`,
         `task_title`,
         `created_at`,
         `updated_at`,
         `deleted_at`)
         VALUES (
         '".$tag_name."',
         '".$creator_name."',
         '".$task_title."',
         '".$created_at."',
         NULL,
         NULL
         )";
        $query = $this -> db -> prepare($sql);
        return $query -> execute();
    }

    public function deleteTask($title, $creator_username)
    {
      // TODO: check if user is authenticated and allowed to delete task
      $sql = "DELETE FROM Task WHERE Task.title='$title' AND Task.creator_username='$creator_username';";
      $query = $this->db->prepare($sql);
      return $query->execute();
    }

    public function editTask($title, $creator_username, $params)
    {
      // TODO: check if user is authenticated and allowed to edit task
      $sql = "UPDATE `Task` SET `title` = '".$params['title']."',
        `description` = '".$params['description']."',
        `start_at` = '2017-09-25 00:00:00',
        `min_bid` = '".$params['min_bid']."',
        `max_bid` = '".$params['max_bid']."'
        WHERE `Task`.title='$title' AND Task.creator_username='$creator_username'";
      $query = $this->db->prepare($sql);
      return $query->execute();
    }

    //==========================================
    // TASK CREATOR ASSIGNING DOER FUNCTIONS
    //==========================================
    /**
     * Gets the specified user attributes of a task's assignee / doer.
     *
     * @param  String $task_title               Title of the task
     * @param  String $task_creator_username    Username of the task creator
     * @return Object    User profile of the assignee/doer for this task
     */
    public function getTaskAssigneeUserProfile($task_title, $task_creator_username)
    {
      $sql = "SELECT username, first_name, last_name, contact, email, assignee_rating FROM Task t, User u ".
        "WHERE t.title = '".$task_title.
        "' AND t.creator_username = '".$task_creator_username.
        "' AND t.assignee_username = u.username";
      $query = $this->db->prepare($sql);
      $query->execute();
      return $query->fetch();
    }

    /**
     * Gets the date when this task was marked as completed by the task creator.
     *
     * @param  String $task_title               Title of the task
     * @param  String $task_creator_username    Username of the task creator
     * @return String    Date of completion of this task
     */
    public function getTaskCompletedDate($task_title, $task_creator_username)
    {
      $sql = "SELECT completed_at FROM Task t ".
        "WHERE t.title = '".$task_title.
        "' AND t.creator_username = '".$task_creator_username."'";
      $query = $this->db->prepare($sql);
      $query->execute();
      return $query->fetch();
    }

    /**
     * Gets this task's creator rating.
     *
     * @param  String $task_title               Title of the task
     * @param  String $task_creator_username    Username of the task creator
     * @return Float     Task creator's rating
     */
    public function getTaskCreatorRating($task_title, $task_creator_username)
    {
      $sql = "SELECT creator_rating FROM Task t ".
        "WHERE t.title = '".$task_title.
        "' AND t.creator_username = '".$task_creator_username."'";
      $query = $this->db->prepare($sql);
      $query->execute();
      return $query->fetch();
    }

    /**
     * Gets this task's doer's rating.
     *
     * @param  String $task_title               Title of the task
     * @param  String $task_creator_username    Username of the task creator
     * @return Float     Task doer's rating
     */
    public function getTaskDoerRating($task_title, $task_creator_username)
    {
      $sql = "SELECT assignee_rating FROM Task t ".
        "WHERE t.title = '".$task_title.
        "' AND t.creator_username = '".$task_creator_username."'";
      $query = $this->db->prepare($sql);
      $query->execute();
      return $query->fetch();
    }

    /**
     * Marks a Task as completed. This is done by the Task creator.
     *
     * @param  String $task_title               Title of the task
     * @param  String $task_creator_username    Username of the task creator
     */
    public function markTaskAsComplete($task_title, $task_creator_username)
    {
      $sql = "UPDATE Task ".
        "SET completed_at='2017-10-10 14:53:12'".
        " WHERE title='".$task_title."' AND creator_username='".$task_creator_username."';";
      $query = $this->db->prepare($sql);
      return $query->execute();
    }

    /**
     * Assigns a bidder to the Task. This is done by the Task creator.
     *
     * @param  String $task_title               Title of the task
     * @param  String $task_creator_username    Username of the task creator
     * @param  String $bidder_username          Username of the bidder
     */
    public function assignBidderToTask($task_title, $task_creator_username, $bidder_username)
    {
      $sql = "UPDATE Task ".
        "SET assignee_username='".$bidder_username.
        "' WHERE title='".$task_title."' AND creator_username='".$task_creator_username."';";
      $query = $this->db->prepare($sql);
      return $query->execute();
    }

    /**
     * Sets the assignee rating for a given task. This is done by the Task creator.
     *
     * @param  String $task_title               Title of the task
     * @param  String $task_creator_username    Username of the task creator
     * @param  Float  $assignee_rating          Rating of the doer, given by
     *                                          the task creator
     */
    public function rateTaskDoer($task_title, $task_creator_username, $assignee_rating)
    {
      $sql = "UPDATE Task ".
        "SET assignee_rating='".$assignee_rating.
        "' WHERE title='".$task_title."' AND creator_username='".$task_creator_username."';";
      $query = $this->db->prepare($sql);
      return $query->execute();
    }

    /**
     * Sets the assignee rating for a given task. This is done by the Task doer.
     *
     * @param  String $task_title               Title of the task
     * @param  String $task_creator_username    Username of the task creator
     * @param  Float  $creator_rating           Rating of the creator, given by
     *                                          the task doer
     */
    public function rateTaskCreator($task_title, $task_creator_username, $creator_rating)
    {
      $sql = "UPDATE Task ".
        "SET creator_rating='".$creator_rating.
        "' WHERE title='".$task_title."' AND creator_username='".$task_creator_username."';";
      $query = $this->db->prepare($sql);
      return $query->execute();
    }




    //==========================================
    // BIDDING RELATED FUNCTIONS
    //==========================================

    /**
     * Gets all the bids for this specified task.
     *
     * @param  String $task_title               Title of the task
     * @param  String $task_creator_username    Username of the task creator
     * @return Array    Array of bids for this specified task
     */
    public function getBids($task_title, $task_creator_username)
    {
      $sql = "SELECT
      `task_title`,
      `task_creator_username`,
      `bidder_username`,
      `amount`,
      `details`,
      `created_at`,
      `updated_at`,
      `deleted_at`
      FROM Bid
      WHERE task_title='$task_title'
      AND task_creator_username='$task_creator_username'";
      $query = $this->db->prepare($sql);
      $query->execute();
      return $query->fetchAll();
    }

    /**
     * Gets top N bids for this specified task.
     *
     * @param  String $task_title               Title of the task
     * @param  String $task_creator_username    Username of the task creator
     * @param  Int    $topN                     The top N bids ordered either in
     *                                          ascending or descending order.
     * @param  String $orderByAscOrDesc         'ASC' to order in ascending order,
     *                                          'DESC' to order in descending order.
     * @return Array    Array of top N bids for this specified task
     */
    public function getTopNBids($task_title, $task_creator_username, $topN, $orderByAscOrDesc)
    {
      $sql = "SELECT
      `task_title`,
      `task_creator_username`,
      `bidder_username`,
      `amount`,
      `details`,
      `created_at`,
      `updated_at`,
      `deleted_at`
      FROM Bid
      WHERE task_title='$task_title'
      AND task_creator_username='$task_creator_username'
      ORDER BY Bid.amount ".$orderByAscOrDesc." LIMIT ".$topN;
      $query = $this->db->prepare($sql);
      $query->execute();
      return $query->fetchAll();
    }

    /**
     * Retrieves the bidder's bid for this task. Returns an empty array if
     * this bidder does not have any bids for this task.
     *
     * @param  String $task_title         Title of the task
     * @param  String $bidder_username    Username of the bidder
     * @return Object    Bid object representing the bid made for this task by
     *                   the specified bidder.
     */
    public function getUserBidForTask($task_title, $bidder_username)
    {
      $sql = "SELECT
      `task_title`,
      `task_creator_username`,
      `bidder_username`,
      `amount`,
      `details`,
      `created_at`,
      `updated_at`,
      `deleted_at`
      FROM Bid
      WHERE task_title='$task_title'
      AND bidder_username='$bidder_username'";
      $query = $this->db->prepare($sql);
      $query->execute();
      return $query->fetch();
    }

    /**
     * Creates a new bid for this task, associated with the current logged in
     * user.
     *
     * @param  String $task_title               Title of the task
     * @param  String $task_creator_username    Username of the task creator
     * @param  Int    $amount                   Amount of bid points placed for this task
     * @param  String $details                  Additional comments made for this bid
     */
    public function createTaskBid($task_title, $task_creator_username, $amount, $details)
    {
      $sql = "INSERT INTO Bid (
        `task_title`,
        `task_creator_username`,
        `bidder_username`,
        `details`,
        `amount`,
        `created_at`,
        `updated_at`,
        `deleted_at`)
      VALUES (
        '".$task_title."',
        '".$task_creator_username."',
        '".$_SESSION['user']->username."',
        '".$details."',
        $amount,
        '2017-09-24 03:09:10',
        '2017-09-24 03:09:10',
        '2017-09-24 03:09:10')";
      $query = $this->db->prepare($sql);
      return $query->execute();
    }

    /**
     * Edits the amount and details of a bid.
     *
     * @param  String $task_title               Title of the task
     * @param  String $task_creator_username    Username of the task creator
     * @param  String $bidder_username          Username of the bidder
     * @param  Int    $amount                   Amount of bid points placed for this task
     * @param  String $details                  Additional comments made for this bid
     */
    public function editTaskBid($task_title, $task_creator_username, $bidder_username, $amount, $details)
    {
      $sql = "UPDATE Bid ".
        "SET amount=".$amount.", details='".$details."' ".
        "WHERE task_title='".$task_title."' AND task_creator_username='".
        $task_creator_username."' AND bidder_username='".$bidder_username."';";
      $query = $this->db->prepare($sql);
      return $query->execute();
    }

    /**
     * Deletes a bid from the Bid table.
     *
     * @param  String $task_title               Title of the task
     * @param  String $task_creator_username    Username of the task creator
     * @param  String $bidder_username          Username of the bidder
     */
    public function deleteTaskBid($task_title, $task_creator_username, $bidder_username)
    {
      $sql = "DELETE FROM Bid".
        " WHERE task_title='".$task_title."'".
        " AND task_creator_username='".$task_creator_username."'".
        " AND bidder_username='".$bidder_username."';";
      $query = $this->db->prepare($sql);
      return $query->execute();
    }

    //===========================
    //TASK CATEGORY AND TAG RELATED FUNCTIONS
    //===========================

    /**
     * Get the Tags associated with a task from Tag_task table.
     *
     * @param String $task_title    Title of the task
     * @param String $creator_name  Username of task creator
     */
    public function getTagsOfTask($task_title, $creator_name) {
        $sql = "SELECT t.tag_name AS tags FROM Tag_task t WHERE t.task_title = '$task_title' AND t.task_creator_username = '$creator_name'";
        $query = $this -> db -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll();
        $tags = "";
        if (sizeof($results)==0) {
            return '';
        } else {
            foreach ($results as $result) {
                $tag = $result -> tags;
                $tags .= "#".$tag." ";
            }
            return $tags;
        }
    }

    /**
     * Get the Category label of a task from Category_task table.
     *
     * @param String $task_title      Title of the task
     * @param String $creator_name    Username of task creator
     */
    public function getCategoryOfTask($task_title, $creator_name) {
        $sql = "SELECT g.category_name AS category FROM Category_task g WHERE g.task_title = '$task_title' AND g.task_creator_username = '$creator_name'";
        $query = $this -> db -> prepare($sql);
        $query -> execute();
        $result = $query -> fetch();
        if ($result == '') {
            return '';
        } else {
            return $result->category;
        }
    }

}
