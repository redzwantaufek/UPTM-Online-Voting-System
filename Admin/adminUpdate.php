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

    // Check if a new profile picture has been uploaded
    if (isset($_FILES['pic']) && $_FILES['pic']['error'] === UPLOAD_ERR_OK) {
        // Convert image to blob
        $pic = addslashes(file_get_contents($_FILES['pic']['tmp_name']));
    } else {
        // If no file was uploaded, use the existing image
        $sql = "SELECT pic FROM admin WHERE adminID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $_SESSION['admin_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $admin = $result->fetch_assoc();
        $pic = $admin['pic'];
    }

    // Prepare an SQL statement for updating the admin profile
    $sql = "UPDATE admin SET adminName = ?, email = ?, contact = ?, position = ?, pic = ? WHERE adminID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssbi", $adminName, $email, $contact, $position, $pic, $_SESSION['admin_id']);
    
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

header('Location: adminProfiles.php');
exit();
?>