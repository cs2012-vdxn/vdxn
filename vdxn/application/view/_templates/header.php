<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CS2102 VDXN</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- JS -->
    <!-- please note: The JavaScript files are loaded in the footer to speed up page construction -->
    <!-- See more here: http://stackoverflow.com/q/2105327/1114320 -->

    <!-- CSS -->
    <link href="<?php echo URL; ?>css/style.css" rel="stylesheet">
    <link href="<?php echo URL; ?>flat-ui-bootstrap-template/dist/css/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo URL; ?>flat-ui-bootstrap-template/dist/css/flat-ui.css" rel="stylesheet">
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
        <li>
          <a href="/dashboard">Dashboard</a>
        </li>
        <li>
          <a href="/tasks">Tasks</a>
        </li>
        <li>
          <a href="/mytasks">MyTasks</a>
        </li>
        <li>
          <a href="/settings">Settings</a>
        </li>
        <li>
          <a href="/login">Login</a>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
</nav><!-- /navbar -->
