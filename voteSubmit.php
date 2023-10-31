<?php
include 'Database/connect.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['student_id'])) {
    // If not, redirect to login page
    header('Location: login.php');
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the selected candidates
    $selectedCandidates = $_POST['candidate'];

    // Get the current election ID
    $sql = "SELECT electionId FROM election ORDER BY electionId DESC LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $electionId = $row['electionId'];
    } else {
        echo "No election information found.";
        exit();
    }

    // Insert the votes into the vote table
    foreach ($selectedCandidates as $candidateId) {
        $sql = "INSERT INTO vote (studentId, candidateId, electionId) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii", $_SESSION['student_id'], $candidateId, $electionId);
        $stmt->execute();
    }

    // Update voteHistory in student table
    $sql = "UPDATE student SET votingHistory = 1 WHERE studentId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_SESSION['student_id']);
    $stmt->execute();

    // Redirect to a success page
    header('Location: voteSuccess.php');
    exit();
}
?>