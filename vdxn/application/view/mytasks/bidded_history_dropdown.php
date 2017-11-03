<select class="pagination-pagesize" id="bidded-history-pagesize">
  <option value="10">10</option>
  <option value="20">20</option>
  <option value="30">30</option>
  <option value="40">40</option>
</select>
<script type="text/javascript">
    $(document).ready(function() {
      $("#bidded-history-pagesize select").val($("#bidded-history-table").data("pagesize"));
      $("#bidded-history-pagesize").change(function() {
        var table = $("#bidded-history-table");
        table.data("pagesize", $(this).val());
        $.ajax({
            type: "POST",
            url: '/table/fetchHistoryBiddedTasks',
            data: { offset: 0, pagesize: $(this).val(), order_by: table.data("order_by"), dir: table.data("dir") },
            cache: false,
            success: function(html){
                $("table#bidded-history-table tbody").html(html);
                paginate();
            }
        });
      });
    });
</script>
