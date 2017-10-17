<!-- Task Information -->
<h3><?php echo $task->{'title'}; ?></h3>
<p>
  <b>Creator: <?php echo $task->{'creator_username'};?></b>
  <b style="padding-left: 2em;">Due:</b> <?php echo $task->{'created_at'}; ?>
</p>
<p><?php echo $task->{'description'}; ?></p>
<p>[list of tags here] [list of categories here]</p>
<p style="">
  <small>
    <b>Created at:</b> <?php echo $task->{'created_at'}; ?>
    <b style="padding-left: 2em;">Updated at:</b> <?php echo $task->{'updated_at'}; ?>
  </small>
</p>
