<?php
include '../Database/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = isset($_POST['full_name']) ? mysqli_real_escape_string($conn, $_POST['full_name']) : '';
    $section_division = isset($_POST['section_division']) ? mysqli_real_escape_string($conn, $_POST['section_division']) : '';
    $description = isset($_POST['description']) ? mysqli_real_escape_string($conn, $_POST['description']) : '';
    $date_of_filing = isset($_POST['date_of_filing']) ? mysqli_real_escape_string($conn, $_POST['date_of_filing']) : '';
    $date_received = isset($_POST['date_received']) ? mysqli_real_escape_string($conn, $_POST['date_received']) : '';
    $contact_no = isset($_POST['contact_no']) ? mysqli_real_escape_string($conn, $_POST['contact_no']) : '';

    $sql = "INSERT INTO pending_forms (full_name, section_division, description, date_of_filing, contact_no, date_received)
            VALUES ('$full_name', '$section_division', '$description', '$date_of_filing', '$contact_no','$date_received')";

    if (mysqli_query($conn, $sql)) {
        echo 'success';
    } else {
        echo 'Error: ' . $sql . '<br>' . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
