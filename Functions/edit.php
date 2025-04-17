<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "job_sheet_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'] ?? null;

if ($id !== null) {
    $sql = "SELECT * FROM job_sheet WHERE id = $id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        die("Record not found.");
    }
} else {
    die("ID not provided.");
}

$conn->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming your update logic goes here
    $update_success = true; // Placeholder for your actual update logic

    if ($update_success) {
        header("Location: ../Contents/history.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Record</title>
    <link rel="stylesheet" href="../styles/history.css">
</head>

<body>
    <div class="form-container">
        <h1>Edit Record</h1>
        <form method="POST" action="update.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            Type: <input type="text" name="type" value="<?php echo $row['type'] ?? ''; ?>"><br>
            Full Name: <input type="text" name="full_name" value="<?php echo $row['full_name'] ?? ''; ?>"><br>
            Section/Division: <input type="text" name="section_division" value="<?php echo $row['section_division'] ?? ''; ?>"><br>
            Description: <input type="text" name="description" value="<?php echo $row['description'] ?? ''; ?>"><br>
            Date of Filing: <input type="date" name="date_of_filing" value="<?php echo $row['date_of_filing'] ?? ''; ?>"><br>
            Contact No.: <input type="text" name="contact_no" value="<?php echo $row['contact_no'] ?? ''; ?>"><br>
            Hardware Type: <input type="text" name="hardware_type" value="<?php echo $row['hardware_type'] ?? ''; ?>"><br>
            Serial Number: <input type="text" name="serial_number" value="<?php echo $row['serial_number'] ?? ''; ?>"><br>
            Brand and Model: <input type="text" name="brand_model" value="<?php echo $row['brand_model'] ?? ''; ?>"><br>
            Computer Name: <input type="text" name="computer_name" value="<?php echo $row['computer_name'] ?? ''; ?>"><br>
            Application Description: <input type="text" name="application_description" value="<?php echo $row['application_description'] ?? ''; ?>"><br>
            Version: <input type="text" name="version" value="<?php echo $row['version'] ?? ''; ?>"><br>
            Connectivity Description: <input type="text" name="connectivity_description" value="<?php echo $row['connectivity_description'] ?? ''; ?>"><br>
            User Account Description: <input type="text" name="user_account_description" value="<?php echo $row['user_account_description'] ?? ''; ?>"><br>
            Assessment: <input type="text" name="assessment" value="<?php echo $row['assessment'] ?? ''; ?>"><br>
            Actions Taken: <input type="text" name="actions_taken" value="<?php echo $row['actions_taken'] ?? ''; ?>"><br>
            Mode of Filing: <input type="text" name="mode_of_filing" value="<?php echo $row['mode_of_filing'] ?? ''; ?>"><br>
            Fulfilled By: <input type="text" name="fulfilled_by" value="<?php echo $row['fulfilled_by'] ?? ''; ?>"><br>
            Date Received: <input type="datetime-local" name="date_received" value="<?php echo date('Y-m-d\TH:i', strtotime($row['date_received'])) ?? ''; ?>"><br>
            Date Completed: <input type="datetime-local" name="date_completed" value="<?php echo date('Y-m-d\TH:i', strtotime($row['date_completed'])) ?? ''; ?>"><br>
            Reviewed By: <input type="text" name="reviewed_by" value="<?php echo $row['reviewed_by'] ?? ''; ?>"><br>

            Status: <input type="text" name="status" value="<?php echo $row['status'] ?? ''; ?>"><br>
            <button type="submit" name="update">Update</button>
        </form>
    </div>
</body>

</html>
