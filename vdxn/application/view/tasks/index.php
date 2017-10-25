<div class="container">
    <h1>Tasks</h1>
    <p>
        Content should contain all tasks available in the system that is
        available for bidding
    </p>
    <div class="row">
        <div class="col-xm">
            <p>Type a title/category/tag to begin searching</p>
            <form class="form-horizontal" name="search" role="form" method="POST">
                <div class="input-group col-xm">
                    <input type="text" id="name" name="name" class="form-control" placeholder="Search by title/category/tag..."
                           autocomplete="off"/>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default btnSearch">
                            <span class="glyphicon glyphicon-search"> </span>
                        </button>
                    </span>
                </div>
                <div class="form-check">
                    <label style="font-size: large ;font-family: bold">Sort by: </label>
                    <label class="form-check-label" style="font-size: large" id="sdasc-label">
                    <input type="checkbox" class="form-check-input" id="sdasc" value="Task.start_at ASC">
                        Starting Date ASC
                    </label>
                    <label class="form-check-label" style="font-size: large" id="sddsc-label">
                        <input type="checkbox" class="form-check-input" id="sddsc" value="Task.start_at DESC">
                        Start Date DESC
                    </label>
                    <label class="form-check-label" style="font-size: large" id="edasc-label">
                        <input type="checkbox" class="form-check-input" id="edasc" value="Task.end_at ASC">
                        End Date ASC
                    </label>
                    <label class="form-check-label" style="font-size: large" id="eddsc-label">
                        <input type="checkbox" class="form-check-input" id="eddsc" value="Task.end_at DESC">
                        End Date DESC
                    </label>
                    <label class="form-check-label" style="font-size: large" id="tdasc-label">
                        <input type="checkbox" class="form-check-input" id="tdasc" value="duration ASC">
                        Task Duration ASC
                    </label>
                    <label class="form-check-label" style="font-size: large" id="tddsc-label">
                        <input type="checkbox" class="form-check-input" id="tddsc" value="duration DESC">
                        Task Duration DESC
                    </label>
                </div>
                <div>
                    <label style="font-size: large ;font-family: bold">Filter by: </label>
                    <?php require APP. 'view/tasks/task_filter/filter_panel.php'?>
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
                    <th>Category</th>
                    <th>Tags</th>
                  <th>Remarks</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($tasks as $task) {
                    $category = $Task -> getCategoryOfTask($task->title, $task->creator_username);
                    $tags = $Task -> getTagsOfTask($task->title, $task->creator_username);
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
                  echo '<td>' . $category . '</td>';
                  echo '<td>' . $tags . '</td>';
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
         var data = localStorage.getItem('category');
         if (data != undefined) {
             $('input#name').val(data);
             query_value = 'c.category_name='+'\''+data+'\'';
             $.ajax({
                 type: "POST",
                 url: 'tasks/filterTasks',
                 data: {query: query_value},
                 cache: false,
                 success: function(html) {
                     $("table#resultTable tbody").html(html);
                     localStorage.removeItem('category');
                 }
             });

         }
        function search() {
            var query_value = $('input#name').val();

                $.ajax({
                    type: "POST",
                    url: 'tasks/searchByTitle',
                    data: { query: query_value },
                    cache: false,
                    success: function(html){
                        $("table#resultTable tbody").html(html);
                    }
                });
        }

        function toggleSortBox() {
            var criteria = document.forms[0];
            var i;
            var txt ="";
            for(i = 0; i < criteria.length; i++) {
                if (criteria[i].checked) {
                    if (txt != "") {
                        txt += ", ";
                    }
                    txt += criteria[i].value;
                }
            }

            $.ajax({
                type: "POST",
                url: 'tasks/filterByAttributes',
                data: {query: txt},
                cache: false,
                success: function(html) {
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
        });

        $('#sdasc').on('change', function() {
            if($('#sdasc').prop('checked')) {
                $('#sddsc').attr('disabled', 'disabled');
                $('#sddsc-label').css('color', 'darkgray');
            } else {
                $('#sddsc').removeAttr('disabled');
                $('#sddsc-label').css('color', '#37474F');
            }
            toggleSortBox();
        });
        $('#sddsc').on('change', function() {
            if($('#sddsc').prop('checked')) {
                $('#sdasc').attr('disabled', 'disabled');
                $('#sdasc-label').css('color', 'darkgray');
            } else {
                $('#sdasc').removeAttr('disabled');
                $('#sdasc-label').css('color', '#37474F');
            }
            toggleSortBox();
        });
        $('#edasc').on('change', function() {
            if($('#edasc').prop('checked')) {
                $('#eddsc').attr('disabled', 'disabled');
                $('#eddsc-label').css('color', 'darkgray');
            } else {
                $('#eddsc').removeAttr('disabled');
                $('#eddsc-label').css('color', '#37474F');
            }
            toggleSortBox();
        });
        $('#eddsc').on('change', function() {
            if($('#eddsc').prop('checked')) {
                $('#edasc').attr('disabled', 'disabled');
                $('#edasc-label').css('color', 'darkgray');
            } else {
                $('#edasc').removeAttr('disabled');
                $('#edasc-label').css('color', '#37474F');
            }
            toggleSortBox();
        });
        $('#tdasc').on('change', function() {
            if($('#tdasc').prop('checked')) {
                $('#tddsc').attr('disabled', 'disabled');
                $('#tddsc-label').css('color', 'darkgray');
            } else {
                $('#tddsc').removeAttr('disabled');
                $('#tddsc-label').css('color', '#37474F');
            }
            toggleSortBox();
        });
        $('#tddsc').on('change', function() {
            if($('#tddsc').prop('checked')) {
                $('#tdasc').attr('disabled', 'disabled');
                $('#tdasc-label').css('color', 'darkgray');
            } else {
                $('#tdasc').removeAttr('disabled');
                $('#tdasc-label').css('color', '#37474F');
            }
            toggleSortBox();
        });

    });
</script>
