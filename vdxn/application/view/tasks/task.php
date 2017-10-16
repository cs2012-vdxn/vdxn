<h3>
  <?php echo $task->{'title'}; ?>
  <a href="#nothing" class="btn btn-embossed btn-sm btn-primary">
    <span class="fui-new"></span> Edit
  </a>
  <a href="#nothing" class="btn btn-embossed btn-sm btn-danger">
    <span class="fui-trash"></span> Delete
  </a>
</h3>
<p><b>Due:</b> <?php echo $task->{'created_at'};?></p>
<p><?php echo $task->{'description'}; ?></p>
<p>[list of tags here] [list of categories here]</p>
<p style="">
  <small>
    <b>Created at:</b> <?php echo $task->{'created_at'}; ?>
    <b style="padding-left: 2em;">Updated at:</b> <?php echo $task->{'updated_at'}; ?>
  </small>
</p>
<hr/>

<h4>Top Bidders</h4>
<p>Minimum: <?php echo $task->{'min_bid'};?></p>
<p>Maximum: <?php echo $task->{'max_bid'};?></p>

<h2>Others</h2>
<p>Creator: <?php echo $task->{'creator_username'}?></p>

<hr>

<?php
  echo '<table>';
  echo '
  <tr>
    <th>Amount</th>
    <th>Created at</th>
    <th>Updated at</th>
    <th>Bidder Username</th>
  </tr>';
  foreach($bids as $bid) {
    echo '<tr>';
    echo '<td>' . $bid->amount . '</td>';
    echo '<td>' . $bid->created_at . '</td>';
    echo '<td>' . $bid->updated_at . '</td>';
    echo '<td>' . $bid->bidder_username . '</td>';
    echo '</tr>';
  }
  echo '</table>';
?>

<hr>

<?php
  if($isTaskOwner)
  {
    echo '<h5>You are the creator of this task</h5>';
  } else if($hasUserBid)
  {
    echo '<h3>Bidding summary</h3>';
  } else
  {
    echo '<form method="post" action="/tasks/newbid/'.$tid.'">';
    echo '<label>Offer amount</label><br><input type="text" name="amount"><br>';
    echo '<label>Details</label><br><textarea name="details"></textarea><br>';
    echo '<input type="submit" value="Submit Bid">';
    echo '</form>';
  }
?>
