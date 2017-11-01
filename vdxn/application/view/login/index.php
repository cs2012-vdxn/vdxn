<div class="container">
  <div class="col-lg-6 col-md-10" style="background-color: #1abc9c; min-height: 100%; padding: 50px;">
    <h1 style="color: #FFFFFF">Log in</h1>

    <div class="login-form">
      <div class="form-group">
        <form action="<?php echo URL; ?>login/submitForm" method="POST">
          <div class="form-group">
            <input type="text" name="username" class="form-control login-field" value="" placeholder="Enter your name" id="login-name" autocomplete="off" style="background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;">
            <label class="login-field-icon fui-user" for="login-name"></label>
          </div>

          <div class="form-group">
            <input type="password" name="password" class="form-control login-field" value="" placeholder="Password" id="login-pass" autocomplete="off" style="background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;">
            <label class="login-field-icon fui-lock" for="login-pass"></label>
          </div>

          <input class="btn btn-primary btn-lg btn-block" type="submit" value="Log in" />

          <p style="color: #000000; text-align: center;">
            <br />
            Create an account <a href="<?php echo URL;?>signup">here</a>.
          </p>
        </form>
      </div>
    </div>
  </div>
</div>
