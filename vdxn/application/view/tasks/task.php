<div class="row">
  <!-- Task information -->
  <?php include('task_information.php'); ?>
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

  <!-- Renders the Bidding Section -->
  <?php
    echo '<div class="row">';
    if(!$isTaskOwner) {
      /*  Where bids for this task can be created, edited or deleted  */
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
      /* Top 3 Bidders */
      include('bids_display/bids_top3.php');
      echo '</div>';
    echo '</div>';
  ?>

  <?php
  /* All Bidders - Here, the task creator can assign a bidder to this task */
  echo '<hr/>';
  include('bids_display/bids_all.php');
  ?>
</div>
