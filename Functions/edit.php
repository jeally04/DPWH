<?php
session_start();
if (!isset($_SESSION['loggedin'])) { header('location: ../index.html'); exit(); }

include '../Database/db_connection.php';

if (!isset($_GET['id'])) {
    header("Location: ../Contents/history.php");
    exit();
}

$id = (int)$_GET['id'];
$stmt = $conn->prepare("SELECT * FROM job_sheet WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("Record not found.");
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Record - DPWH Job Sheet</title>
    <link rel="stylesheet" href="../styles/form.css">
</head>

<body>
    <div class="form-container">
        <h1>Edit Record</h1>
        <form method="POST" action="update.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <label>Type:</label>
            <select name="type">
                <option value="Hardware" <?php if ($row['type'] === 'Hardware') echo 'selected'; ?>>Hardware</option>
                <option value="Software" <?php if ($row['type'] === 'Software') echo 'selected'; ?>>Software</option>
            </select>

            <label>Status:</label>
            <select name="status">
                <option value="Closed" <?php if ($row['status'] === 'Closed') echo 'selected'; ?>>Closed</option>
                <option value="Open" <?php if ($row['status'] === 'Open') echo 'selected'; ?>>Open</option>
            </select>

            <label>Full Name:</label>
            <input type="text" name="full_name" value="<?php echo htmlspecialchars($row['full_name'] ?? ''); ?>">

            <label>Section/Division:</label>
            <input type="text" name="section_division" value="<?php echo htmlspecialchars($row['section_division'] ?? ''); ?>">

            <label>Description:</label>
            <textarea name="description"><?php echo htmlspecialchars($row['description'] ?? ''); ?></textarea>

            <label>Date of Filing:</label>
            <input type="date" name="date_of_filing" value="<?php echo htmlspecialchars($row['date_of_filing'] ?? ''); ?>">

            <label>Contact No.:</label>
            <input type="text" name="contact_no" value="<?php echo htmlspecialchars($row['contact_no'] ?? ''); ?>">

            <label>Hardware Type:</label>
            <input type="text" name="hardware_type" value="<?php echo htmlspecialchars($row['hardware_type'] ?? ''); ?>">

            <label>Serial Number:</label>
            <input type="text" name="serial_number" value="<?php echo htmlspecialchars($row['serial_number'] ?? ''); ?>">

            <label>Brand and Model:</label>
            <input type="text" name="brand_model" value="<?php echo htmlspecialchars($row['brand_model'] ?? ''); ?>">

            <label>Computer Name:</label>
            <input type="text" name="computer_name" value="<?php echo htmlspecialchars($row['computer_name'] ?? ''); ?>">

            <label>Application Description:</label>
            <textarea name="application_description"><?php echo htmlspecialchars($row['application_description'] ?? ''); ?></textarea>

            <label>Version:</label>
            <input type="text" name="version" value="<?php echo htmlspecialchars($row['version'] ?? ''); ?>">

            <label>Connectivity Description:</label>
            <textarea name="connectivity_description"><?php echo htmlspecialchars($row['connectivity_description'] ?? ''); ?></textarea>

            <label>User Account Description:</label>
            <textarea name="user_account_description"><?php echo htmlspecialchars($row['user_account_description'] ?? ''); ?></textarea>

            <label>Assessment:</label>
            <textarea name="assessment"><?php echo htmlspecialchars($row['assessment'] ?? ''); ?></textarea>

            <label>Actions Taken:</label>
            <textarea name="actions_taken"><?php echo htmlspecialchars($row['actions_taken'] ?? ''); ?></textarea>

            <label>Mode of Filing:</label>
            <select name="mode_of_filing">
                <option value="Walk-in" <?php if ($row['mode_of_filing'] === 'Walk-in') echo 'selected'; ?>>Walk-in</option>
                <option value="Telephone Call" <?php if ($row['mode_of_filing'] === 'Telephone Call') echo 'selected'; ?>>Telephone Call</option>
                <option value="Email" <?php if ($row['mode_of_filing'] === 'Email') echo 'selected'; ?>>Email</option>
            </select>

            <label>Fulfilled By:</label>
            <input type="text" name="fulfilled_by" value="<?php echo htmlspecialchars($row['fulfilled_by'] ?? ''); ?>">

            <label>Date Received:</label>
            <input type="datetime-local" name="date_received" value="<?php echo date('Y-m-d\TH:i', strtotime($row['date_received'] ?? 'now')); ?>">

            <label>Date Completed:</label>
            <input type="datetime-local" name="date_completed" value="<?php echo date('Y-m-d\TH:i', strtotime($row['date_completed'] ?? 'now')); ?>">

            <label>Reviewed By:</label>
            <input type="text" name="reviewed_by" value="<?php echo htmlspecialchars($row['reviewed_by'] ?? ''); ?>">

            <div class="button-group">
                <button type="submit" name="update" class="btn-primary">Update</button>
                <a href="../Contents/history.php" class="btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>

</html>
