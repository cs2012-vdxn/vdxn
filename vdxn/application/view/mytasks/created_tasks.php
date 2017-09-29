<?php
  echo '<table border="1">';
  echo '<tr><th>#</th><th data-name="title">Title</th><th data-name="description">Description</th><th data-name="created_at">Created At</th>
        <th data-name="updated_at">Last Updated At</th><th data-name="start_at">Event Date</th>
        <th data-name="min_bid">Min Bid</th><th data-name="max_bid">Max Bid</th><th data-name="creator_id">Created by</th><th data-name="assignee_id">Assigned To</th><th data-name="creator_rating">Creator Rating</th><th data-name="assignee_rating">Assignee Rating</th></tr>';
  foreach($user_tasks as $task) {
    echo '<tr>';
    foreach($task as $item) {
      echo "<td>$item</td>";
    }
    echo "<td><a href='/tasks/task/".$task->{'id'}."'>Link</a></td>";
    echo "<td><a href='/tasks/edittask/".$task->{'id'}."'>Edit</a></td>";
    echo "<td><a href='/tasks/bids/".$task->{'id'}."'>Bidding Details</a></td>";
    echo '</tr>';
  }
  echo '</table>';
?>
