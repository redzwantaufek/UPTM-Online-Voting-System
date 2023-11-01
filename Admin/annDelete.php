<?php
    include '../Database/connect.php';
    session_start();

    // Check if user is logged in and if the id parameter is set
    if (!isset($_SESSION['admin_id']) || !isset($_POST['delete_id'])) {
        // If not, redirect to login page
        header('Location: ../login.php');
        exit();
    }

    // Get the id of the announcement to delete
    $annIdToDelete = $_POST['delete_id'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("DELETE FROM announcement WHERE annId = ?");
    $stmt->bind_param("i", $annIdToDelete);

    // Execute the statement
    if ($stmt->execute()) {
        $_SESSION['message'] = "Announcement deleted successfully";
    } else {
        $_SESSION['message'] = "Error deleting announcement";
    }

    // Redirect back to the election view page
    header('Location: electionView.php');
?>