<?php
    include '../Database/connect.php';
    session_start();

    // Check if user is logged in and if the id parameter is set
    if (!isset($_SESSION['admin_id']) || !isset($_GET['id'])) {
        // If not, redirect to login page
        header('Location: ../login.php');
        exit();
    }

    // Get the id of the admin to delete
    $adminIdToDelete = $_GET['id'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("DELETE FROM admin WHERE adminID = ?");
    $stmt->bind_param("i", $adminIdToDelete);

    // Execute the statement
    if ($stmt->execute()) {
        $_SESSION['message'] = "Admin deleted successfully";
    } else {
        $_SESSION['message'] = "Error deleting admin";
    }

    // Redirect back to the admin list page
    header('Location: adminList.php');
?>