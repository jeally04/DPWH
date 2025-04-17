<?php
include '../Database/db_connection.php';

$search_query = "";
$start_date = "";
$end_date = "";
if (isset($_POST['search'])) {
    $search_query = $_POST['search_query'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
}

$sql = "SELECT * FROM job_sheet WHERE 
        (full_name LIKE '%$search_query%' OR 
        section_division LIKE '%$search_query%' OR 
        description LIKE '%$search_query%' OR 
        date_of_filing LIKE '%$search_query%' OR 
        contact_no LIKE '%$search_query%' OR 
        type LIKE '%$search_query%' OR 
        hardware_type LIKE '%$search_query%' OR 
        serial_number LIKE '%$search_query%' OR 
        brand_model LIKE '%$search_query%' OR 
        computer_name LIKE '%$search_query%' OR 
        application_description LIKE '%$search_query%' OR 
        version LIKE '%$search_query%' OR 
        connectivity_description LIKE '%$search_query%' OR 
        user_account_description LIKE '%$search_query%' OR 
        assessment LIKE '%$search_query%' OR 
        actions_taken LIKE '%$search_query%' OR 
        mode_of_filing LIKE '%$search_query%' OR 
        fulfilled_by LIKE '%$search_query%' OR 
        reviewed_by LIKE '%$search_query%' OR 
        status LIKE '%$search_query%')";

if (!empty($start_date) && !empty($end_date)) {
    $sql .= " AND (date_received BETWEEN '$start_date' AND '$end_date')";
}


$sql .= " ORDER BY date_received DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Sheet History</title>
    <link rel="stylesheet" href="../styles/history.css">
    <link rel="stylesheet" href="../styles/logoutModal.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="../Scripts/print3.js"></script>
    <script src="../Scripts/Nav-modal.js"></script>

</head>

<body>
    <div class="history-container">
    <?php include '../Components/navbar.php'; ?>

    <div class="form-container">
        <h1>Job Sheet History</h1>
        <form method="POST" action="./history.php">
            <input type="text" name="search_query" placeholder="Search..." value="<?php echo htmlspecialchars($search_query); ?>"><br>
            <label for="start_date">From:</label>
            <input type="date" name="start_date" class="startEnd" value="<?php echo htmlspecialchars($start_date); ?>">
            <label for="end_date">To:</label>
            <input type="date" name="end_date" class="startEnd" value="<?php echo htmlspecialchars($end_date); ?>">
            <button type="submit" name="search">Search</button>
        </form>

        <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Section/Division</th>
                    <th>Description</th>
                    <th>Date of Filing</th>
                    <th>Contact No.</th>
                    <th>Type</th>
                    <th>Hardware Type</th>
                    <th>Serial Number</th>
                    <th>Brand and Model</th>
                    <th>Computer Name</th>
                    <th>Application Description</th>
                    <th>Version</th>
                    <th>Connectivity Description</th>
                    <th>User Account Description</th>
                    <th>Assessment</th>
                    <th>Actions Taken</th>
                    <th>Mode of Filing</th>
                    <th>Fulfilled By</th>
                    <th>Date Received</th>
                    <th>Date Completed</th>
                    <th>Reviewed By</th>
                    <th>Type of Incident</th>
                    <th>Status</th>
                    <th>Modify</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['full_name']; ?></td>
                    <td><?php echo $row['section_division']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['date_of_filing']; ?></td>
                    <td><?php echo $row['contact_no']; ?></td>
                    <td><?php  echo $row['type']; ?></td>
                    <td><?php echo $row['hardware_type']; ?></td>
                    <td><?php echo $row['serial_number']; ?></td>
                    <td><?php echo $row['brand_model']; ?></td>
                    <td><?php echo $row['computer_name']; ?></td>
                    <td><?php echo $row['application_description']; ?></td>
                    <td><?php echo $row['version']; ?></td>
                    <td><?php echo $row['connectivity_description']; ?></td>
                    <td><?php echo $row['user_account_description']; ?></td>
                    <td><?php echo $row['assessment']; ?></td>
                    <td><?php echo $row['actions_taken']; ?></td>
                    <td><?php echo $row['mode_of_filing']; ?></td>
                    <td><?php echo $row['fulfilled_by']; ?></td>
                    <td><?php echo $row['date_received']; ?></td>
                    <td><?php echo $row['date_completed']; ?></td>
                    <td><?php echo $row['reviewed_by']; ?></td>
                    <td><?php echo $row['incident_type']; ?></td>
                    <td><?php echo $row['status']; ?></td>

                    <td>
                        <!-- Edit button -->
                        <a href="../Functions/edit.php?id=<?php echo $row['id']; ?>" ><button type="submit" name="edit">Edit</button></a>
                        
                        <!-- Print Button -->
                        <form onsubmit="return printJobSheet(<?php echo $row['id']; ?>);">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="print">Print</button>
                        </form>

                    <form action="../Functions/delete.php" method="post" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this record?');">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="delete">Delete</button>
                    </form>
        
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        
        <?php else: ?>
        <p>No records found</p>
        <?php endif; ?>
        <?php $conn->close(); ?>
    </div>
    </div>
</body>

</html>
