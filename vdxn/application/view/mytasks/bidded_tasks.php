<?php
  echo '<table border="1">';
  echo '<th>Title</th>
        <th>Description</th>
        <th>Start At</th>
        <th>Min bid</th>
        <th>Max bid</th>
        <th>My Bid</th>
        <th>Created by</th>
        <th>Creator Rating</th>
        <th>Assignee Rating</th></tr>';
  foreach($user_tasks as $task) {
    echo '<tr>';
    foreach($task as $item) {
      echo "<td>$item</td>";
    }
    echo "<td><a href='/tasks/task?title=" .
          $task->title . "&creator_username=" .
          $task->creator_username .
          "'>Link</a></td>";
    echo '</tr>';
  }
  echo '</table>';
?>
