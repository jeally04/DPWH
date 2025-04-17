<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Job Sheet Form</title>
   <link rel="stylesheet" href="../styles/navbar.css">
   <link rel="stylesheet" href="../styles/pending_form.css">
   <link rel="stylesheet" href="../styles/logoutModal.css">
   <script src="../Scripts/Nav-modal.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
   <style>
      .sub-options {
         display: none;
         margin-top: 10px;
      }

      .sub-options ul {
         list-style-type: none;
         padding-left: 0;
      }

      .sub-options ul li {
         cursor: pointer;
         padding: 5px;
         border: 1px solid #ccc;
         margin-bottom: 5px;
      }

      .sub-options ul li:hover {
         background-color: #f0f0f0;
      }
   </style>
</head>

<body>
   <div class="pending-container">
      <?php include '../Components/navbar.php'; ?>
      <div class="form-container">
         <form id="job-sheet-form" action="../process_form.php" method="POST">
            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" placeholder="Last Name, First Name, Middle Initial" required>

            <label for="section_division">Section/Division:</label>
            <input type="text" id="section_division" name="section_division" list="sectionList" placeholder="Type or select..." required>
            <datalist id="sectionList">
               <option value="Maintenance Section (MS)">
               <option value="MS - Maintenance Management Unit">
               <option value="MS - Equipment Services Unit">
               <option value="Construction Section (CS)">
               <option value="CS - Contract Management Unit">
               <option value="CS - Contract Claims Unit">
               <option value="CS - Monitoring & Evaluation Unit">
               <option value="Quality Assurance Section (QAS)">
               <option value="QAS - Quality Implementation Unit">
               <option value="QAS - Materials Testing Unit">
               <option value="Finance Section (FS)">
               <option value="FS - Accounting Unit">
               <option value="FS - Budget Unit">
               <option value="Administrative Section (ADMIN)">
               <option value="ADMIN - Human Resource Management & Development Unit">
               <option value="ADMIN - Records Management Unit">
               <option value="ADMIN - Supply & Property Unit">
               <option value="ADMIN - Cash Unit">
               <option value="ADMIN - General Services Unit">
               <option value="Planning and Design Section (PDS)">
               <option value="PDS - Planning Unit">
               <option value="PDS - Highways Design Unit">
               <option value="PDS - Bridges & Other Public Works Design Unit">
               <option value="PDS - Engineering Surveys & Investigation Unit">
               <option value="PDS - Environmental, Social & Row Unit"></option>
               <option value="Procurement Staff">
               <option value="Information & Communication Technology Staff">
               <option value="Public Information Staff">
               <option value="Support Staff">
               <option value="Office of the Assistant District Engineer">
               <option value="Office of the District Engineer">
            </datalist>

            <label for="description">Brief description of the Incident or Request:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="date_of_filing">Date of Filing:</label>
            <input type="date" id="date_of_filing" name="date_of_filing" required>

            <label for="date_received">Date Received:</label>
            <input type="datetime-local" id="date_received" name="date_received" required>

            <label for="contact_no">Contact No.:</label>
            <input type="text" id="contact_no" name="contact_no" required>

            <button type="submit">Add</button><br>
         </form>
      </div>
   </div>
   
   <div id="successModal" class="success-modal">
      <div class="success-modal-content">
         <p>Added successfully!</p>
      </div>
   </div>
   
   <script>
      document.getElementById('job-sheet-form').addEventListener('submit', function (event) {
         event.preventDefault();
         const formData = new FormData(this);
         fetch('../Functions/process_form.php', {
            method: 'POST',
            body: formData
         })
            .then(response => response.text())
            .then(data => {
               if (data === 'success') {
                  document.getElementById('job-sheet-form').reset();
                  document.getElementById('successModal').style.display = 'block';
                  setTimeout(() => {
                     document.getElementById('successModal').style.display = 'none';
                  }, 2000);
               } else {
                  alert('An error occurred. Please try again.');
               }
            })
            .catch(error => {
               console.error('Error:', error);
               alert('An error occurred. Please try again.');
            });
      });

      function padToTwoDigits(num) {
         return num.toString().padStart(2, '0');
      }

      function formatDate(date) {
         const year = date.getFullYear();
         const month = padToTwoDigits(date.getMonth() + 1);
         const day = padToTwoDigits(date.getDate());
         const hours = padToTwoDigits(date.getHours());
         const minutes = padToTwoDigits(date.getMinutes());

         return `${year}-${month}-${day}T${hours}:${minutes}`;
      }

      window.onload = function () {
         const now = new Date();
         const today = formatDate(now).split('T')[0];
         document.getElementById('date_of_filing').value = today;
         document.getElementById('date_received').value = formatDate(now);
      }
   </script>
</body>

</html>
