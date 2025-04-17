<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "job_sheet_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

function defaultToNA($value) {
   return empty($value) ? 'N/A' : $value;
}

function formatDateTime($datetime) {
   $dateTimeObj = new DateTime($datetime);
   return $dateTimeObj->format('Y-m-d h:i A'); // Format into 12-hour format with AM/PM
}

$full_name = defaultToNA($_POST['full_name']);
$section_division = defaultToNA($_POST['section_division']);
$description = defaultToNA($_POST['description']);
$date_of_filing = formatDateTime($_POST['date_of_filing']);
$contact_no = defaultToNA($_POST['contact_no']);

$type = $_POST['type']; 
$status = defaultToNA($_POST['status']);
$incident_type = "Service Request"; // Default value for incident_type

$hardware_type = defaultToNA($_POST['hardware_type']);
$serial_number = defaultToNA($_POST['serial_number']);
$brand_model = defaultToNA($_POST['brand_model']);
$computer_name = defaultToNA($_POST['computer_name']);
$application_description = defaultToNA($_POST['application_description']);
$version = defaultToNA($_POST['version']);
$connectivity_description = defaultToNA($_POST['connectivity_description']);
$user_account_description = defaultToNA($_POST['user_account_description']);

$assessment = defaultToNA($_POST['assessment']);
$actions_taken = defaultToNA($_POST['actions_taken']);
$mode_of_filing = $_POST['mode_of_filing'];
$fulfilled_by = defaultToNA($_POST['fulfilled_by']);
$date_received = formatDateTime($_POST['date_received']);
$date_completed = formatDateTime($_POST['date_completed']);
$reviewed_by = defaultToNA($_POST['reviewed_by']);

$sql = "INSERT INTO job_sheet (full_name, section_division, description, date_of_filing, contact_no, type, status, incident_type, hardware_type, serial_number, brand_model, computer_name, application_description, version, connectivity_description, user_account_description, assessment, actions_taken, mode_of_filing, fulfilled_by, date_received, date_completed, reviewed_by)
VALUES ('$full_name', '$section_division', '$description', '$date_of_filing', '$contact_no', '$type', '$status', '$incident_type', '$hardware_type', '$serial_number', '$brand_model', '$computer_name', '$application_description', '$version', '$connectivity_description', '$user_account_description', '$assessment', '$actions_taken', '$mode_of_filing', '$fulfilled_by', '$date_received', '$date_completed', '$reviewed_by')";

if ($conn->query($sql) === TRUE) {
   $message = "New record created successfully.";
   echo '<div id="successMessage" class="message">' . $message . '</div>';
} else {
   $message = "Error: " . $sql . "<br>" . $conn->error;
   echo '<div id="errorMessage" class="message">' . $message . '</div>';
}

$conn->close();
?>
