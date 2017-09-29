<?php
  echo '<table border="1">';
  echo '<tr><th>#</th>
        <th>Title</th>
        <th>Description</th>
        <th>Created At</th>
        <th>Event Date</th>
        <th>Last Updated At</th>
        <th>Min Bid</th>
        <th>Max Bid</th>
        <th>Assigned To</th>
        <th>Creator Rating</th>
        <th>Assignee Rating</th></tr>';
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
