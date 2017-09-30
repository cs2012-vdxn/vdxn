<?php
// Output HTML formats
global $test_db;

$test_db = new mysqli();
$test_db->connect('127.0.0.1', 'root', '12345678', 'mini');
$test_db->set_charset("utf8");

//	Check Connection
if ($test_db->connect_errno) {
    printf("Connect failed: %s\n", $test_db->connect_error);
    exit();
}

$html = '<tr><td>Title</td><td>Description</td><td>Create time</td>
                            <td>Updated time</td><td>Expiry</td><td>Event Date</td>
                            <td>Min Bid</td><td>Max Bid</td><td>Tasker</td>
                        </tr>';

// Get the Search

$search_string = preg_replace("/[^A-Za-z0-9]/", " ", $_POST['query']);
$search_string = $test_db->real_escape_string($search_string);

// Check if length is more than 1 character
if (strlen($search_string) >= 1 && $search_string !== ' ') {
    // Query
    $query = 'SELECT * FROM Task WHERE title LIKE "%'.$search_string.'%"';

    // Do the search
    $result = $test_db->query($query);
    while($results = $result->fetch_array()) {
        $result_array[] = $results;
    }

    // Check for results
    if (isset($result_array)) {
        foreach ($result_array as $result) {
            // Output strings and highlight the matches
            $d_title = preg_replace("/" . $search_string . "/i", "<b>" . $search_string . "</b>", $result['title']);
            $d_description = $result['description'];
            $d_createTime = $result['created_at'];
            $d_updateTime = $result['updated_at'];
            $d_expiry = $result['end_at'];
            $d_eventDate = $result['start_at'];
            $d_minBid = $result['min_bid'];
            $d_maxBid = $result['max_bid'];
            $d_tasker = $result['assignee_username'];
            // Replace the items into above HTML
            $o = str_replace('Title', $d_title, $html);
            $o = str_replace('Description', $d_description, $o);
            $o = str_replace('Create time', $d_createTime, $o);
            $o = str_replace('Updated time', $d_updateTime, $o);
            $o = str_replace('Expiry', $d_expiry, $o);
            $o = str_replace('Event Date', $d_eventDate, $o);
            $o = str_replace('Min Bid', $d_minBid, $o);
            $o = str_replace('Max Bid', $d_maxBid, $o);
            $o = str_replace('Tasker', $d_tasker, $o);
            // Output it
            echo($o);

        }
    } else {
            // Replace for no results
            $o = str_replace('Title', '<span class="label label-danger">No Tasks Found</span>', $html);
            $o = str_replace('Description', '', $o);
            $o = str_replace('Create time', '', $o);
            $o = str_replace('Updated time', '', $o);
            $o = str_replace('Expiry', '', $o);
            $o = str_replace('Event Date', '', $o);
            $o = str_replace('Min Bid', '', $o);
            $o = str_replace('Max Bid', '', $o);
            $o = str_replace('Tasker', '', $o);
            // Output
            echo($o);
        }
    }

else {
    $query = 'SELECT * FROM Task';

// Do the search
    $result = $test_db->query($query);
    while ($results = $result->fetch_array()) {
        $result_array[] = $results;
    }

// Check for results
    foreach ($result_array as $result) {
        // Output strings and highlight the matches
        $d_title =  $result['title'];
        $d_description = $result['description'];
        $d_createTime = $result['created_at'];
        $d_updateTime = $result['updated_at'];
        $d_expiry = $result['end_at'];
        $d_eventDate = $result['start_at'];
        $d_minBid = $result['min_bid'];
        $d_maxBid = $result['max_bid'];
        $d_tasker = $result['assignee_username'];
        // Replace the items into above HTML
        $o = str_replace('Title', $d_title, $html);
        $o = str_replace('Description', $d_description, $o);
        $o = str_replace('Create time', $d_createTime, $o);
        $o = str_replace('Updated time', $d_updateTime, $o);
        $o = str_replace('Expiry', $d_expiry, $o);
        $o = str_replace('Event Date', $d_eventDate, $o);
        $o = str_replace('Min Bid', $d_minBid, $o);
        $o = str_replace('Max Bid', $d_maxBid, $o);
        $o = str_replace('Tasker', $d_tasker, $o);
        // Output it
        echo($o);
    }
}
?>
