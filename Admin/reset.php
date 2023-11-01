<?php
    session_start();
    include '../Database/connect.php';

    if(isset($_POST['reset'])) {
        // Delete all rows from the 'apply' table
        $sql = "DELETE FROM apply";
        $conn->query($sql);

        // Set 'votingHistory' and 'apply' to 0 for all rows in the 'student' table
        $sql = "UPDATE student SET votingHistory = 0, apply = 0";
        $conn->query($sql);

        // Delete all rows from the 'vote' table
        $sql = "DELETE FROM vote";
        $conn->query($sql);

        // Delete all rows from the 'candidate' table
        $sql = "DELETE FROM candidate";
        $conn->query($sql);

        // Delete all rows from the 'election' table
        $sql = "DELETE FROM election";
        $conn->query($sql);

        // Delete all rows from the 'announcement' table
        $sql = "DELETE FROM announcement";
        $conn->query($sql);
        
        // Set a session variable to store the success message
        $_SESSION['reset_success'] = "The system has been successfully reset.";

        // Redirect back to settings page
        header('Location: settings.php');
    }

    $conn->close();
?>