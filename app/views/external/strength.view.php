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
                <h1 class="title1">CHARGES OF THE STRENGTH HALL</h1>
    <h2 class="subtitle">University of Colombo <br> (For limited outsiders)</h2>

    <!-- Rates Table -->
    <table class="rates-table">
      <thead>
        <tr>
          <th>Time Duration</th>
          <th colspan="3">Charges (Rs.)</th>
        </tr>
        <tr>
          <th></th>
          <th>Annually</th>
          <th>6 months</th>
          <th>3 months</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Monday (7:00 a.m. - 9:00 a.m.)</td>
          <td rowspan="4">60,000.00</td>
          <td rowspan="4">35,000.00</td>
          <td rowspan="4">20,000.00</td>
        </tr>
        <tr>
          <td>Wednesday (6:00 a.m. - 8:00 a.m.)</td>
        </tr>
        <tr>
          <td>Saturday (7:00 a.m. - 6:00 p.m.)</td>
        </tr>
        <tr>
          <td>Sunday (6:00 a.m. - 12:00 noon)</td>
        </tr>
      </tbody>
    </table>
  </div>
</body>
</html>