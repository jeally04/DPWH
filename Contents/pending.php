<?php
session_start();
if (!isset($_SESSION['loggedin'])) { header('location: ../index.html'); exit(); }

include '../Database/db_connection.php';

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $conn->prepare("DELETE FROM pending_forms WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo '<script>alert("Form deleted successfully");</script>';
    } else {
        echo '<script>alert("Error deleting form: ' . $conn->error . '");</script>';
    }
    $stmt->close();
}

$sql = "SELECT id, full_name, section_division, description, date_of_filing, date_received, contact_no FROM pending_forms";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Forms - DPWH Job Sheet</title>
    <link rel="stylesheet" href="../styles/pending.css">
    <link rel="stylesheet" href="../styles/navbar.css">
    <link rel="stylesheet" href="../styles/logoutModal.css">
    <script src="../Scripts/Nav-modal.js"></script>
</head>

<body>
    <div class="pending-container">
        <?php include '../Components/navbar.php'; ?>

        <div class="container">
            <h1>Pending Forms</h1>
            <div id="pending-table">
                <?php
                if ($result && $result->num_rows > 0) {
                    echo '<div class="table-scroll-wrapper">';
                    echo '<table>';
                    echo '<thead><tr><th>Full Name</th><th>Section/Division</th><th>Description</th><th>Date</th><th>Contact No.</th><th>Actions</th></tr></thead>';
                    echo '<tbody>';

                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td data-label="Full Name">' . htmlspecialchars($row["full_name"]) . '</td>';
                        echo '<td data-label="Section/Division">' . htmlspecialchars($row["section_division"]) . '</td>';
                        echo '<td data-label="Description">' . htmlspecialchars($row["description"]) . '</td>';
                        echo '<td data-label="Date">' . htmlspecialchars($row["date_received"]) . '</td>';
                        echo '<td data-label="Contact No.">' . htmlspecialchars($row["contact_no"]) . '</td>';
                        echo '<td class="action-cell" data-label="Actions">';
                        echo '<a href="form.html?id=' . $row["id"]
                            . '&full_name=' . urlencode($row["full_name"])
                            . '&section_division=' . urlencode($row["section_division"])
                            . '&description=' . urlencode($row["description"])
                            . '&date_of_filing=' . urlencode($row["date_of_filing"])
                            . '&date_received=' . urlencode($row["date_received"])
                            . '&contact_no=' . urlencode($row["contact_no"])
                            . '&pending_id=' . $row["id"]
                            . '" class="btn btn-review"><i class="fas fa-clipboard-check"></i> Review</a>';
                        echo '<button onclick="deleteForm(' . (int)$row["id"] . ')" class="btn btn-delete"><i class="fas fa-trash"></i> Delete</button>';
                        echo '</td>';
                        echo '</tr>';
                    }

                    echo '</tbody>';
                    echo '</table>';
                    echo '</div>';
                } else {
                    echo '<p>No pending forms found.</p>';
                }

                $conn->close();
                ?>
            </div>
        </div>
    </div>

    <div id="logoutModal" class="modal">
        <div class="modal-content">
            <p>Are you sure you want to log out?</p>
            <button class="confirm-logout" onclick="confirmLogout()">Yes</button>
            <button class="cancel-logout" onclick="closeModal()">No</button>
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
