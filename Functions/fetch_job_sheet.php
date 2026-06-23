<?php
header('Content-Type: application/json');
include '../Database/db_connection.php';

if (!isset($_GET['id'])) {
    echo json_encode(["error" => "ID not provided"]);
    exit();
}

$id = (int)$_GET['id'];
$stmt = $conn->prepare("SELECT * FROM job_sheet WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo "null";
}

$stmt->close();
$conn->close();
?>
