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

  <?php
    if ($isTaskOwner) {
      echo '<p>';
      echo '<a href="#nothing" class="btn btn-embossed btn-sm btn-primary">
              <span class="fui-new"></span> Edit
            </a>';
      echo '<a href="#nothing" class="btn btn-embossed btn-sm btn-danger" style="margin-left: 0.75em;">
              <span class="fui-trash"></span> Delete
            </a>';
      echo '</p>';
    }
  ?>

  <hr/>

  <?php
    if(!$isTaskOwner) {
      echo '<div class="col-md-offset-3 col-md-6 col-xs-8 col-xs-offset-2" style="margin-bottom: 20px;">';
      echo   '<div class="share mrl">';
      echo      '<ul>';
      echo        '<li>';
      if ($hasUserBid) {
        echo          '<form method="post" action="/tasks/del_or_edit_bid?title='.$task->{"title"}.'&creator_username='.$task->{"creator_username"}.'">';
        echo          '<div style="margin: 0 0 10px 3px;">
                        <b>Current bid: '.$bid->{'amount'}.'</b>
                        <input type="text" name="edited_bid_amount" value="" placeholder="Enter new bid" class="form-control" />
                        <br/>
                        <b>Bid details:</b>
                        <br>
                          <textarea name="edited_bid_details" placeholder="Any comments about yourself?" class="form-control">'.$bid->{'details'}.'</textarea>
                        <br>
                        <div style="text-align: center;">
                          <input type="submit" name="edit_bid" value="Update Bid" class="btn btn-embossed btn-sm btn-primary">
                          <input type="submit" name="delete_bid" value="Retract Bid" class="btn btn-embossed btn-sm btn-danger" style="margin-left: 1em;">
                        </div>
                      </div>';
        echo          '</form>';
      } else {
        echo          '<form method="post" action="/tasks/newbid?title='.$task->{"title"}.'&creator_username='.$task->{"creator_username"}.'">';
        echo          '<div style="margin: 0 0 10px 3px;">
                        <b>You haven\'t bidded for this task yet.</b>
                        <input type="text" name="bid_amount" value="" placeholder="Enter bid amount" class="form-control" style="margin-bottom: 1.5em;"/>

                        <b>Bid details:</b>
                        <br><textarea name="bid_details" placeholder="Any comments about yourself?" class="form-control"></textarea><br>
                        <div style="text-align: center;">
                          <input type="submit" name="create_bid" value="Place Bid" class="btn btn-embossed btn-sm btn-primary">
                        </div>
                      </div>';
      }
      echo        '</li>';
      echo      '</ul>';
      echo    '</div>';
      echo '</div>';
    } else {
      echo 'Hi, I am task owner. No need to bid for my own tasks :)';
    }
  ?>

</div>
