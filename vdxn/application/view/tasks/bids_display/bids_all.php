<h4>All Bidders</h4>
<p>
  All bids that belong to the task are listed here.
  Depending on the get parameters, retrieve results sorted differently.
</p>
<br/>
<div id="controls">
  Sort by :
  Bid Amount
  |
  Name
  |
Rating
</div>
<?php
  echo '<table class="table table-bordered table-hover table-condensed">';
  echo '<thead><tr>
          <th>Bidder</th>
          <th>Amount</th>
          <th>Comments</th>
          <th>Created at</th>
          <th></th>
        </tr></thead>';
  foreach($bids as $bid) {
    echo '<tr>';
    echo '<td>' . $bid->bidder_username . '</td>';
    echo '<td>' . $bid->amount . '</td>';
    echo '<td>' . $bid->details . '</td>';
    echo '<td>' . $bid->created_at . '</td>';
    echo '<td><a href="#">Confirm</a></td>';
    echo '</tr>';
  }
  echo '</table>';
?>
