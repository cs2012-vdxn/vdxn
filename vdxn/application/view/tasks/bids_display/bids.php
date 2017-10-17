<div class="container">
    <h3>Bids for Task(<?php echo $tid;?>)</h3>
    <p>
      All bids that belong to the task are listed here.
      Depending on the get parameters, retrieve results sorted differently
    </p>
    <div id="controls">
      Sort by :
      Bid Amount
      |
      Name
      |
    Rating
    </div>

    <?php
      echo '<table>';
      echo '<tr><th>Amount</th><th>Created at</th><th>Bidder</th><th>Confirm</th></tr>';
      foreach($bids as $bid) {
        echo '<tr>';
        echo '<td>';
        echo $bid->{'amount'};
        echo '</td>';
        echo '<td>';
        echo $bid->{'updated_at'};
        echo '</td>';
        echo '<td>';
        echo $bid->{'bidder_id'};
        echo '</td>';
        echo '<td>';
        echo '<a href="#">Confirm</a>';
        echo '</td>';
        echo '</tr>';
      }
      echo '</table>';
    ?>
</div>
