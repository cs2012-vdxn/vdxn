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
      $sql = "SELECT id, title, details, created_at, updated_at, expiry_timestamp,
      task_timestamp, min_bid, max_bid, tasker_id, assignee_id, tasker_rating,
      assignee_rating
      FROM task";
      $query = $this->db->prepare($sql);
      $query->execute();
      return $query->fetchAll();
    }

    public function getTask($tid)
    {
      $sql = "SELECT id, title, details, created_at, updated_at, expiry_timestamp,
      task_timestamp, min_bid, max_bid, tasker_id, assignee_id, tasker_rating,
      assignee_rating
      FROM task WHERE id=$tid";
      $query = $this->db->prepare($sql);
      $query->execute();
      return $query->fetch();
    }

    public function getAllUserTasks($tkerid)
    {
      $sql = "SELECT id, title, details, created_at, updated_at, expiry_timestamp,
      task_timestamp, min_bid, max_bid, tasker_id, assignee_id, tasker_rating,
      assignee_rating
      FROM task WHERE tasker_id=$tkerid";
      $query = $this->db->prepare($sql);
      $query->execute();
      return $query->fetchAll();
    }

    public function createTask($task_params)
    {
      $sql = "INSERT INTO `mini`.`task`
      (`id`,
      `title`,
      `details`,
      `created_at`,
      `updated_at`,
      `expiry_timestamp`,
      `task_timestamp`,
      `min_bid`,
      `max_bid`,
      `tasker_id`,
      `assignee_id`,
      `deleted_at`,
      `completed_at`,
      `tasker_rating`,
      `assignee_rating`)
      VALUES (NULL,
      '".$task_params['title']."',
      '".$task_params['details']."',
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
      $sql = "DELETE FROM task WHERE id='$tid'";
      $query = $this->db->prepare($sql);
      return $query->execute();
    }

    public function getBids($task_id)
    {
      $sql = "SELECT
      `task_id`,
      `bidder_id`,
      `amount`,
      `created_at`,
      `updated_at`
      FROM Bid WHERE `task_id`='$task_id'";
      $query = $this->db->prepare($sql);
      $query->execute();
      return $query->fetchAll();
    }

}
