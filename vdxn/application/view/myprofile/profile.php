<div class="container">
  <div class="col-md-3">
    <img src="<?php echo $pictureLink ?>" height=150 width=150 style="margin-bottom: 1em;"/>
  </div>
  <div class="col-md-9">
    <h4><?php echo $username?></h4>

    <br/><small><b>CONTACT INFORMATION</b></small><br/>
    <table class="table user-contact-information-table">
      <tr>
        <td>Email:</td>
        <td><?php echo $email ?></td>
      </tr>
      <tr>
        <td>Phone:</td>
        <td><?php echo $contact ?></td>
      </tr>
      <tr>
        <td>Rating:</td>
        <td><?php echo $rating ?> / 5.0</td>
      </tr>
    </table>
    <br/>

    <p><b>EARNINGS THIS MONTH: $<?php echo $earnings_this_month ?></b><br/><br/></p>

  </div>
</div>
