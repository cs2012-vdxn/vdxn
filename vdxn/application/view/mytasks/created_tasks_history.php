<!-- Tasks which have been completed -->
<?php
  echo '<table border="1">';
  echo '<th>Title</th>
        <th>Description</th>
        <th>Created At</th>
        <th>Event Date</th>
        <th>Completed At</th>
        <th>Assigned To</th>
        <th>Creator Rating</th>
        <th>Assignee Rating</th></tr>';
  foreach($completed_tasks as $task) {
    echo '<tr>';
    foreach($task as $item) {
      echo "<td>$item</td>";
    }
    //echo "<td><a href='/tasks/task/".$task->{'id'}."'>Link</a></td>";
    //echo "<td><a href='/tasks/edittask/".$task->{'id'}."'>Edit</a></td>";
    //echo "<td><a href='/tasks/bids/".$task->{'id'}."'>Bidding Details</a></td>";
    //echo '</tr>';
  }
  echo '</table>';
?>
