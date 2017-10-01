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
                        <tr><th>Title</th><th>Description</th><th>Create time</th>
                            <th>Updated time</th><th>Expiry</th><th>Event Date</th>
                            <th>Min Bid</th><th>Max Bid</th><th>Tasker</th>
                        </tr>
                        </thead><tbody>
                        <?php
                        foreach ($tasks as $task) {
                            echo '<tr>';
                            foreach ($task as $item) {
                                echo "<td>$item</td>";
                            }
                            // TODO: to re-implement the link to Task page
                            //echo "<td><a href='/tasks/task/".$task->{'id'}."'>Link</a></td>";
                            echo '</tr>';
                        }
                        ?></tbody></table>
            </div><!-- /content-panel -->
        </div><!-- /col-lg-4 -->
    </div><!-- /row -->
</div>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
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
