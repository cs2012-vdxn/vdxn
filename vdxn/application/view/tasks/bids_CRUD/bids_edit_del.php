<?php
  $post_method_action_url_edit_del =
    "/tasks/del_or_edit_bid?title=" . $task->{"title"} .
    "&creator_username=" . $task->{"creator_username"};
?>
<ul>
  <li>
    <form method="post" action="<?php echo $post_method_action_url_edit_del; ?>">
      <div style="margin: 0 0 10px 3px;">
        <b>Enter new bid:</b>
        <input type="text" name="edited_bid_amount" value="" placeholder="Bid amount" class="form-control" />
        <br/>
        <b>Bid details:</b>
        <br/>
          <textarea
            name="edited_bid_details" placeholder="Tell us why you're good at this task!"
            class="form-control"><?php echo $bid->{'details'}; ?></textarea>
        <br/>
        <div style="text-align: center;">
          <input type="submit" name="edit_bid" value="Update Bid" class="btn btn-embossed btn-sm btn-primary" style="margin-right: 0.5em;">
          <input type="submit" name="delete_bid" value="Retract Bid" class="btn btn-embossed btn-sm btn-danger" style="margin-left: 0.5em;">
        </div>
      </div>
    </form>
  </li>
</ul>
