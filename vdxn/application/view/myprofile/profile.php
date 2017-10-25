<div class="container">
  <div class="col-md-3">
    <img src="<?php echo $pictureLink ?>" height=150 width=150 style="margin-bottom: 1em;"/>
  </div>
  <div class="col-md-9">
    <h4><?php echo $user->{'username'}?></h4>

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
  </div>
</div>
