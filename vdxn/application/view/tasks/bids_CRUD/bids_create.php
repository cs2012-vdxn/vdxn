<?php
  // Defining POST method's redirect URLs
  $post_method_action_url_newbid =
    "/tasks/newbid?title=" . $task->{"title"} .
    "&creator_username=" . $task->{"creator_username"};
?>

<ul>
  <li>
    <!-- Create Bid Form -->
    <form name="createBidForm"
          onsubmit="return validateEnteredBid('createBidForm', 'bid_amount')"
          method="post"
          action="<?php echo $post_method_action_url_newbid; ?>">

      <!-- New Bid amount input -->
      <div style="margin: 0 0 10px 3px;">
        <b>Enter your bid:</b>
        <input type="text" name="bid_amount" value="" placeholder="Bid amount" class="form-control"/>
        <div class="err_bid_out_of_range" style="display:none;">
          <span style="color: #c91212; font-size: 0.9em;">* Please enter an amount within the limit</span>
        </div>

        <!-- New Bid comments input -->
        <br/>
        <b>Comments:</b>
        <br/>
        <textarea
          name="bid_details" placeholder="Tell us why you're good at this task!"
          maxlength="200" class="form-control"></textarea>

        <br/>

        <!-- Create Bid Form -->
        <div style="text-align: center;">
          <input type="submit" name="create_bid" value="Place Bid"
                 class="btn btn-embossed btn-wide btn-primary"/>
        </div>

      </div>
    </form>
  </li>
</ul>
