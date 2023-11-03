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

    // Check if a new profile picture has been uploaded
    if (isset($_FILES['pic']) && $_FILES['pic']['error'] === UPLOAD_ERR_OK) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $_FILES["pic"]["tmp_name"]);
        finfo_close($finfo);

        // Check if the file is a jpg, jpeg, or png
        if (!in_array($mime, ["image/jpeg", "image/png"])) {
            echo "Sorry, only JPG, JPEG, and PNG files are allowed.";
            echo "Uploaded file type: " . $mime; // Debugging information
            exit();
        }

        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["pic"]["name"]);

        if (!move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file)) {
            echo "Sorry, there was an error uploading your file.";
            exit();
        }
        $pic = $target_file;

        // SQL query to update the admin details and profile picture
        $sql = "UPDATE admin SET adminName = ?, email = ?, contact = ?, position = ?, pic = ? WHERE adminID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $adminName, $email, $contact, $position, $pic, $adminIdToEdit);
    } else {
        // SQL query to update the admin details without changing the profile picture
        $sql = "UPDATE admin SET adminName = ?, email = ?, contact = ?, position = ? WHERE adminID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $adminName, $email, $contact, $position, $adminIdToEdit);
    }

    if ($stmt->execute()) { // Execute the update query
        $_SESSION['message'] = "Admin details updated successfully!";
    } else {
        $_SESSION['message'] = "Error updating admin details.";
    }
}

// Close the database connection
$conn->close();

//header('Location: adminList.php');
exit();
?>