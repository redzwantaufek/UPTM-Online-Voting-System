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
    $studentIdToEdit = $_POST['id'];
    $studentName = $_POST['studentName'];
    $studentEmail = $_POST['email'];
    $studentContact = $_POST['contact'];
    $course = $_POST['course'];
    $faculty = $_POST['faculty'];

    // Check if a new profile picture has been uploaded
    if (isset($_FILES['pic']) && $_FILES['pic']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["pic"]["name"]);

        if (!move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file)) {
            echo "Sorry, there was an error uploading your file.";
            exit();
        }
        $pic = $target_file;

        // SQL query to update the student details and profile picture
        $sql = "UPDATE student SET studentName = ?, email = ?, contact = ?, course = ?, faculty = ?, studentPic = ? WHERE studentId = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $studentName, $studentEmail, $studentContact, $course, $faculty, $pic, $studentIdToEdit);
    } else {
        // SQL query to update the student details without changing the profile picture
        $sql = "UPDATE student SET studentName = ?, email = ?, contact = ?, course = ?, faculty = ? WHERE studentId = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $studentName, $studentEmail, $studentContact, $course, $faculty, $studentIdToEdit);
    }

    if ($stmt->execute()) { // Execute the update query
        $_SESSION['message'] = "Student details updated successfully!";
    } else {
        $_SESSION['message'] = "Error updating student details.";
    }
}

// Close the database connection
$conn->close();

header('Location: studentView.php');
exit();
?>