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
         $sql = 'SELECT title, description, created_at, updated_at,
         start_at, min_bid, max_bid, creator_username, assignee_username, creator_rating,
         assignee_rating
         FROM Task';
         $query = $this->db->prepare($sql);
         $query->execute();
         return $query->fetchAll();
     }

    public function getTask($tid)
    {
      $sql = 'SELECT id, title, description, created_at, updated_at,
      start_at, min_bid, max_bid, creator_id, assignee_id, creator_rating,
      assignee_rating
      FROM Task WHERE id=$tid';
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
      start_at, updated_at, min_bid, max_bid, assignee_username, creator_rating,
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
      start_at, min_bid, max_bid, Bid.amount /* my current bid */,
      creator_username, creator_rating,
      assignee_rating
      FROM Task
      INNER JOIN Bid ON creator_username=task_creator_username AND Task.title = task_title
      INNER JOIN User ON username=bidder_username
      WHERE bidder_username='$bdername' AND assignee_username IS NULL";
      // TODO: find the current smallest bid
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
      (`id`,
      `title`,
      `description`,
      `created_at`,
      `updated_at`,
      `start_at`,
      `min_bid`,
      `max_bid`,
      `creator_id`,
      `assignee_id`,
      `deleted_at`,
      `completed_at`,
      `creator_rating`,
      `assignee_rating`)
      VALUES (NULL,
      '".$task_params['title']."',
      '".$task_params['description']."',
      '2017-09-24 03:09:10',
      '2017-09-24 03:09:10',
      '',
      '2017-09-27 04:10:14',
      '5',
      '100',
      '1',
      '',
      '',
      '',
      '',
      '')";
      $query = $this->db->prepare($sql);
      return $query->execute();
    }

    public function deleteTask($tid)
    {
      // TODO: check if user is authenticated and allowed to delete task
      $sql = "DELETE FROM Task WHERE id='$tid'";
      $query = $this->db->prepare($sql);
      return $query->execute();
    }

    public function editTask($tid, $params)
    {
      // TODO: check if user is authenticated and allowed to edit task
      $sql = "UPDATE `Task` SET `title` = '".$params['title']."',
        `description` = '".$params['description']."',
        `start_at` = '2017-09-25 00:00:00',
        `min_bid` = '".$params['min_bid']."',
        `max_bid` = '".$params['max_bid']."'
        WHERE `Task`.`id`=$tid";
      $query = $this->db->prepare($sql);
      return $query->execute();
    }

    /*
      Bidding related functions
    */

    public function getBids($tid)
    {
      $sql = "SELECT
      `task_id`,
      `bidder_id`,
      `amount`,
      `created_at`,
      `updated_at`
      FROM Bid WHERE `task_id`='$tid'";
      $query = $this->db->prepare($sql);
      $query->execute();
      return $query->fetchAll();
    }

    public function getUserBidForTask($tid, $uid)
    {
      $sql = "SELECT
      `task_id`,
      `bidder_id`,
      `amount`,
      `created_at`,
      `updated_at`
      FROM Bid WHERE `task_id`='$tid' AND `bidder_id`='$uid'";
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
