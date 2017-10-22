<?php
  echo '<div class="table-wrapper">';
  include ('bidded_tasks_dropdown.php');
  echo '<table id="bidded-tasks-table" border="1" class="sortable paginate dropdown" data-pagesize="10" data-offset="0" data-order_by="title" data-dir="ASC">';
  echo '<thead><tr><th data-col="title">Title</th>
        <th data-col="description">Description</th>
        <th data-col="start_at">Start At</th>
        <th data-col="curr_min_bid">Current Min bid</th>
        <th data-col="curr_max_bid">Current Max bid</th>
        <th data-col="myBid">My Bid</th>
        <th data-col="creator_username">Created by</th>
        <th data-col="creator_rating">Creator Rating</th>
        <th data-col="assignee_rating">Assignee Rating</th></tr></thead>';
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
  // the pagination
  $pagesize = $domElement->getElementsById("bidded-tasks-table")->getAttribute("data-pagesize");
  if($num_user_tasks > $pagesize) {
    echo('<div id="bidded-tasks-pagination" class="table-pagination">');
    foreach (range(1, ceil(floatval($num_user_tasks)/$pagesize)) as $page) {
      echo('<span class="pagination-button" data-start=' . (($page - 1) * $pagesize) .'>'. $page . '</span>');
    }
    echo('</div>');
    echo "<script>".
      "$('#bidded-tasks-pagination pagination-button').click(function() {
        var table = $('#bidded-tasks-table');
        table.data('offset', $(this).data('start'));
        $.ajax({
            type: 'POST',
            url: '/table/fetchCurrentBiddedTasks',
            data: { offset: table.data('offset'), pagesize: table.data('pagesize'), order_by: table.data('order_by'), dir: table.data('dir') },
            cache: false,
            success: function(html){
                $('table#bidded-tasks-table tbody').html(html);
            }
        });
      });".
    "</script>";
  }
  echo '</div>';
?>
