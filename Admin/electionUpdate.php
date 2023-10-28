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
        $electionIdToEdit = $_POST['id'];
        $electionTitle = $_POST['electionTitle'];
        $voteNo = $_POST['voteNo'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $date = $_POST['date'];
        $rules = $_POST['rules'];

        // SQL query to update the election details
        $sql = "UPDATE election SET electionTitle = ?, voteNo = ?, start = ?, end = ?, date = ?, rules = ? WHERE electionId = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sissssi", $electionTitle, $voteNo, $start, $end, $date, $rules, $electionIdToEdit);

        if ($stmt->execute()) { // Execute the update query
            $_SESSION['message'] = "Election details updated successfully!";
        } else {
            $_SESSION['message'] = "Error updating election details.";
        }
    }

    // Close the database connection
    $conn->close();

    header('Location: electionView.php');
    exit();
?>