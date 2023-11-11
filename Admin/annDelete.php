<?php
    include '../Database/connect.php';
    session_start();

    // Check if user is logged in
    if (!isset($_SESSION['admin_id'])) {
        // If not, redirect to login page
        header('Location: ../login.php');
        exit();
    }

    // Prepare the SQL statement to delete all rows in the table
    $stmt = $conn->prepare("DELETE FROM announcement");

    // Execute the statement
    if ($stmt->execute()) {
        $_SESSION['message'] = "All announcements deleted successfully";
    } else {
        $_SESSION['message'] = "Error deleting announcements";
    }

    // Redirect back to the election view page
    header('Location: electionView.php');
?>