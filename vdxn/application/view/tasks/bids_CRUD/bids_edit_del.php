<?php
  // Defining POST method's redirect URLs
  $post_method_action_url_edit =
    "/tasks/edit_bid?title=" . $task->{"title"} .
    "&creator_username=" . $task->{"creator_username"};
  $post_method_action_url_del =
    "/tasks/del_bid?title=" . $task->{"title"} .
    "&creator_username=" . $task->{"creator_username"};
?>

<ul>
  <li>
    <div style="margin: 0 0 10px 3px; text-align: center;">

      <!-- Edit Bid Form -->
      <form name="editBidForm"
            onsubmit="return validateEnteredBid('editBidForm', 'edited_bid_amount')"
            method="post"
            action="<?php echo $post_method_action_url_edit; ?>">

        <!-- Bid amount input -->
        <div style="text-align: left;">
          <b>Enter new bid:</b>
        </div>
        <input type="text" name="edited_bid_amount" value="" placeholder="Bid amount" class="form-control" />
        <div class="err_bid_out_of_range" style="display:none;">
          <span style="color: #c91212; font-size: 0.9em;">* Please enter an amount within the limit</span>
        </div>
        <br/>

        <!-- Bid comments input -->
        <div style="text-align: left;">
          <b>Comments:</b>
        </div>
        <textarea name="edited_bid_details"
                  placeholder="Tell us why you're good at this task!"
                  maxlength="200" class="form-control"><?php echo $bid->{'details'}; ?></textarea>
        <br/>
        <input type="submit" name="edit_bid" value="Update Bid"
               class="btn btn-embossed btn-wide btn-primary">
      </form>

      <!-- Retract Bid Form -->
      <form name="delBidForm"
            method="post"
            action="<?php echo $post_method_action_url_del; ?>">
        <input type="submit" name="delete_bid" value="Retract Bid"
               class="btn btn-embossed btn-wide btn-danger" style="margin-top: 10px;">
      </form>

    </div>
  </li>
</ul>
