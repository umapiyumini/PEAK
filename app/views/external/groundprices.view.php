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
                <h1 class="title1">Rates for Hiring of UOC Ground</h1>
            
                <!-- Search Bar -->
                <div class="search-container">
                  <input type="text" id="search-bar" placeholder="Search for a facility..." onkeyup="searchFacility()"/>
                </div>
            
                <!-- Rates Table -->
                <table class="rates-table" id="rates-table">
                    <thead>
                      <tr>
                        <th>Court Name</th>
                        <th>Image</th>
                        <th>Event</th>
                        <th>Duration</th>
                        <th>Description</th>
                        <th>Price (Rs.)</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($rates as $rate): ?>
                        <tr>
                          <td><?= htmlspecialchars($rate->courtname) ?></td>
                          <td>
                            <?php if ($rate->courtimage): ?>
                              <img src="<?= htmlspecialchars($rate->courtimage) ?>" alt="<?= htmlspecialchars($rate->courtname) ?>" style="width:80px; height:auto;">
                            <?php else: ?>
                              <span>No Image</span>
                            <?php endif; ?>
                          </td>
                          <td><?= htmlspecialchars($rate->event) ?></td>
                          <td><?= htmlspecialchars($rate->duration) ?></td>
                          <td><?= htmlspecialchars($rate->description) ?></td>
                          <td><?= number_format($rate->price, 2) ?></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>

            
                </div>
              </div>
                            
    </body>
</html>