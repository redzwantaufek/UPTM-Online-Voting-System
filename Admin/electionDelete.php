<?php
    include '../Database/connect.php';
    session_start();

    // Check if user is logged in
    if (!isset($_SESSION['admin_id'])) {
        // If not, redirect to login page
        header('Location: ../login.php');
        exit();
    }

    // Get the id of the election to delete
    $electionIdToDelete = $_POST['delete_id'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("DELETE FROM election WHERE electionId = ?");
    $stmt->bind_param("i", $electionIdToDelete);

    // Execute the statement
    if ($stmt->execute()) {
        $_SESSION['message'] = "Election deleted successfully";
    } else {
        $_SESSION['message'] = "Error deleting election";
    }

    // Redirect back to the election list page
    header('Location: electionView.php');
?>
