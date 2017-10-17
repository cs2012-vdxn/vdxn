<div class="row">
  <!-- Task Information -->
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
    /* For Task Owners to perform Edit & Delete operations on this task */
    if ($isTaskOwner) {
      $link_to_edit_task_page = '/tasks/edittask?title='.$task->{'title'}.'&creator_username='.$username;
      $link_to_del_task_page = '/tasks/deletetask?title='.$task->{'title'}.'&creator_username='.$username;
      echo '<p>';
      echo '<a href="'.$link_to_edit_task_page.'"
              class="btn btn-embossed btn-sm btn-primary">
              <span class="fui-new"></span> Edit
            </a>';
      echo '<a href="'.$link_to_del_task_page.'"
              class="btn btn-embossed btn-sm btn-danger" style="margin-left: 0.75em;">
              <span class="fui-trash"></span> Delete
            </a>';
      echo '</p>';
    }
  ?>

  <hr/>

  <script>
    // Quick check to see if a specified form & bid amount is within range or not
    function validateEnteredBid(formName, bidAmount) {
      var bid = document.forms[formName][bidAmount].value;
      if (bid.length > 0 &&
          bid >= <?php echo $task->{'min_bid'} ?> &&
          bid <= <?php echo $task->{'max_bid'} ?>) {
        $('.err_bid_out_of_range').hide();
        return true;
      } else {
        $('.err_bid_out_of_range').show();
        return false;
      }
    }
  </script>

  <?php
    /* Renders the section where bids for this task can be placed,
       edited or deleted */
    echo '<div class="row">';
    if(!$isTaskOwner) {
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
    }
    echo '<div class="col-md-8">';
    include('bids_top3.php');
    echo   '</div>';
    echo '</div>';
  ?>

</div>
