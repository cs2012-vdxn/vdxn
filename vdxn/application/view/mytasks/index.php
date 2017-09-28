<div class="container">
    <h1>My Tasks</h1>
    <a href="/tasks/newtask">New</a>
    <?php
      echo '<table border="1">';
      echo '<tr><th>#</th><th>Title</th><th>Description</th><th>Create time</th>
            <th>Updated time</th><th>Event Date</th>
            <th>Min Bid</th><th>Max Bid</th><th>Created by</th><th>Assigned To</th><th>Creator Rating</th><th>Assignee Rating</th></tr>';
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
</div>
