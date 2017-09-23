<div class="container">
    <h1>Tasks</h1>
    <p>
      Content should contain all tasks available in the system that is
      available for bidding
    </p>
    <?php
      echo '<table border="1">';
      echo '<tr><th>#</th><th>Title</th><th>Description</th><th>Create time</th>
            <th>Updated time</th><th>Expiry</th><th>Event Date</th>
            <th>Min Bid</th><th>Max Bid</th><th>Tasker</th></tr>';
      foreach($tasks as $task) {
        echo '<tr>';
        foreach($task as $item) {
          echo "<td>$item</td>";
        }
        echo '</tr>';
      }
      echo '</table>';
    ?>
</div>
