<section style="margin: 0 1.5em 0 1.5em;">
  <h5 class="page-header">
    Manage All Tasks
  </h5>

  <!-- SEARCH BAR -->
  <div class="input-group">
    <form class="form-group">
      <div class="col-xs-4 col-md-3 admin-search-bar">
        <input id="search-task-creator" class="form-control admin-input" type="text" name="creatorname" placeholder="Creator name"/>
      </div>
      <div class="col-xs-4 col-md-3 admin-search-bar">
        <input id="search-task-doer" class="form-control admin-input" type="text" name="doername" placeholder="Doer name"/>
      </div>
      <div class="col-xs-4 col-md-3 admin-search-bar">
        <input id="search-task-title" class="form-control admin-input" type="text" name="tasktitle" placeholder="Title"/>
      </div>
      <div class="col-xs-4 col-md-3 admin-search-bar">
        <button id="admin-search-submit" class="btn btn-embossed btn-primary">
          SEARCH
        </button>
      </div>
    </form>
  </div>

  <hr />

  <!-- SEARCH results are appended here -->
  <div id="admin-search-results"></div>

  <script>
    /**
     * Handles SEARCH operation for this page for admins to filter out tasks
     *
     * TODO: Incorporate the original Task table made by Derek here since we
     *       need the admin to be able to visit a Task's page to edit it, etc.
     */
    $('#admin-search-submit').click(function(e) {
      e.preventDefault();
      $.ajax({
        type: "POST",
        data : {
          taskCreator: $('#search-task-creator').val(),
          taskDoer: $('#search-task-doer').val(),
          taskTitle: $('#search-task-title').val()
        },
        url: "dashboard/adminSubmitSearch",
        success: function(data) {
          $('#admin-search-results').html(data);
        }
      });
    })
  </script>

</section>
