<?php
include '../Database/connect.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $candidateIdToEdit = $_POST['id'];
    $candidateName = $_POST['candidateName'];
    $candNo = $_POST['candNo'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $faculty = $_POST['faculty'];
    $courseName = $_POST['courseName'];
    $manifesto = $_POST['manifesto'];
    $links = $_POST['links'];

    // Check if a new profile picture has been uploaded
    if (isset($_FILES['pic']) && $_FILES['pic']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["pic"]["name"]);

        if (!move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file)) {
            echo "Sorry, there was an error uploading your file.";
            exit();
        }
        $pic = $target_file;
    }

    // Check if a new poster has been uploaded
    if (isset($_FILES['poster']) && $_FILES['poster']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["poster"]["name"]);

        if (!move_uploaded_file($_FILES["poster"]["tmp_name"], $target_file)) {
            echo "Sorry, there was an error uploading your file.";
            exit();
        }
        $poster = $target_file;
    }

    // SQL query to update the candidate details, candidate no, profile picture and poster
    $sql = "UPDATE candidate SET candidateName = ?, candNo = ?, email = ?, contact = ?, faculty = ?, courseName = ?, manifesto = ?, links = ? WHERE candidateId = ?";
    $params = array($candidateName, $candNo, $email, $contact, $faculty, $courseName, $manifesto, $links, $candidateIdToEdit);

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(str_repeat('s', count($params)), ...$params);

    if (!$stmt->execute()) { // Execute the update query
        $_SESSION['message'] = "Error updating candidate details.";
    }

    if (isset($pic)) {
        $sql = "UPDATE candidate SET candidatePic = ? WHERE candidateId = ?";
        $params = array($pic, $candidateIdToEdit);

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', ...$params);

        if (!$stmt->execute()) { // Execute the update query
            $_SESSION['message'] = "Error updating candidate picture.";
        }
    }

    if (isset($poster)) {
        $sql = "UPDATE candidate SET poster = ? WHERE candidateId = ?";
        $params = array($poster, $candidateIdToEdit);

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', ...$params);

        if (!$stmt->execute()) { // Execute the update query
            $_SESSION['message'] = "Error updating candidate poster.";
        }
    }

    $_SESSION['message'] = "Candidate details updated successfully!";
}

// Close the database connection
$conn->close();

header('Location: candidateView.php');
exit();
?>