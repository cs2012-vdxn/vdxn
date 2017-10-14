<select class="pagination-pagesize" id="bidded-history-pagesize">
  <option value="10">10</option>
  <option value="20">20</option>
  <option value="30">30</option>
  <option value="40">40</option>
</select>
<script type="text/javascript">
    $(document).ready(function() {
      $("#bidded-history-pagesize").change(function() {
        var table = $(this).next();
        table.data("pagesize", $(this).val());
        $.ajax({
            type: "POST",
            url: 'table/fetchHistoryBiddedTasks',
            data: { offset: table.data("offset"), pagesize: $(this).val() },
            cache: false,
            success: function(html){
                $("table#bidded-history-table tbody").html(html);
            }
        });
      });
    });
</script>
