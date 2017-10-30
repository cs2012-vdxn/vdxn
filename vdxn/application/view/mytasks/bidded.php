<div class="container">
    <h1>My Tasks</h1>
    <a href="/tasks/newtask">New</a>
    <div class="tasks__tabs-container">
      <span class="tasks__tab"><a href="/mytasks/created">Created by Me</a></span>
      <span class="tasks__tab tasks__tab--selected">Bidded</span>
    </div>
    <div class="tasks__tab-results">
      <div class="tasks__tab">Ongoing</div>
      <?php include ("bidded_tasks.php") ?>
        <div class="tasks__tab">History</div>
      <?php include ("bidded_tasks_history.php") ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.navbar-nav > li').removeClass('active');
        $('.navbar-nav > li.header-mytasks').addClass('active');
      });
</script>
