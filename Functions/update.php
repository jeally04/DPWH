<?php
include '../Database/db_connection.php';

if (!isset($_POST['update']) || !isset($_POST['id'])) {
    header("Location: ../Contents/history.php");
    exit();
}

$id = (int)$_POST['id'];
$type = $_POST['type'] ?? '';
$full_name = $_POST['full_name'] ?? '';
$section_division = $_POST['section_division'] ?? '';
$description = $_POST['description'] ?? '';
$date_of_filing = $_POST['date_of_filing'] ?? '';
$contact_no = $_POST['contact_no'] ?? '';
$hardware_type = $_POST['hardware_type'] ?? '';
$serial_number = $_POST['serial_number'] ?? '';
$brand_model = $_POST['brand_model'] ?? '';
$computer_name = $_POST['computer_name'] ?? '';
$application_description = $_POST['application_description'] ?? '';
$version = $_POST['version'] ?? '';
$connectivity_description = $_POST['connectivity_description'] ?? '';
$user_account_description = $_POST['user_account_description'] ?? '';
$assessment = $_POST['assessment'] ?? '';
$actions_taken = $_POST['actions_taken'] ?? '';
$mode_of_filing = $_POST['mode_of_filing'] ?? '';
$fulfilled_by = $_POST['fulfilled_by'] ?? '';
$date_received = $_POST['date_received'] ?? '';
$date_completed = $_POST['date_completed'] ?? '';
$reviewed_by = $_POST['reviewed_by'] ?? '';
$status = $_POST['status'] ?? '';

$stmt = $conn->prepare("UPDATE job_sheet SET
    type=?, full_name=?, section_division=?, description=?, date_of_filing=?,
    contact_no=?, hardware_type=?, serial_number=?, brand_model=?, computer_name=?,
    application_description=?, version=?, connectivity_description=?,
    user_account_description=?, assessment=?, actions_taken=?, mode_of_filing=?,
    fulfilled_by=?, date_received=?, date_completed=?, reviewed_by=?, status=?
    WHERE id=?");

$stmt->bind_param(
    "ssssssssssssssssssssssi",
    $type, $full_name, $section_division, $description, $date_of_filing,
    $contact_no, $hardware_type, $serial_number, $brand_model, $computer_name,
    $application_description, $version, $connectivity_description,
    $user_account_description, $assessment, $actions_taken, $mode_of_filing,
    $fulfilled_by, $date_received, $date_completed, $reviewed_by, $status, $id
);

if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
    header("Location: ../Contents/history.php");
    exit();
} else {
    echo "Error updating record: " . htmlspecialchars($stmt->error);
}

$stmt->close();
$conn->close();
?>
