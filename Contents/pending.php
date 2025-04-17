<?php

include '../Database/db_connection.php';

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM pending_forms WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Form deleted successfully");</script>';
    } else {
        echo '<script>alert("Error deleting form: ' . $conn->error . '");</script>';
    }
}

$sql = "SELECT id, full_name, section_division, description, date_of_filing, date_received, contact_no FROM pending_forms";
$result = $conn->query($sql);

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['pending_id'])) {
    $id = $_GET['pending_id'];
    $sql = "DELETE FROM pending_forms WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Form deleted successfully");</script>';
    } else {
        echo '<script>alert("Error deleting form: ' . $conn->error . '");</script>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Forms</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <link rel="stylesheet" href="../styles/pending.css">
    <link rel="stylesheet" href="../styles/navbar.css">
    <link rel="stylesheet" href="../styles/logoutModal.css">
    <script src="../Scripts/Nav-modal.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
      < class="pending-container">
      <?php include '../Components/navbar.php'; ?>

    <div class="container">
        <h1>Pending Forms</h1>
        <div id="pending-table">
            <?php
            if ($result->num_rows > 0) {
                echo '<table>';
                echo '<tr><th>Full Name</th><th>Section/Division</th><th>Description</th><th>Date</th><th>Contact No.</th><th>Actions</th></tr>';

                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row["full_name"] . '</td>';
                    echo '<td>' . $row["section_division"] . '</td>';
                    echo '<td>' . $row["description"] . '</td>';
                    echo '<td>' . $row["date_received"] . '</td>';
                    echo '<td>' . $row["contact_no"] . '</td>';
                    echo '<td class="actions">';
                    echo '<a href="form.html?id=' . $row["id"] . '&full_name=' . urlencode($row["full_name"]) . '&section_division=' . urlencode($row["section_division"]) . '&description=' . urlencode($row["description"]) . '&date_of_filing=' . $row["date_of_filing"]. '&date_received=' . $row["date_received"] . '&contact_no=' . urlencode($row["contact_no"]) . '&pending_id=' . $row["id"] . '"><button class="reviewbtn">Review</button></a>';

                    echo '<button onclick="deleteForm(' . $row["id"] . ')" class="deletebtn">Delete</button>';
                    echo '</td>';
                    echo '</tr>';
                }

                echo '</table>';
            } else {
                echo '<p>No pending forms found.</p>';
            }

            $conn->close();
            ?>
        </div>
    </div>

        

    <script>
       
        function deleteForm(id) {
            if (confirm('Are you sure you want to delete this form?')) {
                window.location.href = './pending.php?action=delete&id=' + id;
            }
        }
    </script>
    
</body>

</html>
