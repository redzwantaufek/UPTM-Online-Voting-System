<?php
    include '../Database/connect.php';
    session_start();

    // Check if user is logged in and if the id parameter is set
    if (!isset($_SESSION['admin_id']) || !isset($_GET['id'])) {
        // If not, redirect to login page
        header('Location: ../login.php');
        exit();
    }

    // Get the id of the student to delete
    $studentIdToDelete = $_GET['id'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("DELETE FROM student WHERE studentId = ?");
    $stmt->bind_param("i", $studentIdToDelete);

    // Execute the statement
    if ($stmt->execute()) {
        $_SESSION['message'] = "Student deleted successfully";
    } else {
        $_SESSION['message'] = "Error deleting student";
    }

    // Redirect back to the student list page
    header('Location: studentView.php');
?>
