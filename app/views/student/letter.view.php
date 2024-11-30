<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/amar/letter.css">

  <title>Excuse Letter</title>
  

</head>
<body>

<?php<?php 
include 'nav.view.php';
?>


 
    
    <div class="dropdown-menu" id="dropdownMenu">
        <!-- <ul>
            <li><a href="#"><i class="uil uil-user"></i> My Profile</a></li>
            <li><a href="#"><i class="uil uil-signout"></i> Log out</a></li>
        </ul> -->
    </div>
</header>
    <main class="main-content">
     
      <h2>Excuse letter status</h2>
      <table class="status-table">
        <thead>
          <tr>
            <th>Class</th>
            <th>Date</th>
            <th>Excuse status</th>
            <th>Excuse reason</th>
            <th>Download</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Injury</td>
            <td>04/11/2023</td>
            <td><span class="status pending">Pending</span></td>
            <td>Doctor's note</td>
            <td><a href="#">Download</a></td>
          </tr>
          <tr>
            <td>Exams</td>
            <td>04/09/2023</td>
            <td><span class="status approved">Approved</span></td>
            <td>Family emergency</td>
            <td><a href="#">Download</a></td>
          </tr>
        </tbody>
      </table>

      <button class="submit-button">Submit a new excuse letter</button>
    </main>
  </div>
</body>
</html>
