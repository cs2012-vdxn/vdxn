<div class="container">
    <h1>My Tasks</h1>
    <a href="/tasks/newtask">New</a>
    <div class="tasks__tabs-container">
      <span class="tasks__tab tasks__tab--selected">Created by Me
        <div class="tasks__tab-results">
          <?php include ("created_tasks.php") ?>
            <div class="tasks__tab">History</div>
          <?php include ("created_tasks_history.php") ?>
        </div>
      </span>
      <span class="tasks__tab">Bidded
        <div class="tasks__tab-results">
          <?php include ("created_tasks.php") ?>
            <div class="tasks__tab">History</div>
          <?php include ("created_tasks_history.php") ?>
        </div>
      </span>
    </div>
    <?php
      echo "<script type=\"text/javascript\">
        $('.tasks__tab').click(function(e) {
          $('.tasks__tab').removeClass('tasks__tab--selected');
          $(this).addClass('tasks__tab--selected');
        });
      </script>";
    ?>
</div>
