<div class="container">
    <h1>Edit Task</h1>
    <p>
      Here is where a task is editted
    </p>
    <form method="post" action="">
      <label>Title</label>
      <br>
      <input type="text" name="title" value="<?php echo $task->{'title'}?>">
      <br>
      <label>Description</label>
      <br>
      <textarea name="description"><?php echo $task->{'description'}?></textarea>
      <br>
      <label>Task Date</label>
      <br>
      <input type="text" name="start_at" value="<?php echo $task->{'start_at'}?>">
      <br>
      <label>Min bid</label>
      <br>
      <input type="text" name="min_bid"  value="<?php echo $task->{'min_bid'}?>">
      <br>
      <label>Max bid</label>
      <br>
      <input type="text" name="max_bid" value="<?php echo $task->{'max_bid'}?>">
      <br>
      <input type="submit" value="Update Task">
      <button href="/tasks/deletetask/<?php echo $tid;?>">Delete</button>
    </form>
</div>
