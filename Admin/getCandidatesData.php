<?php
include '../Database/connect.php';

// Query to get the candidates and their vote counts
$sql = "SELECT candidate.candidateName, COUNT(vote.voteId) as votes FROM candidate LEFT JOIN vote ON candidate.candidateId = vote.candidateId GROUP BY candidate.candidateId";
$result = $conn->query($sql);

$candidates = array();
$votes = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        array_push($candidates, $row['candidateName']);
        array_push($votes, $row['votes']);
    }
}

$data = array(
    "candidates" => $candidates,
    "votes" => $votes
);

header('Content-Type: application/json');
echo json_encode($data);

$conn->close();
?>