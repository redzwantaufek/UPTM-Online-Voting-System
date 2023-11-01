<?php
include '../Database/connect.php';

if (isset($_GET['status']) && isset($_GET['id'])) {
    $status = $_GET['status'];
    $id = $_GET['id'];

    $sql = "UPDATE apply SET status = ? WHERE applyId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        if ($status == 'Accept') {
            // Get the application details
            $sql = "SELECT * FROM apply WHERE applyId = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $application = $result->fetch_assoc();

            // Get the maximum candNo from the candidate table
            $sql = "SELECT MAX(candNo) as maxCandNo FROM candidate";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $maxCandNo = $row['maxCandNo'];

            // If maxCandNo is NULL, set it to 0
            if ($maxCandNo === NULL) {
                $maxCandNo = 0;
            }

            // Calculate the candNo for the new candidate
            $candNo = $maxCandNo + 1;

            // Insert the application details into the candidate table
            $sql = "INSERT INTO candidate (candNo, studentId, candidateName, candidatePic, faculty, courseName, email, manifesto, links, contact) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iissssssss", $candNo, $application['studentId'], $application['name'], $application['applyPic'], $application['faculty'], $application['course'],  $application['email'], $application['manifesto'], $application['link'], $application['contact'] );
            $stmt->execute();
        }
        echo 'success';
    } else {
        echo 'error';
    }
}

// Close the database connection
$conn->close();
?>