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
        $annIdToEdit = $_POST['id'];
        $elecTitle = $_POST['elecTitle'];
        $candName = $_POST['candName'];
        $info = $_POST['info'];

        // SQL query to update the announcement details
        $sql = "UPDATE announcement SET elecTitle = ?, candName = ?, info = ? WHERE annId = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $elecTitle, $candName, $info, $annIdToEdit);

        if ($stmt->execute()) { // Execute the update query
            $_SESSION['message'] = "Announcement details updated successfully!";
        } else {
            $_SESSION['message'] = "Error updating announcement details.";
        }
    }

    // Close the database connection
    $conn->close();

    header('Location: electionView.php');
    exit();
?>
