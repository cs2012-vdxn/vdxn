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
      echo '<div class="row">';
      echo  '<div class="col-md-4" style="margin-bottom: 20px;">';
      echo    '<div class="share mrl">';
      include('bids_CRUD/bids_read.php');
      if ($hasUserBid) {
        include('bids_CRUD/bids_edit_del.php');
      } else {
        include('bids_CRUD/bids_create.php');
      }
      echo    '</div>';
      echo  '</div>';
      echo  '<div class="col-md-8">';
      include('bids_top3.php');
      echo  '</div>';
      echo '</div>';
    } else {
      echo 'Hi, I am task owner. No need to bid for my own tasks :)';
    }
  ?>

</div>
