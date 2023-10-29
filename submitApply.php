<?php
    include 'Database/connect.php';

    // Get the submitted data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $course = $_POST['course'];
    $faculty = $_POST['faculty'];
    $manifesto = $_POST['manifesto'];
    $link = $_POST['link'];

    // Prepare an SQL statement
    $sql = "INSERT INTO apply (name, email, contact, course, faculty, manifesto, link) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind the parameters
    $stmt->bind_param("sssssss", $name, $email, $contact, $course, $faculty, $manifesto, $link);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Application submitted successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and the connection
    $stmt->close();
    $conn->close();
?>