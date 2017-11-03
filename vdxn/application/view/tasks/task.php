<!--
  INDIVIDUAL TASK PAGE
  This view defines the page where a user can see a task's details.

  TASK CREATORS
  Here, task creators can view, edit & delete their task.
  They can also choose an assignee / doer for this task. Once they do so, the
  contact information of the assignee / doer, will then be displayed so that
  task creators can liaise with them.
  Once a job is completed, task creators can mark this task as 'COMPLETE'
  and rate their assigned task doer on their performance.

  TASK DOERS
  Task doers / bidders can bid for this task and see the top 3 bids as well as
  all of the bids for this task. Chosen task doers can rate their task creators
  on this page as well, after a task has been marked as 'COMPLETE'.
-->
<div class="row">
  <!-- Task information -->
  <?php include('task_information.php'); ?>
  <?php
    /* For Task Owners to perform Edit & Delete operations on this task */
    /* They can only do so if they haven't chosen an assignee already */
    if ($isTaskOwner || $isAdmin) {
      if (!$assignee) {
        // Defining Edit & Delete task POST method's redirect URLs
        $link_to_edit_task_page =
          '/tasks/edittask?title='.$task->{'title'}.'&creator_username='.$creator_username;
        $link_to_del_task_page =
          '/tasks/deletetask?title='.$task->{'title'}.'&creator_username='.$creator_username;

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
      } else {
        if (!$completed_at) {
          /* For Task Owners to perform mark this task as COMPLETED */
          /* They can only do so if they have chosen an assignee already */
          // Defining Complete task POST method's redirect URLs
          $post_method_action_url_complete_task =
            "/tasks/mark_as_complete?title=".$task->{"title"}."&creator_username=".$username;

          echo '<form method="post"';
          echo '      action="'.$post_method_action_url_complete_task.'">';
          echo '  <div>';
          echo '    <input type="submit" name="complete_task" value="MARK AS COMPLETE"';
          echo '           class="btn btn-embossed btn-wide btn-success"/>';
          echo '  </div>';
          echo '</form>';
        }
      }
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
    if(!$isTaskOwner && !$assignee) {
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

    if (!$assignee) {
      /* Top 3 Bidders */
      echo '<div class="col-md-8">';
      include('bids_display/bids_top3.php');
      echo '</div>';
      echo '</div>';
    }
  ?>

  <?php
    /* == Section that changes depending on the task state  ==
       == BIDDING IN PROCESS, TASK ONGOING & TASK COMPLETED ==
       Here, the task creator can assign a bidder to this task.

       Once a a user has been assigned to this task, his/her contact information
       will be displayed.

       Once the task has been marked as completed by the task creator, both
       the creator and assignee / doer can rate each other.
    */
    if (!$assignee) {
      echo '<hr/>';
      include('bids_display/bids_all.php');
    } else if ($assignee && !$completed_at) {
      include('task_states/task_ongoing.php');
    } else {
      include('task_states/task_completed.php');
    }
  ?>

  <br />
  <hr />
  <?php include('similartasks.php'); ?>

</div>
