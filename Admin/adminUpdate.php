<?php
include '../Database/connect.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adminIdToEdit = $_POST['id'];
    $adminName = $_POST['adminName'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $position = $_POST['position'];

    // SQL query to update the admin details
    $sql = "UPDATE admin SET adminName = ?, email = ?, contact = ?, position = ? WHERE adminID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $adminName, $email, $contact, $position, $adminIdToEdit);
    $stmt->execute(); // Execute the update query
}

if ($stmt->execute()) { // Execute the update query
    $_SESSION['message'] = "Admin details updated successfully!";
} else {
    $_SESSION['message'] = "Error updating admin details.";
}

// Close the database connection
$conn->close();

header('Location: adminList.php');
exit();
?>