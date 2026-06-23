<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>About - DPWH Job Sheet</title>
      <link rel="stylesheet" href="../styles/about.css">
      <link rel="stylesheet" href="../styles/logoutModal.css">
      <script src="../Scripts/Nav-modal.js"></script>
   </head>
   <body>
   <div class="about-container">
   <?php include '../Components/navbar.php'; ?>
      <div class="qpvmmc">
         <img class="logoo" src="../image/logo.png">
         <div class="dp">
            <h1>DEPARTMENT OF PUBLIC WORKS AND HIGHWAYS</h1>
         </div>

         <div class="qp">
            <h2>Quality Policy</h2>
            <p>We commit to provide quality, safe, and environment-friendly public infrastructure facilities that will improve the life of every Filipino.<br><br>
            We commit to comply with all requirements and to continually improve effectiveness and efficiency in serving the public.<br><br>
            We endeavour to implement the RIGHT PROJECTS at the RIGHT COST determined through transparent and competitive bidding; with the RIGHT QUALITY, according to international standards; delivered RIGHT ON TIME through close monitoring of project implementation; and carried out by the RIGHT PEOPLE who are competent and committed to uphold the values of public service integrity, professionalism, excellence, and teamwork.</p>
         </div>

         <div class="vis">
            <h2>Vision</h2>
            <p>By 2040, DPWH is an excellent government agency, enabling a comfortable lifestyle for Filipino through safe, reliable and resilient infrastructure.</p>
         </div>

         <div class="mis">
            <h2>Mission</h2>
            <p>To provide and manage quality infrastructure facilities and services responsive to the needs of the Filipino people in the pursuit of national development objectives.</p>
         </div>

         <div class="mand">
            <h2>Mandate</h2>
            <p>The Department of Public Works and Highways (DPWH) is one of the three departments of the government undertaking major infrastructure projects.<br><br>
            The DPWH is mandated to undertake (a) planning of infrastructure such as roads and bridges, flood control, water resources projects, and other public works and (b) the design, construction and maintenance of national roads and bridges and major flood control systems.</p>
         </div>

         <div class="corval">
            <h2>Core Values</h2>
            <p>• Public Service<br>• Integrity<br>• Professionalism<br>• Excellence<br>• Team Work</p>
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
   </body>
</html>