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
    // echo "<td><a href='/tasks/task/".$task->{'id'}."'>Link</a></td>";
    // echo "<td><a href='/tasks/edittask/".$task->{'id'}."'>Edit</a></td>";
    // echo "<td><a href='/tasks/bids/".$task->{'id'}."'>Bidding Details</a></td>";
    // echo '</tr>';
  }
  echo '</table>';
?>
