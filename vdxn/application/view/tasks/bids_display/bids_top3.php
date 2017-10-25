<h4>Top Bidders</h4>
<?php
  echo '<table class="table table-bordered table-hover table-condensed">';
  echo '<thead><tr>
          <th>Rank</th>
          <th>Username</th>
          <th>Amount</th>
          <th>Comments</th>
          <th>Created on</th>
        </tr></thead>';
  foreach($bids_leaderboard as $i => $bid) {
    echo '<tr>';
    echo '<td>#' . ($i + 1) . '</td>';
    echo '<td><a href="/myprofile?username=' . $bid->bidder_username . '">'.$bid->bidder_username.'</a></td>';
    echo '<td>' . $bid->amount . '</td>';
    echo '<td>' . $bid->details . '</td>';
    echo '<td>' . $bid->created_at . '</td>';
    echo '</tr>';
  }
  echo '</table>';
?>
