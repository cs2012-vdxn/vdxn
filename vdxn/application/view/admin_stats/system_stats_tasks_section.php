<!-- STATS FOR TASKS SECTION -->
<h5 class="page-header">
  Tasks & Bids
</h5>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        Overview
      </div>
      <div class="panel-body">
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-body">
              <p><b>Period: <?php echo $currentFromDate;?>
                to <?php echo $currentToDate;?></b></p>
              <p>Total Tasks:
                <b><?php echo $num_tasks_completed_in_range + $num_tasks_uncompleted_in_range; ?></b>
              </p>
              <p>Total Bids: <b><?php echo $num_bids_total_in_range; ?></b></p>
              <p>Average Bids Per Task: <b><?php
                $avg = $num_bids_total_in_range/($num_tasks_completed_in_range + $num_tasks_uncompleted_in_range);
                echo number_format((float)$avg, 2, '.', '');
               ?></b>
              </p>
              <p></p>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-body">
              <p><b>All Time</b></p>
              <p>Total Tasks:
                <b><?php echo $num_tasks_completed_in_all_time + $num_tasks_uncompleted_in_all_time; ?></b>
              </p>
              <p>Total Bids: <b><?php echo $num_bids_total_in_all_time; ?></b></p>
              <p>Average Bids Per Task: <b><?php
                $avg = $num_bids_total_in_all_time/($num_tasks_completed_in_all_time + $num_tasks_uncompleted_in_all_time);
                echo number_format((float)$avg, 2, '.', '');
               ?></b>
              </p>
            </div>
          </div>
        </div>
          <div class="col-md-12">

          <div id="columnchart_material" style="width: 100%; height: 500px;"></div>

          </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        Tasks Breakdown
      </div>
      <div class="panel-body">
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-body">
              <p><b>Period: <?php echo $currentFromDate;?>
                to <?php echo $currentToDate;?></b></p>
              <p>
                No. of completed tasks: <b><?php echo $num_tasks_completed_in_range; ?></b>
              </p>
              <p>
                No. of uncompleted tasks: <b><?php echo $num_tasks_uncompleted_in_range; ?></b>
              </p>
              <p>
                Total no. of tasks: <b><?php echo $num_tasks_completed_in_range + $num_tasks_uncompleted_in_range; ?></b>
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-body">
              <p>
                <b>All Time</b>
              </p>
              <p>
                No. of completed tasks: <b><?php echo $num_tasks_completed_in_all_time; ?></b>
              </p>
              <p>
                No. of uncompleted tasks: <b><?php echo $num_tasks_uncompleted_in_all_time; ?></b>
              </p>
              <p>
                Total no. of tasks: <b><?php echo $num_tasks_completed_in_all_time + $num_tasks_uncompleted_in_all_time; ?></b>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        Bids Breakdown
      </div>
      <div class="panel-body">
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-body">
              <p><b>Period: <?php echo $currentFromDate;?>
                to <?php echo $currentToDate;?></b></p>
              <p>
              <p>
                Total no. of bids created: <b><?php echo $num_bids_total_in_range; ?></b>
              </p>
        </div></div>
        </div>
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-body">
              <p>
                <b>All Time</b>
              </p>
              <p>
                No. of bids created: <b><?php echo $num_bids_total_in_all_time; ?></b>
              </p>
            </div>
          </div>
        </div>

        <div class="col-md-12">
          <h4>All-time Most Popular Tasks</h4>
            <?php
              echo '<table class="table table-bordered table-hover table-condensed">';
              echo '<thead><tr>
              <th>Title</th>
              <th>Description</th>
              <th>No. of Bids</th>
              <th>Created by</th>
              </tr></thead>';
              foreach($arr_most_pop_tasks as $pop_task) {
                echo '<tr>';
                echo '<td>'.$pop_task->title.'</td>';
                echo '<td>'.$pop_task->description.'</td>';
                echo '<td>'.$pop_task->num_bids.'</td>';
                echo '<td><a href="/myprofile?username='.$pop_task->username.'">'.$pop_task->username.'</a></td>';
                echo '</tr>';
              }
              echo '</table>';
              ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable(
            <?php echo $num_tasks_vs_bids_vs_completed_by_month;?>
        );

        var options = {
            chart: {
                title: 'Number of Bids Created, Tasks Created and Tasks Completed by Month',
                subtitle: 'From Jan 2017 to Dec 2017',
            }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
</script>

