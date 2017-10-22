$(document).ready(function() {
  var pagesize = parseInt($('#created-history-table').data('pagesize'));
  var total = parseInt($('#created-history-table').data('total'));
  var numPage = Math.ceil(parseFloat(total/pagesize));
  console.log(pagesize);
  console.log(total);
  if(total > pagesize) {
    var pagn = '<div id="created-history-table-pagination" class="table-pagination">';
    for (var i = 1; i <= numPage; i++) {
      pagn += '<span class="pagination-button" data-start=' + ((i- 1) *pagesize) + '>'+ i + '</span>';
    }
  }
  $('.table-wrapper').append(pagn);

  $('.table-wrapper .pagination-button').click(function() {
    var table = $('#created-history-table');
    table.data('offset', $(this).data('start'));
    $.ajax({
        type: 'POST',
        url: '/table/fetchCompletedTasks',
        data: { offset: table.data('offset'), pagesize: table.data('pagesize'), order_by: table.data('order_by'), dir: table.data('dir') },
        cache: false,
        success: function(html){
            $('table#created-history-table tbody').html(html);
        }
    });
  });
});
