<select class="pagination-pagesize" id="created-history-pagesize">
  <option value="10">10</option>
  <option value="20">20</option>
  <option value="30">30</option>
  <option value="40">40</option>
</select>
<script type="text/javascript">
    $(document).ready(function() {
      $("#created-history-pagesize select").val($("#created-history-table").data("pagesize"));
      $("#created-history-pagesize").change(function() {
        <?php echo "CHANGED" . $(this).val() ?>
        var table = $("#created-history-table");
        table.data("pagesize", $(this).val());
        $.ajax({
            type: "POST",
            url: 'table/fetchCompletedTasks',
            data: { offset: table.data("offset"), pagesize: $(this).val(), order_by: table.data("order_by") },
            cache: false,
            success: function(html){
                $("table#created-history-table tbody").html(html);
            }
        });
      });
    });
</script>
