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
}
