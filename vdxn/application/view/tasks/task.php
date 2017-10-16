<div class="row">
  <h3><?php echo $task->{'title'}; ?></h3>
  <p><b>Due: <?php echo $task->{'created_at'};?></b></p>
  <p><?php echo $task->{'description'}; ?></p>
  <p>[list of tags here] [list of categories here]</p>
  <p style="">
    <small>
      <b>Created at:</b> <?php echo $task->{'created_at'}; ?>
      <b style="padding-left: 2em;">Updated at:</b> <?php echo $task->{'updated_at'}; ?>
    </small>
  </p>
  <p>
    <a href="#nothing" class="btn btn-embossed btn-sm btn-primary">
      <span class="fui-new"></span> Edit
    </a>
    <a href="#nothing" class="btn btn-embossed btn-sm btn-danger">
      <span class="fui-trash"></span> Delete
    </a>
  </p>
  <hr/>

  <?php
    if($isTaskOwner) {
      echo '<h5>You are the creator of this task</h5>';
    } else if($hasUserBid) {
      // echo '<h3>Bidding summary</h3>';
    } else {
      echo '<form method="post" action="/tasks/newbid/'.$tid.'">';
      echo '<label>Offer amount</label><br><input type="text" name="amount"><br>';
      echo '<label>Details</label><br><textarea name="details"></textarea><br>';
      echo '<input type="submit" value="Submit Bid">';
      echo '</form>';
    }
  ?>
</div>
