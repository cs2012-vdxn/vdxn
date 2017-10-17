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


    public function getAllUserTasks($tkername)
    {
      $sql = "SELECT title, description, created_at,
      start_at, updated_at, min_bid, max_bid, assignee_username, creator_rating,
      assignee_rating
      FROM Task WHERE creator_username='$tkername' AND completed_at IS NULL";
      $query = $this->db->prepare($sql);
      $query->execute();
      return $query->fetchAll();
    }

    public function getAllHistoryUserTasks($tkername)
    {
      // tasks created by this user and has been completed
      $sql = "SELECT title, description, created_at,
      start_at, completed_at, assignee_username, creator_rating,
      assignee_rating
      FROM Task WHERE creator_username='$tkername' AND completed_at IS NOT NULL";
      $query = $this->db->prepare($sql);
      $query->execute();
      return $query->fetchAll();
    }

    public function getAllCurrentBiddedTasks($bdername)
    {
      // tasks this user has bidded for
      $sql = "SELECT title, description,
      start_at, MIN(b2.amount), MAX(b2.amount), myBid /* my current bid */,
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

      $query = $this->db->prepare($sql);
      $query->execute();
      return $query->fetchAll();
    }

    public function getAllHistoryBiddedTasks($bdername)
    {
      // tasks this user has bidded for and has had an assignee chosen
      $sql = "SELECT title, description,
      start_at, myBid, winningBid.amount, creator_username,
      assignee_username
      FROM
      (SELECT title, description,
      start_at, myBid.amount as myBid, creator_username,
      assignee_username FROM Task
      INNER JOIN Bid myBid ON Task.creator_username=task_creator_username AND Task.title = myBid.task_title
      INNER JOIN User ON username=bidder_username
      WHERE bidder_username='$bdername' AND assignee_username IS NOT NULL) t
      INNER JOIN Bid winningBid ON winningBid.bidder_username=t.assignee_username AND t.title = winningBid.task_title
      INNER JOIN User winner ON winner.username = t.assignee_username";
      $query = $this->db->prepare($sql);
      $query->execute();
      return $query->fetchAll();
    }

    public function findAllTasksContaining($search_string)
    {
      $sql = 'SELECT * FROM Task WHERE title LIKE "%' . $search_string . '%"';
      $query = $this->db->prepare($sql);
      $query->execute();
      return $query->fetchAll();
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
      $query = $this->db->prepare($sql);
      return $query->execute();
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
     * @return Array    User profile of the assignee/doer for this task
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
     * @return Array    Date of completion of this task
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

}
