<?php
  $post_method_action_url_newbid =
    "/tasks/newbid?title=" . $task->{"title"} .
    "&creator_username=" . $task->{"creator_username"};
?>
<ul>
  <li>
    <form method="post" action="<?php echo $post_method_action_url_newbid; ?>">
      <div style="margin: 0 0 10px 3px;">
        <b>Enter your bid:</b>
        <input type="text" name="bid_amount" value="" placeholder="Bid amount" class="form-control" style="margin-bottom: 1.5em;"/>

        <b>Comments:</b>
        <br/>
        <textarea name="bid_details" placeholder="Tell us why you're good at this task!" class="form-control"></textarea>
        <br/>
        <div style="text-align: center;">
          <input type="submit" name="create_bid" value="Place Bid" class="btn btn-embossed btn-sm btn-primary"/>
        </div>
      </div>
    </form>
  </li>
</ul>
