<div class="container">
  <div class="col-md-3">
    <img src="<?php echo $pictureLink ?>" height=150 width=150 style="margin-bottom: 1em;"/><br>
  </div>
  <div class="col-md-9">
    <p><h4>
      <?php echo $user->{'first_name'} . ' ' .
                 $user->{'last_name'} . ' (' .
                 $user->{'username'} . ')'
      ?>
    </h4>
    </p>
    <br/><small><b>PROFILE</b></small><br/>
    <table class="table user-contact-information-table">
      <tr>
        <td>Created on:</td>
        <td><?php echo $user->{'created_at'} ?></td>
      </tr>
      <tr>
        <td>Type:</td>
        <td><?php echo $user->{'user_type'} ?></td>
      </tr>
    </table>

    <br/><small><b>CONTACT INFORMATION</b></small><br/>
    <table class="table user-contact-information-table">
      <tr>
        <td>Email:</td>
        <td><?php echo $user->{'email'} ?></td>
      </tr>
      <tr>
        <td>Phone:</td>
        <td><?php echo $user->{'contact'} ?></td>
      </tr>
      <tr>
        <td>Rating:</td>
        <td><?php echo $user->{'rating'} ?> / 5.0</td>
      </tr>
    </table>

    <a href="/MyProfile/edit" class="button">Edit</a>
  </div>
</div>
