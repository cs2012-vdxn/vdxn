<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CS2102 VDXN</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link href="<?php echo URL; ?>css/style.css" rel="stylesheet">
    <link href="<?php echo URL; ?>flat-ui-bootstrap-template/dist/css/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo URL; ?>flat-ui-bootstrap-template/dist/css/flat-ui.css" rel="stylesheet">

    <!-- JS -->
    <!-- We depend on jQuery for interactions with our app, so declare up top here -->
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>

  <nav class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
        <span class="sr-only">Toggle navigation</span>
      </button>
      <a class="navbar-brand" href="#">VDXN</a>

    </div>
    <div class="collapse navbar-collapse" id="navbar-collapse-01">
      <ul class="nav navbar-nav">
        <li class="active">
          <a href="/">Home</a>
        </li>
        <?php
          if (isset($_SESSION['user'])) {
            echo "<li><a href='/myprofile'>My Profile</a></li>";
          }
        ?>
        <li>
          <a href="/tasks">Tasks</a>
        </li>
        <?php
          if (isset($_SESSION['user'])) {
            echo "<li><a href='/mytasks'>MyTasks</a></li>";
          }
        ?>
        <?php
          if (isset($_SESSION['user'])) {
            if ($_SESSION['user']->{'user_type'} == "Admin") {
              echo "<li><a href='/adminstats'>System Stats</a></li>";
            }
          }
        ?>
        <?php
          if (isset($_SESSION['user'])) {
            echo "<li><a href='/settings'>Settings</a></li>";
          }
        ?>
        <li>
          <?php
            if (isset($_SESSION['user'])) {
              echo "<a href='/logout'>Logout</a>";
            } else {
              echo "<a href='/login'>Login</a>";
            }
          ?>
        </li>
        <li>
          <?php
            if (isset($_SESSION['user'])) {
              echo "<a href='/profile'>Welcome, ".$_SESSION['user']->{'username'}."</a>";
            }
          ?>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
</nav><!-- /navbar -->
