<!-- Task Information -->
<h3><?php echo $task->{'title'}; ?></h3>
<p>
  <b>Creator: <?php echo $task->{'creator_username'};?></b>
  <b style="padding-left: 2em;">Due:</b> <?php echo $task->{'created_at'}; ?>
</p>
<p><?php echo $task->{'description'}; ?></p>
<p>Category: <?php
    $category = $Task -> getCategoryOfTask($task->{'title'}, $task->{'creator_username'});
    if ($category != '') {
      echo $category;
    } else {
        echo 'No Category Specified by User.';
    }?></p>
<p> Tags: <?php
    $tags = $Task -> getTagsOfTask($task->{'title'}, $task->{'creator_username'});
    if($tags != '') {
        echo $tags;
    } else {
        echo 'No tags applicable';
    }
    ?>
</p>
<p style="">
  <small>
    <b>Created:</b> <?php echo $task->{'created_at'}; ?>
    <b style="padding-left: 2em;">Updated:</b> <?php echo $task->{'updated_at'}; ?>
  </small>
</p>
