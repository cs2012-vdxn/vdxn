<div class="container">
    <h1>Settings</h1>
    <p>User settings </p>
    <h3>Change Password</h3>
    <form action="settings/change_password" method="post">
        <label>Old Password</label><br/>
        <input type="password" name="password_old"/><br/>
        <label>New Password</label><br/>
        <input type="password" name="password_new"/><br/>
        <label>New Password (again)</label><br/>
        <input type="password" name="password_new_confirm"/><br/><br/>
        <input type="submit" value="Change Password"/>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.navbar-nav > li').removeClass('active');
        $('.navbar-nav > li.header-settings').addClass('active');
      });
</script>
