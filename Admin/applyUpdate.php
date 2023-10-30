<?php
include '../Database/connect.php';

if (isset($_GET['status']) && isset($_GET['id'])) {
    $status = $_GET['status'];
    $id = $_GET['id'];

    $sql = "UPDATE apply SET status = ? WHERE applyId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }
}

// Close the database connection
$conn->close();
?>