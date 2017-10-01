<?php
  echo '<table border="1">';
  echo '<th>Title</th>
        <th>Description</th>
        <th>Start At</th>
        <th>My Bid</th>
        <th>Winning Bid</th>
        <th>Created by</th>
        <th>Assigned To</th></tr>';
  foreach($history_tasks as $task) {
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
