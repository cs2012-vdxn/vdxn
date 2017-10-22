<select class="pagination-pagesize" id="bidded-tasks-pagesize">
  <option value="10">10</option>
  <option value="20">20</option>
  <option value="30">30</option>
  <option value="40">40</option>
</select>
<script type="text/javascript">
    $(document).ready(function() {
      $("#bidded-tasks-pagesize select").val($("#bidded-tasks-table").data("pagesize"));
      $("#bidded-tasks-pagesize").change(function() {
        var table = $("#bidded-tasks-table");
        table.data("pagesize", $(this).val());
        $.ajax({
            type: "POST",
            url: '/table/fetchCurrentBiddedTasks',
            data: { offset: table.data("offset"), pagesize: $(this).val(), order_by: table.data("order_by"), dir: table.data("dir") },
            cache: false,
            success: function(html){
                $("table#bidded-tasks-table tbody").html(html);
            }
        });
      });
    });
</script>
