<?php
session_start();
if (!isset($_SESSION['loggedin'])) { header('location: ../index.html'); exit(); }

include '../Database/db_connection.php';

$search_query = "";
$month = date('m');
$year = date('Y');
$start_date = "";
$end_date = "";

if (isset($_POST['search'])) {
   $search_query = $_POST['search_query'] ?? '';
   $month = $_POST['month'] ?? '';
   $year = $_POST['year'] ?? date('Y');
   $start_date = $_POST['start_date'] ?? '';
   $end_date = $_POST['end_date'] ?? '';

   if (!empty($start_date) && !empty($end_date)) {
      $month = "";
      $year = "";
      $end_date_obj = new DateTime($end_date);
      $month = $end_date_obj->format('m');
      $year = $end_date_obj->format('Y');
   } elseif (!empty($month) && !empty($year)) {
      $start_date = "$year-$month-01";
      $end_date = date("Y-m-t", strtotime($start_date));
   } elseif (!empty($year)) {
      $start_date = "$year-01-01";
      $end_date = "$year-12-31";
   }
} elseif (isset($_POST['clear'])) {
   $search_query = "";
   $month = date('m');
   $year = date('Y');
   $start_date = "";
   $end_date = "";
}

$like = '%' . $conn->real_escape_string($search_query) . '%';

$sql = "SELECT * FROM job_sheet WHERE
      (full_name LIKE ? OR
      section_division LIKE ? OR
      description LIKE ? OR
      date_of_filing LIKE ? OR
      type LIKE ? OR
      hardware_type LIKE ? OR
      assessment LIKE ? OR
      actions_taken LIKE ? OR
      incident_type LIKE ? OR
      status LIKE ?)";

$params = array_fill(0, 10, $like);
$types = str_repeat('s', 10);

if (!empty($start_date) && !empty($end_date)) {
   $sql .= " AND (date_received BETWEEN ? AND ?)";
   $params[] = $start_date;
   $params[] = $end_date;
   $types .= 'ss';
}

$sql .= " ORDER BY date_received ASC";

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
   <title>Monthly Help Desk Report - DPWH</title>
   <link rel="stylesheet" href="../styles/monthly_report.css">
   <link rel="stylesheet" href="../styles/logoutModal.css">
   <script src="../Scripts/Nav-modal.js"></script>
   <script src="../Scripts/monthly_report.js"></script>
</head>
<body>
   <div class="monthly_report_container">
      <?php include '../Components/navbar.php'; ?>

      <div class="report-header">
            <h2>Monthly Help Desk Report</h2>
            <form id="report-form">
               <div class="form-group-container">
                  <div class="form-group">
                        <label for="month">For the Month of:</label>
                        <input type="text" id="month" name="month" value="<?php echo (!empty($month) && !empty($year)) ? date('F, Y', strtotime("$year-$month-01")) : date('F, Y'); ?>">
                  </div>
                  <div class="form-group">
                        <label for="region">Region:</label>
                        <input type="text" id="region" name="region" value="VII">
                  </div>
                  <div class="form-group">
                        <label for="office">Office:</label>
                        <input type="text" id="office" name="office" value="Bohol 1st District Engineering Office">
                  </div>
                  <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="address" value="Dao District, Tagbilaran City, Bohol">
                  </div>
                  <div class="form-group">
                        <label for="officers">IT Support Officers:</label>
                        <input type="text" id="officers" name="officers" value="VIRGO L. ARMACHUELO">
                  </div>
                  <div class="form-group">
                        <label for="contact">Contact Number:</label>
                        <input type="text" id="contact" name="contact" value="63 907-490-4677/62015/62016/62031/62043">
                  </div>
                  <div class="form-group">
                        <label for="email">Email Address:</label>
                        <input type="text" id="email" name="email" value="armachuelo.virgo@dpwhnet.gov.ph">
                  </div>
                  <div class="submitted">
                        <label for="submitted">Submitted by:</label>
                        <input type="text" id="submitted" name="submitted" value="VIRGO L. ARMACHUELO">
                  </div>
                  <div class="noted">
                        <label for="noted">Noted by:</label>
                        <input type="text" id="noted" name="noted" value="JOHN PAUL T. GASCON">
                  </div>
               </div>
            </form>
      </div>

      <form method="POST" action="monthly_report.php" class="search-form">
            <div class="search-container">
               <input type="text" name="search_query" placeholder="Search..." value="<?php echo htmlspecialchars($search_query); ?>">
               <button type="submit" name="search" class="btn-search">Search</button>
               <button type="button" name="print" onclick="printPage()" class="btn-print">Print</button>
               <button type="submit" name="clear" class="btn-clear">Clear</button>
            </div>
            <div class="date-container">
               <label for="month">Month:</label>
               <select name="month">
                  <option value="">Select Month</option>
                  <option value="01" <?php if ($month == '01') echo 'selected'; ?>>January</option>
                  <option value="02" <?php if ($month == '02') echo 'selected'; ?>>February</option>
                  <option value="03" <?php if ($month == '03') echo 'selected'; ?>>March</option>
                  <option value="04" <?php if ($month == '04') echo 'selected'; ?>>April</option>
                  <option value="05" <?php if ($month == '05') echo 'selected'; ?>>May</option>
                  <option value="06" <?php if ($month == '06') echo 'selected'; ?>>June</option>
                  <option value="07" <?php if ($month == '07') echo 'selected'; ?>>July</option>
                  <option value="08" <?php if ($month == '08') echo 'selected'; ?>>August</option>
                  <option value="09" <?php if ($month == '09') echo 'selected'; ?>>September</option>
                  <option value="10" <?php if ($month == '10') echo 'selected'; ?>>October</option>
                  <option value="11" <?php if ($month == '11') echo 'selected'; ?>>November</option>
                  <option value="12" <?php if ($month == '12') echo 'selected'; ?>>December</option>
               </select>
               <label for="year">Year:</label>
               <select name="year">
                  <?php for ($i = date("Y"); $i >= 2000; $i--): ?>
                  <option value="<?php echo $i; ?>" <?php if ($i == $year) echo 'selected'; ?>><?php echo $i; ?></option>
                  <?php endfor; ?>
               </select>
               <label for="start_date">From:</label>
               <input type="date" name="start_date" class="startEnd" value="<?php echo htmlspecialchars($start_date); ?>">
               <label for="end_date">To:</label>
               <input type="date" name="end_date" class="startEnd" value="<?php echo htmlspecialchars($end_date); ?>">
            </div>
      </form>

      <div class="table-scroll">
      <table id="reportTable">
            <thead>
               <tr>
                  <th>Item No.</th>
                  <th>Type of Incident</th>
                  <th>Main Category</th>
                  <th>Sub-Category</th>
                  <th>Description of Incident</th>
                  <th>Status</th>
                  <th>Date Reported (mm/dd/yyyy)</th>
                  <th>Reported by</th>
                  <th>Resolution/Remarks</th>
               </tr>
            </thead>
            <tbody>
               <?php
               $item_no = 1;
               while ($row = $result->fetch_assoc()):
                  $date_of_filing = new DateTime($row['date_of_filing']);
               ?>
                  <tr>
                        <td><?php echo $item_no++; ?></td>
                        <td><?php echo htmlspecialchars($row['incident_type']); ?></td>
                        <td><?php echo htmlspecialchars($row['type']); ?></td>
                        <td><?php echo htmlspecialchars($row['hardware_type']); ?></td>
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                        <td><?php echo htmlspecialchars($row['status']); ?></td>
                        <td><?php echo $date_of_filing->format('m/d/Y'); ?></td>
                        <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['actions_taken']); ?></td>
                  </tr>
               <?php endwhile; ?>
            </tbody>
      </table>
      </div>
      <?php $conn->close(); ?>
   </div>

   <div id="logoutModal" class="modal">
      <div class="modal-content">
         <p>Are you sure you want to log out?</p>
         <button class="confirm-logout" onclick="confirmLogout()">Yes</button>
         <button class="cancel-logout" onclick="closeModal()">No</button>
      </div>
   </div>
</body>
</html>
