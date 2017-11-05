<script>
  // Input validation when editing a task
  function validateEditTask() {
    var title = $('#create_task_title').val();
    var desc = $('#create_task_desc').val();
    var start_date = $('#startDateDp').val();
    var end_date = $('#endDateDp').val();
    var min_bid = $('#create_task_min_bid').val();
    var max_bid = $('#create_task_max_bid').val();
    var category = $('#sel1').val();
    var tags = $('#create_task_tags').val();

    // Reset state of error messages before doing the checks
    $('.err_create_task_required').hide();
    $('.err_create_task_bids_NAN').hide();
    $('.err_create_task_bids_impossible').hide();
    $('.err_create_task_start_date_impossible').hide();

    var REQUIRED_INPUTS_ARE_EMPTY = false;
    if (title.length == 0 || desc.length == 0) {
      REQUIRED_INPUTS_ARE_EMPTY = true;
      $('.err_create_task_required').show();
    }

    var BIDS_ARE_NAN = false;
    var MIN_BID_MORE_THAN_MAX_BID = false;
    if (isNaN(min_bid) || isNaN(max_bid)) {
      BIDS_ARE_NAN = true;
      $('.err_create_task_bids_NAN').show();
    } else {
      if (parseFloat(min_bid) > parseFloat(max_bid)) {
        MIN_BID_MORE_THAN_MAX_BID = true;
        $('.err_create_task_bids_impossible').show();
      }
    }

    return !REQUIRED_INPUTS_ARE_EMPTY && !BIDS_ARE_NAN && !MIN_BID_MORE_THAN_MAX_BID;
  }
</script>

<div class="container">
  <div class="col-lg-6 col-md-10" style="min-height: 100%; padding: 0px;">
    <h1>Edit Task</h1>
    <div class="login-form">
      <div class="form-group">
        <form name="editTaskForm"
              onsubmit="return validateEditTask()"
              method="post"
              action="">

          <div class="form-group">
            <label style="font-size: 20px;"><b>Title</b><b style="color: #c91212;"> (required)</b></label>
            <input id="create_task_title" type="text" name="title" value="<?php echo $task->{'title'}?>" class="form-control login-field" placeholder="Title">
            <div class="err_create_task_required" style="display:none;">
              <span style="color: #c91212; font-size: 0.9em;">* please enter a value</span>
            </div>
          </div>

          <div class="form-group">
            <label style="font-size: 20px;"><b>Description</b></label>
            <textarea id="create_task_desc" name="description" class="form-control login-field"
              placeholder="Description"><?php echo $task->{'description'}?></textarea>
          </div>

          <!-- Remove for now
          <div class="form-group">
            <label style="font-size: 20px;"><b>Start At</b></label>
            <input type="text" name="start_at" value="<?php echo $task->{'start_at'}?>" class="form-control login-field" placeholder="Start at">
          </div>
          -->

          <div class="form-group">
            <label style="font-size: 20px;"><b>Min Bid</b></label>
            <input id="create_task_min_bid" type="text" name="min_bid"  value="<?php echo $task->{'min_bid'}?>" class="form-control login-field" placeholder="Min bid">
            <div class="err_create_task_bids_NAN" style="display:none;">
              <span style="color: #c91212; font-size: 0.9em;">* bid is not a number!</span>
            </div>
            <div class="err_create_task_bids_impossible" style="display:none;">
              <span style="color: #c91212; font-size: 0.9em;">* bid is more than the max!</span>
            </div>
          </div>

          <div class="form-group">
            <label style="font-size: 20px;"><b>Max Bid</b></label>
            <input id="create_task_max_bid" type="text" name="max_bid" value="<?php echo $task->{'max_bid'}?>" class="form-control login-field" placeholder="Min bid">
            <div class="err_create_task_bids_NAN" style="display:none;">
              <span style="color: #c91212; font-size: 0.9em;">* bid is not a number!</span>
            </div>
          </div>

          <br/>
          <input class="btn btn-primary btn-lg btn-block" type="submit" value="Update">
        </form>
      </div>
    </div>
  </div>
</div>
