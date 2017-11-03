<?php
  if ($hasUserBid) {
    $curr_bid_text = "Your Bid: " . $bid->{'amount'};
    $color_bid_text = "palette palette-nephritis";
  } else {
    $curr_bid_text = "You haven't bidded yet!";
    $color_bid_text = "palette palette-midnight-blue";
  }
?>
<dl class="<?php echo $color_bid_text; ?>" style="border-radius: 8px 8px 0px 0px">
  <dt><?php echo $curr_bid_text; ?></dt>
  <?php echo "<small>Min bid: ".$task->{'min_bid'}.", Max bid:".$task->{'max_bid'}."</small>"; ?>
</dl>
