<?php
include '../Database/connect.php';

// Query to get the total number of students and the number who have voted
$sql = "SELECT COUNT(*) as totalStudents, SUM(votingHistory) as totalVotes FROM student";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $data = array(
        "voted" => $row['totalVotes'],
        "notVoted" => $row['totalStudents'] - $row['totalVotes']
    );
} else {
    $data = array(
        "voted" => 1,
        "notVoted" => 0
    );
}

header('Content-Type: application/json');
echo json_encode($data);

$conn->close();
?>