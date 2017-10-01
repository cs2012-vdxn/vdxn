<div class="container">
    <h1>Tasks</h1>
    <p>
        Content should contain all tasks available in the system that is
        available for bidding
    </p>
    <div class="row">
        <div class="col-xm">
            <p>Type a title to begin searching</p>
            <form class="form-horizontal" name="search" role="form" method="POST">
                <div class="input-group col-xm">
                    <input type="text" id="name" name="name" class="form-control" placeholder="Search by title..."
                           autocomplete="off"/>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default btnSearch">
                            <span class="glyphicon glyphicon-search"> </span>
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>

    <div class="row mt">
      <div class="col-lg-12">
        <div class="content-panel tablesearch">
          <table id="resultTable" class="table table-bordered table-hover table-condensed">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Created at</th>
                  <th>Updated at</th>
                  <th>Start at</th>
                  <th>End at</th>
                  <th>Min Bid</th>
                  <th>Max Bid</th>
                  <th>Creator</th>
                  <th>Creator Rating</th>
                  <th>Assignee</th>
                  <th>Assignee Rating</th>
                  <th>Completed at</th>
                  <th>Deleted at</th>
                  <th>Remarks</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($tasks as $task) {
                  echo '<tr>';
                  echo '<td>' . $task->title . '</td>';
                  echo '<td>' . $task->description . '</td>';
                  echo '<td>' . $task->created_at . '</td>';
                  echo '<td>' . $task->updated_at . '</td>';
                  echo '<td>' . $task->start_at . '</td>';
                  echo '<td>' . $task->end_at . '</td>';
                  echo '<td>' . $task->min_bid . '</td>';
                  echo '<td>' . $task->max_bid . '</td>';
                  echo '<td>' . $task->creator_username . '</td>';
                  echo '<td>' . $task->creator_rating . '</td>';
                  echo '<td>' . $task->assignee_username . '</td>';
                  echo '<td>' . $task->assignee_rating . '</td>';
                  echo '<td>' . $task->completed_at . '</td>';
                  echo '<td>' . $task->deleted_at . '</td>';
                  echo '<td>' . $task->remarks . '</td>';

                  // Link to Task page
                  echo "<td><a href='/tasks/task?title=" .
                        $task->title . "&creator_username=" .
                        $task->creator_username .
                        "'>Link</a></td>";
                  echo '</tr>';
                }
                ?>
              </tbody>
            </table>
        </div><!-- /content-panel -->
      </div><!-- /col-lg-12 -->
    </div><!-- /row -->
</div>

<script type="text/javascript">
    $(document).ready(function() {

        function search() {
            var query_value = $('input#name').val();

                $.ajax({
                    type: "POST",
                    url: 'tasks/searchByTitle',
                    data: { query: query_value },
                    cache: false,
                    success: function(html){
                        $("table#resultTable tbody").html(html);
                        console.log(html);
                    }
                });


        }

        $('input#name').on("keyup input", function(e) {

            // Set Search String
            var search_string = $(this).val();

            // Do Search
                search();
                $(".tablesearch").fadeIn(300);
                console.log('key is' + search_string);
        });

    });
</script>
