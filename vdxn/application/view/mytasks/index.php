<div class="container">
    <h1>My Tasks</h1>
    <p>
      All the tasks that I have created, in various states
    </p>
    <?php
      echo '<table border="1">';
      echo '<tr><th>#</th><th>Title</th><th>Description</th><th>Create time</th>
            <th>Updated time</th><th>Expiry</th><th>Event Date</th>
            <th>Min Bid</th><th>Max Bid</th><th>Tasker</th></tr>';
      foreach($user_tasks as $task) {
        echo '<tr>';
        foreach($task as $item) {
          echo "<td>$item</td>";
        }
        echo "<td><a href='/tasks/task/".$task->{'id'}."'>Link</a></td>";
        echo "<td><a href='/tasks/edittask/".$task->{'id'}."'>Edit</a></td>";
        echo '</tr>';
      }
      echo '</table>';
    ?>
</div>
