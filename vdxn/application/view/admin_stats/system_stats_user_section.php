<!-- STATS FOR USERS SECTION -->
<h5 class="page-header">
  Users
</h5>
<div class="row">
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        User Sign-ups 👶
      </div>
      <div class="panel-body">
        <p>
          Between these dates:
          <br/>
          No. of sign-ups: <?php echo $num_users_created; ?>
        </p>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        Users who bidded for at least 1 task 👩 👱
      </div>
      <div class="panel-body">
        <p>
          No. of active doers: <?php echo $num_users_bidded_at_least_once; ?>
        </p>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        Users who never bidded 😣
      </div>
      <div class="panel-body">
        <p><b>
          Admins, please contact these users to see how you can help them
          to stay engaged in bidding!
        </b></p>

        <?php
        echo '<table class="table table-bordered table-hover table-condensed">';
        echo '<thead><tr>
              <th>Username</th>
              <th>Name</th>
              <th>Email</th>
              <th>Contact no.</th>
              </tr></thead>';
        foreach($arr_users_never_bidded as $user_no_bid) {
          echo '<tr>';
          echo '<td><a href="/myprofile?username='.$user_no_bid->username.'">'.$user_no_bid->username.'</a></td>';
          echo '<td>'.$user_no_bid->first_name.' '.$user_no_bid->last_name.'</td>';
          echo '<td>'.$user_no_bid->email.'</td>';
          echo '<td>'.$user_no_bid->contact.'</td>';
          echo '</tr>';
        }
        echo '</table>';
        ?>
      </div>
    </div>
  </div>
</div>
