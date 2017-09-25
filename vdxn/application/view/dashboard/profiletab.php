<div class="col-md-3">
  <?php
    echo "[PROFILE PIC]";
  ?>
</div>
<div class="col-md-9">
  <?php
    echo "<h4>" . $name . " " . $last_name . "</h4>";
  ?>
  <br/><small><b>CONTACT INFORMATION</b></small><br/>
  <table class="table user-contact-information-table">
    <tr>
      <td>Email:</td>
      <td><?php echo $email ?></td>
    </tr>
    <tr>
      <td>Phone:</td>
      <td><?php echo $phone ?></td>
    </tr>
    <tr>
      <td>Rating:</td>
      <td><?php echo $rating ?> / 5.0</td>
    </tr>
  </table>
  <br/>

  <p><b>EARNINGS THIS MONTH: $<?php echo $earnings_this_month ?></b><br/><br/></p>

  <button class="btn btn-embossed btn-warning">
    Change Password
  </button>
</div>
