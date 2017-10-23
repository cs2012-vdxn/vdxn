$(document).ready(function() {
  initializeSorting();
});

function completed() {
  $("#created-history-table.sortable th").each(function() {
    var table = $("#created-history-table");
    var arrow_up = $(this).find('.sortable__arrow--up');
    var arrow_down = $(this).find('.sortable__arrow--down');
    var all_arrows = $(this).find('.sortable__arrow');
    var order_by = $(this).data('col');
    all_arrows.click(function () {
      table.data("order_by", order_by);
    });

    arrow_up.click(function() {
      table.data("dir", "ASC");
      $("#created-history-table.sortable .sortable__arrow").removeClass('selected');
      $(this).addClass('selected');
      $.ajax({
          type: "POST",
          url: '/table/fetchCompletedTasks',
          data: { offset: table.data('offset'), pagesize: table.data('pagesize'), order_by: table.data("order_by"), dir: table.data("dir") },
          cache: false,
          success: function(html){
              $("table#created-history-table tbody").html(html);
          }
      });
    });
    arrow_down.click(function() {
      table.data("dir", "DESC");
      $("#created-history-table.sortable .sortable__arrow").removeClass('selected');
      $(this).addClass('selected');
      $.ajax({
          type: "POST",
          url: '/table/fetchCompletedTasks',
          data: { offset: table.data('offset'), pagesize: table.data('pagesize'), order_by: table.data("order_by"), dir: table.data("dir") },
          cache: false,
          success: function(html){
              $("table#created-history-table tbody").html(html);
          }
      });
    });

  });
}

function currentCreated() {
  $("#created-tasks-table.sortable th").each(function() {
    var table = $("#created-tasks-table");
    var arrow_up = $(this).find('.sortable__arrow--up');
    var arrow_down = $(this).find('.sortable__arrow--down');
    var all_arrows = $(this).find('.sortable__arrow');
    var order_by = $(this).data('col');
    all_arrows.click(function () {
      table.data("order_by", order_by);
    });

    arrow_up.click(function() {
      table.data("dir", "ASC");
      $("#created-tasks-table.sortable .sortable__arrow").removeClass('selected');
      $(this).addClass('selected');
      $.ajax({
          type: "POST",
          url: '/table/fetchCreatedTasks',
          data: { offset: table.data('offset'), pagesize: table.data('pagesize'), order_by: table.data("order_by"), dir: table.data("dir") },
          cache: false,
          success: function(html){
              $("table#created-tasks-table tbody").html(html);
          }
      });
    });
    arrow_down.click(function() {
      table.data("dir", "DESC");
      $("#created-tasks-table.sortable .sortable__arrow").removeClass('selected');
      $(this).addClass('selected');
      $.ajax({
          type: "POST",
          url: '/table/fetchCreatedTasks',
          data: { offset: table.data('offset'), pagesize: table.data('pagesize'), order_by: table.data("order_by"), dir: table.data("dir") },
          cache: false,
          success: function(html){
              $("table#created-tasks-table tbody").html(html);
          }
      });
    });

  });
}
function biddedCurr() {
  $("#bidded-tasks-table.sortable th").each(function() {
    var table = $("#bidded-tasks-table");
    var arrow_up = $(this).find('.sortable__arrow--up');
    var arrow_down = $(this).find('.sortable__arrow--down');
    var all_arrows = $(this).find('.sortable__arrow');
    var order_by = $(this).data('col');
    all_arrows.click(function () {
      table.data("order_by", order_by);
    });

    arrow_up.click(function() {
      table.data("dir", "ASC");
      $("#bidded-tasks-table.sortable .sortable__arrow").removeClass('selected');
      $(this).addClass('selected');
      $.ajax({
          type: "POST",
          url: '/table/fetchCurrentBiddedTasks',
          data: { offset: table.data('offset'), pagesize: table.data('pagesize'), order_by: table.data("order_by"), dir: table.data("dir") },
          cache: false,
          success: function(html){
              $("table#bidded-tasks-table tbody").html(html);
          }
      });
    });
    arrow_down.click(function() {
      table.data("dir", "DESC");
      $("#bidded-tasks-table.sortable .sortable__arrow").removeClass('selected');
      $(this).addClass('selected');
      $.ajax({
          type: "POST",
          url: '/table/fetchCurrentBiddedTasks',
          data: { offset: table.data('offset'), pagesize: table.data('pagesize'), order_by: table.data("order_by"), dir: table.data("dir") },
          cache: false,
          success: function(html){
              $("table#bidded-tasks-table tbody").html(html);
          }
      });
    });

  });
}

function biddedHist() {
  $("#bidded-history-table.sortable th").each(function() {
    var table = $("#bidded-history-table");
    var arrow_up = $(this).find('.sortable__arrow--up');
    var arrow_down = $(this).find('.sortable__arrow--down');
    var all_arrows = $(this).find('.sortable__arrow');
    var order_by = $(this).data('col');
    all_arrows.click(function () {
      table.data("order_by", order_by);
    });

    arrow_up.click(function() {
      table.data("dir", "ASC");
      $("#bidded-history-table.sortable .sortable__arrow").removeClass('selected');
      $(this).addClass('selected');
      $.ajax({
          type: "POST",
          url: '/table/fetchHistoryBiddedTasks',
          data: { offset: table.data('offset'), pagesize: table.data('pagesize'), order_by: table.data("order_by"), dir: table.data("dir") },
          cache: false,
          success: function(html){
              $("table#bidded-history-table tbody").html(html);
          }
      });
    });
    arrow_down.click(function() {
      table.data("dir", "DESC");
      $("#bidded-history-table.sortable .sortable__arrow").removeClass('selected');
      $(this).addClass('selected');
      $.ajax({
          type: "POST",
          url: '/table/fetchHistoryBiddedTasks',
          data: { offset: table.data('offset'), pagesize: table.data('pagesize'), order_by: table.data("order_by"), dir: table.data("dir") },
          cache: false,
          success: function(html){
              $("table#bidded-history-table tbody").html(html);
          }
      });
    });

  });
}
function initializeSorting() {
  biddedHist();
  biddedCurr();
  completed();
  currentCreated();
}
