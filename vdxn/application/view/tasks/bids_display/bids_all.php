<h4>All Bidders</h4>
<p>
  Every bidder's bid info for this task is listed here.
</p>
<br/>
<?php
  echo '<table class="table table-bordered table-hover table-condensed">';
  echo '<thead><tr>
          <th>Username</th>
          <th>Amount</th>
          <th>Comments</th>
          <th>Created on</th>';
  if ($isTaskOwner && !$assignee) {
    echo '<th></th>';
  }
  echo '</tr></thead>';

  foreach($bids as $bid) {
    $confirm_assignee_link =
      '"/tasks/assign_bidder?title='.$task->{'title'}.
      '&creator_username='.$task->{'creator_username'}.
      '&assignee_username='.$bid->bidder_username.'"';
    echo '<tr>';
    echo '<td><a href="/myprofile?username=' . $bid->bidder_username . '">'.$bid->bidder_username.'</a></td>';
    echo '<td>' . $bid->amount . '</td>';
    echo '<td>' . $bid->details . '</td>';
    echo '<td>' . $bid->created_at . '</td>';
    if ($isTaskOwner && !$assignee) {
      echo '<td><a href='.$confirm_assignee_link.'>Confirm</a></td>';
    }
    echo '</tr>';
  }
  echo '</table>';
?>
