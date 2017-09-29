<div class="container">
    <h1>My Tasks</h1>
    <a href="/tasks/newtask">New</a>
    <div class="tasks__tabs-container">
      <span class="tasks__tab"><a href="/mytasks/getCreatedTasks">Created by Me</a></span>
      <span class="tasks__tab tasks__tab--selected">Bidded</span>
    </div>
    <div class="tasks__tab-results">
      <?php include ("bidded_tasks.php") ?>
        <div class="tasks__tab">History</div>
      <?php include ("bidded_tasks_history.php") ?>
    </div>
</div>
