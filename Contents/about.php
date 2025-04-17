<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <link rel="stylesheet" href="../styles/about.css">
      <link rel="stylesheet" href="../styles/logoutModal.css">
      <script src="../Scripts/Nav-modal.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
   </head>
   <body>
   <div class="about-container">
   <?php include '../Components/navbar.php'; ?>
      <div class="qpvmmc">
         <img class="logoo" src="../image/logo.png">
         <div class="qp">
            <div class="dp"><h1>DEPARTMENT OF PUBLIC WORKS AND HIGHWAYS</h1></div><br><br><br><br>
            <h2>QUALITY POLICY<p>We commit to provide quality, safe, and environmrnt-friendly public infrastructure facilities that will improve the life of every Filipino.<br>
            <br>We commit to comply with all requirements and to continually improve effectiveness and efficiency in serving the public. <br>
            <br> We endeavour to implement the RIGHT PROJECTS at the RIGHT COST determined through transparent and competitive bidding; withe the RIGHT QUALITY, according to international standards; delivered RIGHT ON TIME through close monitoring of project implementation; and carried out by the RIGHT PEOPLE who are competent and committed to uphold the values of public service integrity, professionalism, excellence, and teamwork.</p></h2>
         </div><br><br>

         <div class="vis">
            <h2>VISION<p>By 2040, DPWH is an excellent government agency, enabling a comfortable lifestyle for Filipino through safe, reliable and resilient infrastructure.</p></h2>
         </div><br><br>

         <div class="mis">
            <h2>MISSION<p>To provide and manage quality infrastructure facilities and services responsive to the needs of the Filipino people in the pursuit of national development objectives.</p></h2>
         </div><br><br>

         <div class="mand">
            <h2>MANDATE<p>The Department of Public Works and Highways (DPWH) is one of the three departments of the government under-taking major infrastructure projects.<br><br>
            The DPWH is mandated to undertake (a) planning of infrastructure such us roads and bridges, flood control, water resources projects, and other public works and (b) the design, construction and maintenance of national roads and bridges and major flood control systems.</p></h2>
         </div><br><br>

         <div class="corval">
            <h2>CORE VALUES<p>• Public Service<br>• Integrity<br>• Professionalism<br>• Excellence<br>• Team Work</p></h2>
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