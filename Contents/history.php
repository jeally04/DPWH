<?php
session_start();
if (!isset($_SESSION['loggedin'])) { header('location: ../index.html'); exit(); }

include '../Database/db_connection.php';

$search_query = "";
$start_date = "";
$end_date = "";
if (isset($_POST['search'])) {
    $search_query = $_POST['search_query'] ?? '';
    $start_date = $_POST['start_date'] ?? '';
    $end_date = $_POST['end_date'] ?? '';
}

$like = '%' . $conn->real_escape_string($search_query) . '%';

$sql = "SELECT * FROM job_sheet WHERE
        (full_name LIKE ? OR
        section_division LIKE ? OR
        description LIKE ? OR
        date_of_filing LIKE ? OR
        contact_no LIKE ? OR
        type LIKE ? OR
        hardware_type LIKE ? OR
        serial_number LIKE ? OR
        brand_model LIKE ? OR
        computer_name LIKE ? OR
        application_description LIKE ? OR
        version LIKE ? OR
        connectivity_description LIKE ? OR
        user_account_description LIKE ? OR
        assessment LIKE ? OR
        actions_taken LIKE ? OR
        mode_of_filing LIKE ? OR
        fulfilled_by LIKE ? OR
        reviewed_by LIKE ? OR
        status LIKE ?)";

$params = array_fill(0, 20, $like);
$types = str_repeat('s', 20);

if (!empty($start_date) && !empty($end_date)) {
    $sql .= " AND (date_received BETWEEN ? AND ?)";
    $params[] = $start_date;
    $params[] = $end_date;
    $types .= 'ss';
}

$sql .= " ORDER BY date_received DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Sheet History - DPWH</title>
    <link rel="stylesheet" href="../styles/history.css">
    <link rel="stylesheet" href="../styles/logoutModal.css">
    <script src="../Scripts/print3.js"></script>
    <script src="../Scripts/Nav-modal.js"></script>
</head>

<body>
    <div class="history-container">
    <?php include '../Components/navbar.php'; ?>

    <div class="form-container">
        <h1>Job Sheet History</h1>
        <form method="POST" action="./history.php" class="search-form">
            <input type="text" name="search_query" placeholder="Search..." value="<?php echo htmlspecialchars($search_query); ?>">
            <label for="start_date">From:</label>
            <input type="date" name="start_date" class="startEnd" value="<?php echo htmlspecialchars($start_date); ?>">
            <label for="end_date">To:</label>
            <input type="date" name="end_date" class="startEnd" value="<?php echo htmlspecialchars($end_date); ?>">
            <button type="submit" name="search" class="btn-search">Search</button>
        </form>

        <?php if ($result->num_rows > 0): ?>
        <div class="table-scroll-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Section / Division</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Date Filed</th>
                    <th>Date Received</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td data-label="Full Name"><?php echo htmlspecialchars($row['full_name']); ?></td>
                    <td data-label="Section/Division"><?php echo htmlspecialchars($row['section_division']); ?></td>
                    <td data-label="Type"><?php echo htmlspecialchars($row['type']); ?></td>
                    <td data-label="Status">
                        <span class="status-badge status-<?php echo strtolower(htmlspecialchars($row['status'])); ?>">
                            <?php echo htmlspecialchars($row['status']); ?>
                        </span>
                    </td>
                    <td data-label="Date Filed"><?php echo htmlspecialchars($row['date_of_filing']); ?></td>
                    <td data-label="Date Received"><?php echo htmlspecialchars($row['date_received']); ?></td>
                    <td class="action-cell">
                        <button type="button" class="btn btn-details"
                            onclick="showDetails(
                                <?php echo htmlspecialchars(json_encode([
                                    'full_name'                  => $row['full_name'],
                                    'section_division'           => $row['section_division'],
                                    'description'                => $row['description'],
                                    'date_of_filing'             => $row['date_of_filing'],
                                    'contact_no'                 => $row['contact_no'],
                                    'type'                       => $row['type'],
                                    'hardware_type'              => $row['hardware_type'],
                                    'serial_number'              => $row['serial_number'],
                                    'brand_model'                => $row['brand_model'],
                                    'computer_name'              => $row['computer_name'],
                                    'application_description'    => $row['application_description'],
                                    'version'                    => $row['version'],
                                    'connectivity_description'   => $row['connectivity_description'],
                                    'user_account_description'   => $row['user_account_description'],
                                    'assessment'                 => $row['assessment'],
                                    'actions_taken'              => $row['actions_taken'],
                                    'mode_of_filing'             => $row['mode_of_filing'],
                                    'fulfilled_by'               => $row['fulfilled_by'],
                                    'date_received'              => $row['date_received'],
                                    'date_completed'             => $row['date_completed'],
                                    'reviewed_by'                => $row['reviewed_by'],
                                    'incident_type'              => $row['incident_type'],
                                    'status'                     => $row['status'],
                                ]), ENT_QUOTES, 'UTF-8'); ?>
                            )">
                            <i class="fas fa-eye"></i> Details
                        </button>
                        <a href="../Functions/edit.php?id=<?php echo (int)$row['id']; ?>" class="btn btn-edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <button type="button" class="btn btn-print"
                            onclick="printJobSheet(<?php echo (int)$row['id']; ?>)">
                            <i class="fas fa-print"></i> Print
                        </button>
                        <form action="../Functions/delete.php" method="post" style="display:inline;"
                            onsubmit="return confirm('Are you sure you want to delete this record?');">
                            <input type="hidden" name="id" value="<?php echo (int)$row['id']; ?>">
                            <button type="submit" class="btn btn-delete">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        </div>

        <?php else: ?>
        <p>No records found</p>
        <?php endif; ?>
        <?php $conn->close(); ?>
    </div>
    </div>

    <!-- Details Modal -->
    <div id="detailsModal" class="details-modal-overlay" onclick="closeDetails(event)">
        <div class="details-modal">
            <div class="details-modal-header">
                <h2><i class="fas fa-file-alt"></i> Job Sheet Details</h2>
                <button class="details-close-btn" onclick="closeDetailsModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="details-modal-body" id="detailsModalBody"></div>
        </div>
    </div>

    <!-- Logout Modal -->
    <div id="logoutModal" class="modal">
        <div class="modal-content">
            <p>Are you sure you want to log out?</p>
            <button class="confirm-logout" onclick="confirmLogout()">Yes</button>
            <button class="cancel-logout" onclick="closeModal()">No</button>
        </div>
    </div>

    <script>
    function showDetails(data) {
        const labels = {
            full_name:                 'Full Name',
            section_division:          'Section / Division',
            description:               'Description',
            date_of_filing:            'Date of Filing',
            contact_no:                'Contact No.',
            type:                      'Type',
            hardware_type:             'Hardware Type',
            serial_number:             'Serial Number',
            brand_model:               'Brand & Model',
            computer_name:             'Computer Name',
            application_description:   'Application Description',
            version:                   'Version',
            connectivity_description:  'Connectivity Description',
            user_account_description:  'User Account Description',
            assessment:                'Assessment',
            actions_taken:             'Actions Taken',
            mode_of_filing:            'Mode of Filing',
            fulfilled_by:              'Fulfilled By',
            date_received:             'Date Received',
            date_completed:            'Date Completed',
            reviewed_by:               'Reviewed By',
            incident_type:             'Type of Incident',
            status:                    'Status',
        };

        let html = '<div class="details-grid">';
        for (const key in labels) {
            const val = data[key] ? data[key] : '—';
            html += `
                <div class="details-item">
                    <span class="details-label">${labels[key]}</span>
                    <span class="details-value">${escapeHtml(val)}</span>
                </div>`;
        }
        html += '</div>';

        document.getElementById('detailsModalBody').innerHTML = html;
        document.getElementById('detailsModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeDetailsModal() {
        document.getElementById('detailsModal').classList.remove('active');
        document.body.style.overflow = '';
    }

    function closeDetails(e) {
        if (e.target === document.getElementById('detailsModal')) closeDetailsModal();
    }

    function escapeHtml(str) {
        const div = document.createElement('div');
        div.appendChild(document.createTextNode(str));
        return div.innerHTML;
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeDetailsModal();
    });
    </script>
</body>

</html>
