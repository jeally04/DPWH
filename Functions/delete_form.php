<?php
include '../Database/db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM pending_forms WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo 'Form deleted successfully';
    } else {
        echo 'Error deleting form: ' . $conn->error;
    }
}

$conn->close();
?>
