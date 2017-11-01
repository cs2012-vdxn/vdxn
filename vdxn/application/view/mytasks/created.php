<div class="container">
    <h1>My Tasks</h1>
    <a class='btn btn-embossed btn-lg btn-primary' href='/tasks/newtask'>
      <span class='fui-new'></span> Create a New Task
    </a>
    <br />
    <hr />
    <br />

    <div class="tasks__tabs-container">
      <span class="tasks__tab tasks__tab--selected">Created by Me
      </span>
      <span class="tasks__tab"><a href="/mytasks/bidded">Bidded</a></span>
    </div>
    <div class="tasks__tab-results">
      <div class="tasks__tab" style="font-size: 2em; font-weight: bold;">
        Ongoing
      </div>
      <?php include ("created_tasks.php") ?>
      <div class="tasks__tab" style="font-size: 2em; font-weight: bold;">
        History
      </div>
      <?php include ("created_tasks_history.php") ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.navbar-nav > li').removeClass('active');
        $('.navbar-nav > li.header-mytasks').addClass('active');
      });
</script>
