<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>
  $( function() {
    $( "#startDateDp" ).datepicker({ dateFormat: 'yy-mm-dd' });
    $( "#endDateDp" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );

  // Input validation when creating a task
  function validateCreateTask(formName) {
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
    if (title.length == 0 || start_date.length == 0) {
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

    var START_DATE_MORE_THAN_END_DATE = false;
    if (start_date > end_date) {
      START_DATE_MORE_THAN_END_DATE = true;
      $('.err_create_task_start_date_impossible').show();
    }

    return !REQUIRED_INPUTS_ARE_EMPTY &&
           !BIDS_ARE_NAN &&
           !MIN_BID_MORE_THAN_MAX_BID &&
           !START_DATE_MORE_THAN_END_DATE;
  }
</script>
<div class="container">
  <div class="col-lg-6 col-md-10" style="min-height: 100%; padding: 0px;">
    <h1>Create a New Task</h1>
    <p>
      Fill in as much information as possible to get the best doers!
    </p>
    <div class="login-form">
      <div class="form-group">
        <form name="createTaskForm"
              onsubmit="return validateCreateTask('createTaskForm')"
              method="post"
              action="/tasks/newtask">
          <div class="form-group">
            <label><b>Title</b><b style="color: #c91212;"> (required)</b></label>
            <input id="create_task_title" type="text" name="title" class="form-control login-field" placeholder="Enter Title">
            <div class="err_create_task_required" style="display:none;">
              <span style="color: #c91212; font-size: 0.9em;">* please enter a value</span>
            </div>
          </div>

          <div class="form-group">
            <label><b>Description</b></label>
            <textarea id="create_task_desc" name="description" class="form-control login-field" placeholder="Enter Description"></textarea>
          </div>

          <div class="form-group">
            <label><b>Start Date</b><b style="color: #c91212;"> (required)</b></label>
            <input id="startDateDp" type="text" name="taskdate" class="form-control login-field" placeholder="Set start date">
            <div class="err_create_task_required" style="display:none;">
              <span style="color: #c91212; font-size: 0.9em;">* please enter a value</span>
            </div>
            <div class="err_create_task_start_date_impossible" style="display:none;">
              <span style="color: #c91212; font-size: 0.9em;">* date is more than the max!</span>
            </div>
          </div>

          <div class="form-group">
            <label><b>End Date</b></label>
            <input id="endDateDp" type="text" name="enddate" class="form-control login-field" placeholder="Set end date">
          </div>

          <div class="form-group">
            <label><b>Min bid</b></label>
            <input id="create_task_min_bid" type="text" name="min_bid" class="form-control login-field" placeholder="Enter min bid">
            <div class="err_create_task_bids_NAN" style="display:none;">
              <span style="color: #c91212; font-size: 0.9em;">* bid is not a number!</span>
            </div>
            <div class="err_create_task_bids_impossible" style="display:none;">
              <span style="color: #c91212; font-size: 0.9em;">* bid is more than the max!</span>
            </div>
          </div>

          <div class="form-group">
            <label><b>Max bid</b></label>
            <input id="create_task_max_bid" type="text" name="max_bid" class="form-control login-field" placeholder="Enter max bid">
            <div class="err_create_task_bids_NAN" style="display:none;">
              <span style="color: #c91212; font-size: 0.9em;">* bid is not a number!</span>
            </div>
          </div>

          <br/>
          <label style="font-size: 24px;"><b>Category</b></label>
          <br>
          <div class="form-group">
              <label for="sel1">Please select a Category</label>
              <select class="form-control" id="sel1" name="category">
                  <option> </option>
                  <option>Minor Repairs</option>
                  <option>Mounting</option>
                  <option>Assembly</option>
                  <option>Help Moving</option>
                  <option>Delivery</option>
                  <option>BabySitting</option>
                  <option>Others</option>
              </select>
          </div>
          <br/>
          <label style="font-size: 24px;"><b>Tags</b></label>
          <br/>
          <div class="tagsinput-primary">
            <label for="create_task_tags">You may include multiple tags</label>
            <input id="create_task_tags" name="tagsinput" class="tagsinput" data-role="tagsinput" value="" />
          </div>
          <b/r>
          <input class="btn btn-primary btn-lg btn-block" type="submit" value="Create task">
        </form>
      </div>
    </div>
  </div>
</div>
