<?php
include 'Database/connect.php';
session_start();

 // Check if user is logged in
 if (!isset($_SESSION['student_id'])) {
    // If not, redirect to login page
    header('Location: login.php');
    exit();
}

// Check if form is submitted
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

        // SQL query to update the candidate details, candidate no and profile picture
        $sql = "UPDATE candidate SET candidateName = ?, candNo = ?, candidatePic = ?, email = ?, contact = ?, faculty = ?, courseName = ?, manifesto = ?, links = ? WHERE candidateId = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssi", $candidateName, $candNo, $pic, $email, $contact, $faculty, $courseName, $manifesto, $links, $candidateIdToEdit);
    } else {
        // SQL query to update the candidate details and candidate no without changing the profile picture
        $sql = "UPDATE candidate SET candidateName = ?, candNo = ?, email = ?, contact = ?, faculty = ?, courseName = ?, manifesto = ?, links = ? WHERE candidateId = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssi", $candidateName, $candNo, $email, $contact, $faculty, $courseName, $manifesto, $links, $candidateIdToEdit);
    }

    if ($stmt->execute()) { // Execute the update query
        $_SESSION['message'] = "Candidate details updated successfully!";
    } else {
        $_SESSION['message'] = "Error updating candidate details.";
    }
}

// Close the database connection
$conn->close();

header('Location: candidateView.php');
exit();
?>