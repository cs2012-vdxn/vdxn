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

    public function getAllUserTasks($tkername, $offset = NULL, $limit = NULL, $order_by = NULL)
    {
      $sql = $this->getAllUserTasksQuery($tkername, $offset, $limit, $order_by);
      $query = $this->db->prepare($sql);
      $query->execute();
      return $query->fetchAll();
    }

    public function getAllUserTasksQuery($tkername, $offset = NULL, $limit = NULL, $order_by = NULL)
    {
      $sql = "SELECT title, description, created_at,
      start_at, updated_at, min_bid, max_bid, assignee_username, creator_rating,
      assignee_rating
      FROM Task WHERE creator_username='$tkername' AND completed_at IS NULL";
      if(isset($limit)) {
        $sql .= " LIMIT $limit";
      }
      if(isset($offset)) {
        $sql .= " OFFSET $offset";
      }
      if(isset($order_by)) {
        $sql .= " ORDER BY $order_by";
      }
      // TODO: have a default sorting order

      return $sql;
    }

    public function getAllHistoryUserTasks($tkername, $offset = NULL, $limit = NULL, $order_by = NULL)
    {
      // tasks created by this user and has been completed
      $sql = $this->getAllHistoryUserTasksQuery($tkername, $offset, $limit, $order_by);
      $query = $this->db->prepare($sql);
      $query->execute();
      return $query->fetchAll();
    }

    public function getAllHistoryUserTasksQuery($tkername, $offset = NULL, $limit = NULL, $order_by = NULL)
    {
      $sql = "SELECT title, description, created_at,
      start_at, completed_at, assignee_username, creator_rating,
      assignee_rating
      FROM Task WHERE creator_username='$tkername' AND completed_at IS NOT NULL";
      if(isset($limit)) {
        $sql .= " LIMIT $limit";
      }
      if(isset($offset)) {
        $sql .= " OFFSET $offset";
      }
      if(isset($order_by)) {
        $sql .= " ORDER BY $order_by";
      }
      return $sql;
    }

    public function getAllCurrentBiddedTasks($bdername,$offset = NULL, $limit = NULL, $order_by = NULL)
    {
      // tasks this user has bidded for
      $sql = $this->getAllCurrentBiddedTasksQuery($bdername, $offset, $limit, $order_by);
      $query = $this->db->prepare($sql);
      $query->execute();
      return $query->fetchAll();
    }

    public function getAllCurrentBiddedTasksQuery($bdername, $offset = NULL, $limit = NULL, $order_by = NULL)
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
      if(isset($limit)) {
        $sql .= " LIMIT $limit";
      }
      if(isset($offset)) {
        $sql .= " OFFSET $offset";
      }
      if(isset($order_by)) {
        $sql .= " ORDER BY $order_by";
      }
      return $sql;
    }

    public function getAllHistoryBiddedTasks($bdername, $offset = NULL, $pagesize = NULL, $order_by = NULL)
    {
      // tasks this user has bidded for and has had an assignee chosen
      $sql = $this->getAllHistoryBiddedTasksQuery($bdername, $offset, $pagesize, $order_by);
      $query = $this->db->prepare($sql);
      $query->execute();
      return $query->fetchAll();
    }

    public function getAllHistoryBiddedTasksQuery($bdername, $offset = NULL, $limit = NULL, $order_by = NULL) {
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
      if(isset($limit)) {
        $sql .= " LIMIT $limit";
      }
      if(isset($offset)) {
        $sql .= " OFFSET $offset";
      }
      if(isset($order_by)) {
        $sql .= " ORDER BY $order_by";
      }
      return $sql;
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

    /*
      Bidding related functions
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

    public function createTaskBid($tid, $bid, $bid_params)
    {
      $sql = "INSERT INTO Bid (
        `id`,
        `task_id`,
        `bidder_id`,
        `amount`,
        `created_at`,
        `updated_at`)
      VALUES (
        '',
        '$tid',
        '".$bid."',
        '".$bid_params['amount']."',
        CURRENT_TIMESTAMP,
        CURRENT_TIMESTAMP)";
      $query = $this->db->prepare($sql);
      return $query->execute();
    }
}
