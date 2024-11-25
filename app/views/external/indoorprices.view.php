<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-1.0">
        <link rel="stylesheet" href="<?=ROOT?>/assets/css/uma/groundprices.css">
        <title>External User Dashboard</title>
    </head>


    <body>
        <!-- navigation bar -->
        <?php include 'enav.view.php'; ?>
        <div class="main">
        <?php include 'top.view.php'; ?>
        <div class="container1">
                <h1 class="title1">Rates for Hiring of UOC Indoor Stadium</h1>

    <!-- Search Bar -->
    <div class="search-container">
      <input
        type="text"
        id="search-bar"
        placeholder="Search for a facility..."
        onkeyup="searchFacility()"
      />
    </div>

    <!-- Rates Table -->
    <table class="rates-table" id="rates-table">
      <thead>
        <tr>
          <th>Indoor Gym</th>
          <th colspan="2">Practice (per hour)</th>
          <th colspan="4">Tournament / Sports Festivals (With Supervisor charges)</th>
        </tr>
        <tr>
          <th></th>
          <th>Working Hours</th>
          <th>Other than Working Hours</th>
          <th>Working Hours (Full Day)</th>
          <th>Working Hours (Half Day)</th>
          <th>Other than Working Hours (Full Day)</th>
          <th>Other than Working Hours (Half Day)</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Badminton (One Court - 08 Persons for practices)</td>
          <td>800.00</td>
          <td>1,100.00</td>
          <td>-</td>
          <td>-</td>
          <td>-</td>
          <td>-</td>
        </tr>
        <tr>
          <td>Badminton (Two Courts - 16 Persons for practices)</td>
          <td>1,600.00</td>
          <td>1,900.00</td>
          <td>-</td>
          <td>-</td>
          <td>-</td>
          <td>-</td>
        </tr>
        <tr>
          <td>Badminton (Four Courts - 30 Persons for practices)</td>
          <td>3,000.00</td>
          <td>3,600.00</td>
          <td>50,000.00</td>
          <td>35,000.00</td>
          <td>59,000.00</td>
          <td>41,000.00</td>
        </tr>
        <tr>
          <td>Table Tennis (Two Tables - 08 Persons for practices)</td>
          <td>900.00</td>
          <td>1,200.00</td>
          <td>-</td>
          <td>-</td>
          <td>-</td>
          <td>-</td>
        </tr>
        <tr>
          <td>Table Tennis</td>
          <td>-</td>
          <td>-</td>
          <td>50,000.00</td>
          <td>35,000.00</td>
          <td>59,000.00</td>
          <td>41,000.00</td>
        </tr>
        <tr>
          <td>Karate / Taekwondo (Without Tatami)</td>
          <td>-</td>
          <td>-</td>
          <td>50,000.00</td>
          <td>35,000.00</td>
          <td>59,000.00</td>
          <td>41,000.00</td>
        </tr>
        <tr>
          <td>Wrestling (Without Mattress)</td>
          <td>-</td>
          <td>-</td>
          <td>50,000.00</td>
          <td>35,000.00</td>
          <td>59,000.00</td>
          <td>41,000.00</td>
        </tr>
        <tr>
          <td>Volleyball (25 Persons for practices)</td>
          <td>5,000.00</td>
          <td>5,600.00</td>
          <td>-</td>
          <td>-</td>
          <td>-</td>
          <td>-</td>
        </tr>
        <tr>
          <td>Volleyball</td>
          <td>-</td>
          <td>-</td>
          <td>60,000.00</td>
          <td>40,000.00</td>
          <td>69,000.00</td>
          <td>46,000.00</td>
        </tr>
        <tr>
          <td>Student Sport Center and Surrounding Area (Sports Activities & Functions)</td>
          <td>-</td>
          <td>-</td>
          <td>30,000.00</td>
          <td>20,000.00</td>
          <td>39,000.00</td>
          <td>26,000.00</td>
        </tr>
      </tbody>
    </table>
  </div>

  <script src="../js/dashboard.js"></script>
</body>
</html>