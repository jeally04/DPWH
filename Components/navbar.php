<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['loggedin'])) { header('location: ../index.html'); exit(); }

$username = $_SESSION['loggedin'];
include '../Database/db_connection.php';

$current_page = basename($_SERVER['PHP_SELF']);

function getPendingCount($conn) {
   $sql = "SELECT COUNT(*) AS pending_count FROM pending_forms";
   $result = $conn->query($sql);
   if ($result && $result->num_rows > 0) {
      $row = $result->fetch_assoc();
      return $row['pending_count'];
   } else {
      return 0;
   }
}

function getJobSheetRowCount($conn) {
   $sql = "SELECT COUNT(*) AS job_sheet_count FROM job_sheet";
   $result = $conn->query($sql);
   if ($result && $result->num_rows > 0) {
      $row = $result->fetch_assoc();
      return $row['job_sheet_count'];
   } else {
      return 0;
   }
}

$pendingCount = getPendingCount($conn);
$jobSheetCount = getJobSheetRowCount($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Job Sheet Form</title>
   <link rel="stylesheet" href="../styles/navbar.css">
   <script src="../Scripts/Nav-modal.js"></script>
   <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://kit.fontawesome.com/90f0a938cd.js" crossorigin="anonymous"></script>
</head>
<style></style>

<body>
<div class="Navigation">
      <div class="LogoAndText">
         <img class="Logo1" src="../image/logo.png" alt="Logo" />
         <div class="TextContainer">
            <div class="DpwhText">DPWH</div>
            <div class="AdditionalText">Bohol 1st District Engineering Office <br>
         Information and Communication Technology Staff</div>
         </div>
      </div>
      <div class="MenuToggle" onclick="toggleMenu()">
         <i class="fas fa-bars"></i>
      </div>
      <div class="NavContainer">
         <div class="Navlinks" id="Navlinks">
            <a class="Home <?php echo $current_page === 'home.php' ? 'active' : ''; ?>" href="../Contents/home.php">Home</a>
            <a class="FormNav <?php echo $current_page === 'pending_form.php' ? 'active' : ''; ?>" href="../Contents/pending_form.php">Form</a>
            <a class="PendingNav <?php echo $current_page === 'pending.php' ? 'active' : ''; ?>" href="../Contents/pending.php">Pending<span class="PendingBadge"><?php echo $pendingCount; ?></span></a>
            <a class="HistoryNav <?php echo in_array($current_page, ['history.php', 'monthly_report.php']) ? 'active' : ''; ?>" href="../Contents/history.php">History<span class="PendingBadge"><?php echo $jobSheetCount; ?></span></a>
            <a class="About <?php echo $current_page === 'about.php' ? 'active' : ''; ?>" href="../Contents/about.php">About</a>
            <button class="Btn" onclick="openModal()">
               <div class="sign">
                  <svg viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path></svg>
               </div>
               <div class="text">Logout</div>
            </button>
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