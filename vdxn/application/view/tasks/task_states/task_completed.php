<div class="container-fluid">
  <!-- Task has been completed, rate task creator & doer -->
  <?php
    if (!$isTaskOwner && !$isTaskAssignee) {
      echo '<p>You weren\'t selected for this task, but don\'t worry, more tasks await your doing!</p>';
    } else {
      echo '<h3>Task completed!</h3>';
    }
  ?>

  <script>
    // Quick check to see if a creator / doer rating is within range or not
    function validateEnteredRating(formName, rating) {
      var rating = parseFloat(document.forms[formName][rating].value);
      if (!isNaN(rating)) {
        if (rating >= 0 && rating <= 5) {
          $('.err_rating').hide();
          return true;
        }
      }
      $('.err_rating').show();
      return false;
    }
  </script>

  <?php
    // For Task Owners to rate their assignees / doers
    if ($isTaskOwner && !$assignee_rating) {
      $post_method_action_url_rate_assignee =
        "/tasks/rate_assignee?title=".$task->{"title"}.
        "&creator_username=".$task->{"creator_username"};

      echo '<form method="post"';
      echo '      name="rateDoerForm"';
      echo '      onsubmit="return validateEnteredRating(\'rateDoerForm\', \'task_doer_rating\')"';
      echo '      action="'.$post_method_action_url_rate_assignee.'">';
      echo '  <div class="col-lg-4 col-md-4">';
      echo '    <div style="text-align: left;">';
      echo '      <b>Rate your doer:</b>';
      echo '    </div>';
      echo '    <input type="text" name="task_doer_rating" value="" placeholder="0-5" class="form-control"/>';
      echo '    <div class="err_rating" style="display:none;">';
      echo '      <span style="color: #c91212; font-size: 0.9em;">* Please enter a rating from 0 - 5</span>';
      echo '    </div>';
      echo '    <br /> ';
      echo '    <input type="submit" name="rate_task_doer" value="RATE"';
      echo '           class="btn btn-embossed btn-wide btn-primary" style="margin-top: 10px;"/>';
      echo '  </div>';
      echo '</form>';
    } else if ($isTaskOwner && $assignee_rating) {
      echo '<p>You rated your task doer '.$assignee_rating.' points.</p>';
    }

    // For assignees to rate their task creators
    if ($isTaskAssignee && !$creator_rating) {
      $post_method_action_url_rate_creator =
        "/tasks/rate_creator?title=".$task->{"title"}.
        "&creator_username=".$task->{"creator_username"};

      echo '<form method="post"';
      echo '      name="rateCreatorForm"';
      echo '      onsubmit="return validateEnteredRating(\'rateCreatorForm\', \'task_creator_rating\')"';
      echo '      action="'.$post_method_action_url_rate_creator.'">';
      echo '  <div class="col-lg-4 col-md-4">';
      echo '    <div style="text-align: left;">';
      echo '      <b>Rate the task creator:</b>';
      echo '    </div>';
      echo '    <input type="text" name="task_creator_rating" value="" placeholder="0-5" class="form-control" />';
      echo '    <div class="err_rating" style="display:none;">';
      echo '      <span style="color: #c91212; font-size: 0.9em;">* Please enter a rating from 0 - 5</span>';
      echo '    </div>';
      echo '    <br /> ';
      echo '    <input type="submit" name="rate_task_doer" value="RATE"';
      echo '           class="btn btn-embossed btn-wide btn-primary"/>';
      echo '  </div>';
      echo '</form>';
    } else if ($isTaskAssignee && $creator_rating) {
      echo '<p>You rated your task creator '.$creator_rating.' points.</p>';
    }
  ?>
</div>
