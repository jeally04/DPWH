<?php
include '../Database/db_connection.php';

if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

function defaultToNA($value) {
   return (isset($value) && $value !== '') ? $value : 'N/A';
}

function formatDateTimeValue($datetime) {
   if (empty($datetime)) return 'N/A';
   try {
      $dateTimeObj = new DateTime($datetime);
      return $dateTimeObj->format('Y-m-d h:i A');
   } catch (Exception $e) {
      return $datetime;
   }
}

function formatDateOnly($date) {
   if (empty($date)) return 'N/A';
   try {
      $dateObj = new DateTime($date);
      return $dateObj->format('Y-m-d');
   } catch (Exception $e) {
      return $date;
   }
}

$full_name = defaultToNA($_POST['full_name'] ?? '');
$section_division = defaultToNA($_POST['section_division'] ?? '');
$description = defaultToNA($_POST['description'] ?? '');
$date_of_filing = formatDateOnly($_POST['date_of_filing'] ?? '');
$contact_no = defaultToNA($_POST['contact_no'] ?? '');

$type = $_POST['type'] ?? '';
$status = defaultToNA($_POST['status'] ?? '');
$incident_type = "Service Request";

$hardware_type = defaultToNA($_POST['hardware_type'] ?? '');
$serial_number = defaultToNA($_POST['serial_number'] ?? '');
$brand_model = defaultToNA($_POST['brand_model'] ?? '');
$computer_name = defaultToNA($_POST['computer_name'] ?? '');
$application_description = defaultToNA($_POST['application_description'] ?? '');
$version = defaultToNA($_POST['version'] ?? '');
$connectivity_description = defaultToNA($_POST['connectivity_description'] ?? '');
$user_account_description = defaultToNA($_POST['user_account_description'] ?? '');

$assessment = defaultToNA($_POST['assessment'] ?? '');
$actions_taken = defaultToNA($_POST['actions_taken'] ?? '');
$mode_of_filing = $_POST['mode_of_filing'] ?? '';
$fulfilled_by = defaultToNA($_POST['fulfilled_by'] ?? '');
$date_received = formatDateTimeValue($_POST['date_received'] ?? '');
$date_completed = formatDateTimeValue($_POST['date_completed'] ?? '');
$reviewed_by = defaultToNA($_POST['reviewed_by'] ?? '');

$stmt = $conn->prepare("INSERT INTO job_sheet (full_name, section_division, description, date_of_filing, contact_no, type, status, incident_type, hardware_type, serial_number, brand_model, computer_name, application_description, version, connectivity_description, user_account_description, assessment, actions_taken, mode_of_filing, fulfilled_by, date_received, date_completed, reviewed_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param(
   "sssssssssssssssssssssss",
   $full_name, $section_division, $description, $date_of_filing, $contact_no,
   $type, $status, $incident_type, $hardware_type, $serial_number, $brand_model,
   $computer_name, $application_description, $version, $connectivity_description,
   $user_account_description, $assessment, $actions_taken, $mode_of_filing,
   $fulfilled_by, $date_received, $date_completed, $reviewed_by
);

if ($stmt->execute()) {
   echo '<div id="successMessage" class="message">New record created successfully.</div>';
} else {
   echo '<div id="errorMessage" class="message">Error: ' . htmlspecialchars($stmt->error) . '</div>';
}

$stmt->close();
$conn->close();
?>
