<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "job_sheet_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $type = $_POST['type'];
    $full_name = $_POST['full_name'];
    $section_division = $_POST['section_division'];
    $description = $_POST['description'];
    $date_of_filing = $_POST['date_of_filing'];
    $contact_no = $_POST['contact_no'];
    $hardware_type = $_POST['hardware_type'];
    $serial_number = $_POST['serial_number'];
    $brand_model = $_POST['brand_model'];
    $computer_name = $_POST['computer_name'];
    $application_description = $_POST['application_description'];
    $version = $_POST['version'];
    $connectivity_description = $_POST['connectivity_description'];
    $user_account_description = $_POST['user_account_description'];
    $assessment = $_POST['assessment'];
    $actions_taken = $_POST['actions_taken'];
    $mode_of_filing = $_POST['mode_of_filing'];
    $fulfilled_by = $_POST['fulfilled_by'];
    $date_received = $_POST['date_received'];
    $date_completed = $_POST['date_completed'];
    $reviewed_by = $_POST['reviewed_by'];
    $status = $_POST['status'];

    $sql = "UPDATE job_sheet SET 
            type='$type',
            full_name='$full_name', 
            section_division='$section_division', 
            description='$description', 
            date_of_filing='$date_of_filing', 
            contact_no='$contact_no', 
            hardware_type='$hardware_type', 
            serial_number='$serial_number', 
            brand_model='$brand_model', 
            computer_name='$computer_name', 
            application_description='$application_description', 
            version='$version', 
            connectivity_description='$connectivity_description', 
            user_account_description='$user_account_description', 
            assessment='$assessment', 
            actions_taken='$actions_taken', 
            mode_of_filing='$mode_of_filing', 
            fulfilled_by='$fulfilled_by', 
            date_received='$date_received', 
            date_completed='$date_completed', 
            reviewed_by='$reviewed_by',
            status='$status'

            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $update_success = true;

    if ($update_success) {
        header("Location: ../Contents/history.php");
        exit(); 
    }
 }
?>
