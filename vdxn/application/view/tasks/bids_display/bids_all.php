<h4>All Bidders</h4>
<p>
  All bids that belong to the task are listed here.
  Depending on the get parameters, retrieve results sorted differently.
</p>
<br/>
<div id="controls">
  Sort by :
  Bid Amount
  |
  Name
  |
Rating
</div>
<?php
  echo '<table class="table table-bordered table-hover table-condensed">';
  echo '<thead><tr>
          <th>Bidder</th>
          <th>Amount</th>
          <th>Comments</th>
          <th>Created at</th>';
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
    echo '<td>' . $bid->bidder_username . '</td>';
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
