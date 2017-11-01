<div class="container">
  <div class="col-lg-6 col-md-10" style="min-height: 100%; padding: 0px;">
    <h1>Edit Task</h1>
    <div class="login-form">
      <div class="form-group">
        <form method="post" action="">
          <div class="form-group">
            <label style="font-size: 20px;"><b>Title</b></label>
            <input type="text" name="title" value="<?php echo $task->{'title'}?>" class="form-control login-field" placeholder="Title">
          </div>

          <div class="form-group">
            <label style="font-size: 20px;"><b>Description</b></label>
            <textarea name="description" class="form-control login-field"
              placeholder="Description"><?php echo $task->{'description'}?></textarea>
          </div>

          <div class="form-group">
            <label style="font-size: 20px;"><b>Start At</b></label>
            <input type="text" name="start_at" value="<?php echo $task->{'start_at'}?>" class="form-control login-field" placeholder="Start at">
          </div>

          <div class="form-group">
            <label style="font-size: 20px;"><b>Min Bid</b></label>
            <input type="text" name="min_bid"  value="<?php echo $task->{'min_bid'}?>" class="form-control login-field" placeholder="Min bid">
          </div>

          <div class="form-group">
            <label style="font-size: 20px;"><b>Max Bid</b></label>
            <input type="text" name="max_bid" value="<?php echo $task->{'max_bid'}?>" class="form-control login-field" placeholder="Min bid">
          </div>

          <br/>
          <input class="btn btn-primary btn-lg btn-block" type="submit" value="Update">
        </form>
      </div>
    </div>
  </div>
</div>
