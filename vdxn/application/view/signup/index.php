<div class="container">
  <p>Sign Up</p>
  <form action="<?php echo URL; ?>signup/submitForm" method="POST">
    Username: <input type="text" name="username"><br>
    Email: <input type="text" name="email"><br>

    First Name: <input type="text" name="firstName"><br>
    Last Name: <input type="text" name="lastName"><br>

    Contact Number: <input type="text" name="contactNumber"><br>

    Password: <input type="password" name="password"><br>
    Confirm Password: <input type="password" name="password2"><br>
    <input type="submit" value="Create Account">
</form>
</div>
