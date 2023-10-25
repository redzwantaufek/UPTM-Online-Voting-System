<?php
include '../Database/connect.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['admin_id'])) {
    // If not, redirect to login page
    header('Location: login.php');
    exit();
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adminName = $_POST['adminName'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $position = $_POST['position'];
    
    // Prepare an SQL statement for updating the admin profile
    $sql = "UPDATE admin SET adminName = ?, email = ?, contact = ?, position = ? WHERE adminID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $adminName, $email, $contact, $position, $_SESSION['admin_id']);
    
    // Execute the SQL statement
    if ($stmt->execute()) {
        echo "Profile updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    // If form is not submitted, redirect to edit page
    header('Location: adminEdit.php');
    exit();
}

// Close the database connection
$conn->close();
?>