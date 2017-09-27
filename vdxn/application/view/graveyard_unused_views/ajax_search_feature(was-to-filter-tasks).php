<section style="margin: 0 1.5em 0 1.5em;">
  <h5 class="page-header">
    Manage All Users
  </h5>

  <!-- SEARCH BAR -->
  <div class="input-group">
    <form class="form-group">
      <div class="col-xs-4 col-md-3 admin-search-bar">
        <input id="search-user-name" class="form-control admin-input" type="text" name="username" placeholder="Name"/>
      </div>
      <div class="col-xs-4 col-md-3 admin-search-bar">
        <input id="search-user-email" class="form-control admin-input" type="text" name="useremail" placeholder="Email"/>
      </div>
      <div class="col-xs-4 col-md-3 admin-search-bar">
        <input id="search-user-phone" class="form-control admin-input" type="text" name="userphone" placeholder="Phone no."/>
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
          userName: $('#search-user-name').val(),
          userEmail: $('#search-user-email').val(),
          userPhone: $('#search-user-phone').val()
        },
        url: "dashboard/adminSubmitSearchUser",
        success: function(data) {
          $('#admin-search-results').html(data);
        }
      });
    })
  </script>

</section>
