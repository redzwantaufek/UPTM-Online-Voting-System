<?php
    include '../Database/connect.php';
    session_start();

    // Check if user is logged in and if the id parameter is set
    if (!isset($_SESSION['admin_id']) || !isset($_GET['id'])) {
        // If not, redirect to login page
        header('Location: ../login.php');
        exit();
    }

    // Get the id of the candidate to delete
    $candidateIdToDelete = $_GET['id'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("DELETE FROM candidate WHERE candidateId = ?");
    $stmt->bind_param("i", $candidateIdToDelete);

    // Execute the statement
    if ($stmt->execute()) {
        $_SESSION['message'] = "Candidate deleted successfully";
    } else {
        $_SESSION['message'] = "Error deleting candidate";
    }

    // Redirect back to the candidate list page
    header('Location: candidateView.php');
?>

