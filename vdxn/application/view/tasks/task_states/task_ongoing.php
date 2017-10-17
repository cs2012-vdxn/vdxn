<!-- Task doer's contact information -->
<h3>This task was assigned to...</h3>
<h4>
  <?php echo $assignee->first_name . ' ' .
             $assignee->last_name . ' (' .
             $assignee->username . ')'
  ?>
</h4>

<small><b>CONTACT INFORMATION</b></small><br/>
<table class="table user-contact-information-table">
  <tr>
    <td>Email:</td>
    <td><?php echo $assignee->email ?></td>
  </tr>
  <tr>
    <td>Phone:</td>
    <td><?php echo $assignee->contact ?></td>
  </tr>
  <tr>
    <td>Rating:</td>
    <td><?php echo $assignee->assignee_rating ?> / 5.0</td>
  </tr>
</table>

<small><b>INSTRUCTIONS</b></small><br/>
<p>
  Be sure to contact your doer to work out the details of your task!
  <br/>
  Return to this page once the task is done to mark it as <b>'COMPLETE'</b>.
  <br/><br/>
</p>

<!-- COMPLETE Task button -->
<?php
  // Defining Complete task POST method's redirect URLs
  $post_method_action_url_complete_task =
    "/tasks/mark_as_complete?title=" . $task->{"title"} .
    "&creator_username=" . $task->{"creator_username"};
?>
<form method="post"
      action="<?php echo $post_method_action_url_complete_task; ?>">
  <div style="text-align: center;">
    <input type="submit" name="complete_task" value="MARK AS COMPLETE"
           class="btn btn-embossed btn-wide btn-success"/>
  </div>
</form>
