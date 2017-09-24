<div class="container">
    <h1>Task - <?php echo $task->{'title'}; ?></h1>
    <p><?php echo $task->{'details'}; ?></p>
    <p>Created at: <?php echo $task->{'created_at'};?></p>
    <p>Last updated at: <?php echo $task->{'updated_at'};?></p>

    <p>Task closing at: <?php echo $task->{'expiry_timestamp'};?></p>

    <h2>Bidding</h2>
    <p>Minimum: <?php echo $task->{'min_bid'};?></p>
    <p>Maximum: <?php echo $task->{'max_bid'};?></p>

    <h2>Others</h2>
    <p>Creator: <?php echo $task->{'tasker_id'}?></p>

    <hr>

    <?php
      echo '<table>';
      echo '<tr><th>Amount</th><th>Created at</th><th>Updated at</th></tr>';
      foreach($bids as $bid) {
        echo '<tr>';
        echo '<td>';
        echo $bid->{'amount'};
        echo '</td>';
        echo '<td>';
        echo $bid->{'created_at'};
        echo '</td>';
        echo '<td>';
        echo $bid->{'updated_at'};
        echo '</td>';
        echo '</tr>';
      }
      echo '</table>';
    ?>

    <hr>

    <?php
      if($isTaskOwner)
      {
        echo '<h3>You have already bidded.</h3>';
      } else if($hasUserBid)
      {
        echo '<h3>Bidding summary</h3>';
      }else
      {
        echo '<form method="post" action="/tasks/newbid/'.$tid.'">';
        echo '<label>Offer amount</label><br><input type="text" name="amount"><br>';
        echo '<label>Details</label><br><textarea name="details"></textarea><br>';
        echo '<input type="submit" value="Submit Bid">';
        echo '</form>';
      }
    ?>
</div>
