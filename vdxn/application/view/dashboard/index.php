<div class="container">
  <nav class="navbar navbar-inverse" role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
      </button>
      <a class="navbar-brand" href="#">My Dashboard</a>
    </div>
    <div class="collapse navbar-collapse" id="navbar-collapse-01">

      <!-- Toggles tabs using query params when user clicks on each tab button -->
      <ul class="nav navbar-nav">
        <li
          <?php
            if (isset($_GET['tab'])) {
              if ($_GET['tab'] == 'Profile') {
                echo 'class="active"';
              }
            } else {
              echo 'class="active"';
            }
          ?>
        >
            <a href="/dashboard?tab=Profile">Profile</a>
        </li>
        <li <?php if (isset($_GET['tab']) && $_GET['tab'] == 'Tasks') echo 'class="active"' ?>>
            <a href="/dashboard?tab=Tasks">Tasks</a>
        </li>
        <li <?php if (isset($_GET['tab']) && $_GET['tab'] == 'Stats') echo 'class="active"' ?>>
            <a href="/dashboard?tab=Stats">Stats</a>
        </li>
      </ul><!-- / .nav .navbar-nav containing list of tabs -->

    </div><!-- /.navbar-collapse -->
  </nav><!-- /navbar -->

  <?php
    /**
     * To render a view based on the clicked tab.
     */
    $selected_tab = isset($_GET['tab']) ? $_GET['tab'] : null;

    if ($selected_tab !== null) {
      if ($selected_tab == 'Profile') {
        include 'profiletab.php';
      } else if ($selected_tab == 'Tasks') {
        include 'taskstab.php';
      } else if ($selected_tab == 'Stats') {
        include 'statstab.php';
      } else {
        // By default
        include 'profiletab.php';
      }
    } else {
      include 'profiletab.php';
    }
  ?>
</div>
