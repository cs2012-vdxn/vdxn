<?php
  echo '<div class="table-wrapper">';
  include ('bidded_tasks_dropdown.php');
  echo '<table id="bidded-tasks-table" border="1" class="sortable paginate dropdown" data-total='.$num_user_tasks.' data-selected-page="1" data-pagesize="10" data-offset="0" data-order_by="title" data-dir="ASC">';
  echo '<thead><tr><th data-col="title">Title<div class="sortable__arrows"><div class="sortable__arrow sortable__arrow--up selected"></div><div class="sortable__arrow sortable__arrow--down"></div></div></th>
        <th data-col="description">Description<div class="sortable__arrows"><div class="sortable__arrow sortable__arrow--up"></div><div class="sortable__arrow sortable__arrow--down"></div></div></th>
        <th data-col="start_at">Start At<div class="sortable__arrows"><div class="sortable__arrow sortable__arrow--up"></div><div class="sortable__arrow sortable__arrow--down"></div></div></th>
        <th data-col="curr_min_bid">Current Min bid<div class="sortable__arrows"><div class="sortable__arrow sortable__arrow--up"></div><div class="sortable__arrow sortable__arrow--down"></div></div></th>
        <th data-col="curr_max_bid">Current Max bid<div class="sortable__arrows"><div class="sortable__arrow sortable__arrow--up"></div><div class="sortable__arrow sortable__arrow--down"></div></div></th>
        <th data-col="myBid">My Bid<div class="sortable__arrows"><div class="sortable__arrow sortable__arrow--up"></div><div class="sortable__arrow sortable__arrow--down"></div></div></th>
        <th data-col="creator_username">Created by<div class="sortable__arrows"><div class="sortable__arrow sortable__arrow--up"></div><div class="sortable__arrow sortable__arrow--down"></div></div></th>
        <th data-col="creator_rating">Creator Rating<div class="sortable__arrows"><div class="sortable__arrow sortable__arrow--up"></div><div class="sortable__arrow sortable__arrow--down"></div></div></th>
        <th data-col="assignee_rating">Assignee Rating<div class="sortable__arrows"><div class="sortable__arrow sortable__arrow--up"></div><div class="sortable__arrow sortable__arrow--down"></div></div></th></tr></thead>';
  echo '<tbody>';
  foreach($user_tasks as $task) {
    echo '<tr class="data-row">';
    foreach($task as $item) {
      echo "<td>$item</td>";
    }
    echo "<td><a href='/tasks/task?title=" .
          $task->title . "&creator_username=" .
          $task->creator_username .
          "'>Link</a></td>";
          echo "<td><a href='/tasks/edittask?title=" .
                $task->title . "&creator_username=" .
                $task->creator_username .
                "'>Edit</a></td>";
          echo "<td><a href='/tasks/deletetask?title=" .
                $task->title . "&creator_username=" .
                $task->creator_username .
                "'>Delete</a></td>";
    echo '</tr>';
  }
  echo '</tbody>';
  echo '</table>';
  echo "<script type='text/javascript'>";
  include('bidded_tasks_pagination.js');
  include('sorting.js');
  echo"</script>";
  echo '</div>';
?>
