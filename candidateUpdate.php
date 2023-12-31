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
        if (isset($poster)) {
            $sql = "UPDATE candidate SET candidateName = ?, candNo = ?, email = ?, contact = ?, faculty = ?, courseName = ?, manifesto = ?, links = ?, poster = ? WHERE candidateId = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssssssi", $candidateName, $candNo, $email, $contact, $faculty, $courseName, $manifesto, $links, $poster, $candidateIdToEdit);
        } else {
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