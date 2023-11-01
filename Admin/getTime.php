<?php
    include '../Database/connect.php';
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $sql = "SELECT start, end, date FROM election ORDER BY electionId DESC LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $start = new DateTime($row['start']);
        $end = new DateTime($row['end']);
        $date = new DateTime($row['date']);
        $now = new DateTime();
        if ($now > $start && $now < $end) {
            $remaining = $now->diff($end);
            echo 'Time Remaining: '.$remaining->format('%H:%I:%S');
        } else if ($now < $start) {
            $remaining = $now->diff($start);
            echo 'Time until Election Start: '.$remaining->format('%H:%I:%S');
        } else {
            echo 'Election has ended';
        }
    } else {
        echo 'No information available';
    }
?>