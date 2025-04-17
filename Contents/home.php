<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link rel="stylesheet" href="../styles/home.css">
   <!-- <link rel="stylesheet" href="../styles/navbar.css"> -->
   <link rel="stylesheet" href="../styles/logoutModal.css">
   <script src="../Scripts/Nav-modal.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
   <div class="container">
   <?php include '../Components/navbar.php'; ?>

      <div class="Dpwh">
         <img class="Logo2" src="../image/logo.png" />
         <div class="FormContainer">
            <div class="Form">
               <a href="pending_form.php">
                  <div class="Rectangle1"></div>
                  <div class="FormText">Form</div>
                  <img class="JobSheet1" src="../image/form_form.png" />
               </a>
            </div>
            <div class="Pending">
               <a href="pending.php">
                  <div class="Rectangle1"></div>
                  <div class="PendingText">Pending</div>
                  <img class="JobSheet1" src="../image/pending_form.png" />
               </a>
            </div>
            <div class="Jsf">
               <a href="./form.html">
                  <div class="Rectangle1"></div>
                  <div class="JobSheetForm">Job Sheet Form</div>
                  <img class="JobSheet1" src="../image/job sheet.png" />
               </a>
            </div>
            <div class="History">
               <a href="./monthly_report.php">
                  <div class="Rectangle1"></div>
                  <div class="HistoryText">Report</div>
                  <img class="JobSheet1" src="../image/report_form.png" />
               </a>
            </div>
         </div>
      </div>
   </body>
</html>
