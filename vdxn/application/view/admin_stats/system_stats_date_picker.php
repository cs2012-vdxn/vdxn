<!-- ADMIN STATS HEADER -->

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>
  $( function() {
    $( "#fromDatedp" ).datepicker({ dateFormat: 'dd-mm-yy' });
    $( "#toDatedp" ).datepicker({ dateFormat: 'dd-mm-yy' });
  } );
</script>

<div class="page-header">
  <h1>Admin Statistics</h1>
    <form method="get" action="/AdminStats">
      <input type="text"
        name="fromDate"
        value="<?php echo $currentFromDate; ?>"
        id="fromDatedp">
      </input>
      to
      <input type="text"
        name="toDate"
        value="<?php echo $currentToDate; ?>"
        id="toDatedp">
      </input>
      <input type="submit" Value="Go"/>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.navbar-nav > li').removeClass('active');
        $('.navbar-nav > li.header-stats').addClass('active');
      });
</script>
