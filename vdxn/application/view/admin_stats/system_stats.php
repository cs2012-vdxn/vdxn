<div class="container">
  <!-- STATS FOR USERS SECTION -->
  <h5 class="page-header">
    Users
  </h5>
  <div class="row">
    <div class="col-md-4">
      [Some stats]
    </div>
    <div class="col-md-4">
      [Some stats]
    </div>
    <div class="col-md-4">
      [Some stats]
    </div>
  </div>

  <!-- STATS FOR TASKS SECTION -->
  <h5 class="page-header">
    Tasks
  </h5>
  <div class="row">
    <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          Tasks Completed
        </div>
        <div class="panel-body">
          <p>
            No. of completed tasks: <b><?php echo $num_tasks_completed; ?></b>
          </p>
          <p>
            No. of uncompleted tasks: <b><?php echo $num_tasks_uncompleted; ?></b>
          </p>
          <br />
          <p>
            Total no. of tasks: <b><?php echo $num_tasks_completed + $num_tasks_uncompleted; ?></b>
          </p>
        </div>
      </div>
    </div>

    <div class="col-md-8">
      <div class="panel panel-default" style="padding: 1em;">
        <p>
          Between these dates:
          <br/>
          No. of completed tasks: <b><?php echo $num_tasks_completed_between; ?></b>
        </p>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          Bids Created
        </div>
        <div class="panel-body">
          <p>
            Total no. of bids created: <b><?php echo $num_bids_total; ?></b>
          </p>
        </div>
      </div>
    </div>

    <div class="col-md-8">
      <div class="panel panel-default" style="padding: 1em;">
        <p>
          Between these dates:
          <br/>
          No. of bids created: <b><?php echo $num_bids_between; ?></b>
        </p>
      </div>
    </div>
  </div>

</div>
