<?php
include '../Database/db_connection.php';

if (!isset($_GET['id'])) {
    echo 'ID parameter is missing';
    exit();
}

$id = (int)$_GET['id'];
$stmt = $conn->prepare("DELETE FROM pending_forms WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo 'Form deleted successfully';
} else {
    echo 'Error deleting form: ' . $conn->error;
}

$stmt->close();
$conn->close();
?>
