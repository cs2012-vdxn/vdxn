<!-- Tasks which have been completed -->
<?php
echo '<div class="table-wrapper">';
include ('created_history_dropdown.php');
  echo '<table id="created-history-table" border="1" class="sortable paginate dropdown" data-total='.$num_history_tasks.' data-selected-page="1" data-pagesize="10" data-offset="0" data-order_by="title" data-dir="ASC">';
  echo '<thead><tr><th data-col="title">Title<div class="sortable__arrows"><div class="sortable__arrow sortable__arrow--up selected"></div><div class="sortable__arrow sortable__arrow--down"></div></div></th>
        <th data-col="description">Description<div class="sortable__arrows"><div class="sortable__arrow sortable__arrow--up"></div><div class="sortable__arrow sortable__arrow--down"></div></div></th>
        <th data-col="created_at">Created At<div class="sortable__arrows"><div class="sortable__arrow sortable__arrow--up"></div><div class="sortable__arrow sortable__arrow--down"></div></div></th>
        <th data-col="start_at">Start At<div class="sortable__arrows"><div class="sortable__arrow sortable__arrow--up"></div><div class="sortable__arrow sortable__arrow--down"></div></div></th>
        <th data-col="completed_at">Completed At<div class="sortable__arrows"><div class="sortable__arrow sortable__arrow--up"></div><div class="sortable__arrow sortable__arrow--down"></div></div></th>
        <th data-col="assignee_username">Assigned To<div class="sortable__arrows"><div class="sortable__arrow sortable__arrow--up"></div><div class="sortable__arrow sortable__arrow--down"></div></div></th>
        <th data-col="creator_rating">Creator Rating<div class="sortable__arrows"><div class="sortable__arrow sortable__arrow--up"></div><div class="sortable__arrow sortable__arrow--down"></div></div></th>
        <th data-col="assignee_rating">Assignee Rating<div class="sortable__arrows"><div class="sortable__arrow sortable__arrow--up"></div><div class="sortable__arrow sortable__arrow--down"></div></div></th></tr></thead>';
  echo '<tbody>';

  var_dump($history_tasks[0]->{"title"});

  foreach($history_tasks as $task) {
    echo '<tr>';
    foreach($task as $task_attribute => $item) {
      if ($task_attribute == 'title') {
        echo "<td><a href='/tasks/task?title=".$task->title."&creator_username=".$_SESSION['user']->username."'>$item</a></td>";
      } else {
        echo "<td>$item</td>";
      }
    }

    echo "<td><a href='/tasks/edittask?title=" .
          $task->title . "&creator_username=" .
          $_SESSION['user']->username .
          "'>Edit</a></td>";
    echo "<td><a href='/tasks/deletetask?title=" .
          $task->title . "&creator_username=" .
          $_SESSION['user']->username .
          "'>Delete</a></td>";
    echo '</tr>';
  }
  echo '</tbody>';
  echo '</table>';
  // the pagination
  echo "<script type='text/javascript'>";
  include('created_tasks_history_pagination.js');
  include('sorting.js');
  echo"</script>";
  echo '</div>';
?>
