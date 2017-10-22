<div class="container">
  <p>Login</p>
  <form action="<?php echo URL; ?>login/submitForm" method="POST">
  Name: <input type="text" name="username"><br>
  Password: <input type="password" name="password"><br>
  <input type="submit">
  <p>Create an account <a href="<?php echo URL;?>signup">here</a>.</p>
</form>
</div>
