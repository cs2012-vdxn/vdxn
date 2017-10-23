$(document).ready(function() {
  paginate();
});
function paginate() {
  var pagesize = parseInt($('#bidded-history-table').data('pagesize'));
  var tableWrapper = $('#bidded-history-table').parent();
  tableWrapper.find('.pagination-button').remove();
  var total = parseInt($('#bidded-history-table').data('total'));
  var numPage = Math.ceil(parseFloat(total/pagesize));

  if(total > pagesize) {
    var pagn = '<div id="bidded-history-table-pagination" class="table-pagination">';
    for (var i = 1; i <= numPage; i++) {
      pagn += '<span class="pagination-button" data-page-num=' + i + ' data-start=' + ((i- 1) *pagesize)+ '>'+ i + '</span>';
    }
  }
  tableWrapper.append(pagn);
  var paginationButtons = tableWrapper.find('.pagination-button');
  paginationButtons.first().addClass('selected');
  paginationButtons.click(function() {
    var table = $('#bidded-history-table');
    table.data('offset', $(this).data('start'));
    table.data('selected-page', $(this).data('page-num'));
    $.ajax({
        type: 'POST',
        url: '/table/fetchHistoryBiddedTasks',
        data: { offset: table.data('offset'), pagesize: table.data('pagesize'), order_by: table.data('order_by'), dir: table.data('dir') },
        cache: false,
        success: function(html){
            $('table#bidded-history-table tbody').html(html);
            paginationButtons.removeClass('selected');
            var selected = $('table#bidded-history-table').data('selected-page');
            paginationButtons.eq(selected - 1).addClass('selected');
        }
    });
  });
}
