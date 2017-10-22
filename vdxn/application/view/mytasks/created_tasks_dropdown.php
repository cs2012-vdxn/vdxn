<select class="pagination-pagesize" id="created-tasks-pagesize">
  <option value="10">10</option>
  <option value="20">20</option>
  <option value="30">30</option>
  <option value="40">40</option>
</select>
<script type="text/javascript">
    $(document).ready(function() {
      $("#created-tasks-pagesize select").val($("#created-tasks-table").data("pagesize"));
      $("#created-tasks-pagesize").change(function() {
        var table = $("#created-tasks-table");
        table.data("pagesize", $(this).val());
        $.ajax({
            type: "POST",
            url: '/table/fetchCreatedTasks',
            data: { offset: 0, pagesize: $(this).val(), order_by: table.data("order_by"), dir: table.data("dir") },
            cache: false,
            success: function(html){
                $("table#created-tasks-table tbody").html(html);
                paginate();
            }
        });
      });
    });
</script>
