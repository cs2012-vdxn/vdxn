<?php
  echo '<div class="table-wrapper">';
  include ('bidded_history_dropdown.php');
  echo '<table id="bidded-history-table" border="1" class="sortable paginate dropdown" data-total='.$num_history_tasks.' data-selected-page="1" data-pagesize="10" data-offset="0" data-order_by="title" data-dir="ASC">';
  echo '<thead><tr><th data-col="title">Title<div class="sortable__arrows"><div class="sortable__arrow sortable__arrow--up selected"></div><div class="sortable__arrow sortable__arrow--down"></div></div></th>
        <th data-col="description">Description<div class="sortable__arrows"><div class="sortable__arrow sortable__arrow--up"></div><div class="sortable__arrow sortable__arrow--down"></div></div></th>
        <th data-col="start_at">Start At<div class="sortable__arrows"><div class="sortable__arrow sortable__arrow--up"></div><div class="sortable__arrow sortable__arrow--down"></div></div></th>
        <th data-col="myBid">My Bid<div class="sortable__arrows"><div class="sortable__arrow sortable__arrow--up"></div><div class="sortable__arrow sortable__arrow--down"></div></div></th>
        <th data-col="winning_bid">Winning Bid<div class="sortable__arrows"><div class="sortable__arrow sortable__arrow--up"></div><div class="sortable__arrow sortable__arrow--down"></div></div></th>
        <th data-col="creator_username">Created by<div class="sortable__arrows"><div class="sortable__arrow sortable__arrow--up"></div><div class="sortable__arrow sortable__arrow--down"></div></div></th>
        <th data-col="assignee_username">Assigned To<div class="sortable__arrows"><div class="sortable__arrow sortable__arrow--up"></div><div class="sortable__arrow sortable__arrow--down"></div></div></th></tr></thead>';
  echo '<tbody>';

  foreach($history_tasks as $task) {
    echo '<tr>';
    foreach($task as $task_attribute => $item) {
      if ($task_attribute == 'title') {
        echo "<td><a href='/tasks/task?title=".$task->title."&creator_username=".$task->creator_username."'>$item</a></td>";
      } else {
        echo "<td>$item</td>";
      }
    }

    echo "<td style='border-top: white 5px solid; border-right: white 5px solid; border-bottom: white 5px solid;'>
          <a class='btn btn-embossed btn-sm btn-primary' style='margin-left: 10px; margin-right: 5px;'
          href='/tasks/edittask?title=" .
          $task->title . "&creator_username=" .
          $task->creator_username .
          "'><span class='fui-new'></span> Edit</a></td>";
    echo "<td style='border: white 5px solid;'>
          <a class='btn btn-embossed btn-sm btn-danger' style='margin-left: 5px; margin-right: 5px;'
          href='/tasks/deletetask?title=" .
          $task->title . "&creator_username=" .
          $task->creator_username .
          "'><span class='fui-trash'></span> Delete</a></td>";
    echo '</tr>';
  }
  
  echo '</tbody>';
  echo '</table>';
  echo "<script type='text/javascript'>";
  include('bidded_tasks_history_pagination.js');
  include('sorting.js');
  echo"</script>";
  echo '</div>';
?>
