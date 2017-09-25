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
        $sql = "SELECT id, title, description, created_at, updated_at,
        start_at, min_bid, max_bid, creator_id, assignee_id, creator_rating,
        assignee_rating
        FROM Task";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function getTask($tid)
    {
      $sql = "SELECT id, title, description, created_at, updated_at,
      start_at, min_bid, max_bid, creator_id, assignee_id, creator_rating,
      assignee_rating
      FROM Task WHERE id=$tid";
      $query = $this->db->prepare($sql);
      $query->execute();
      return $query->fetch();
    }
}
