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
      <input type="text" id="search-bar" placeholder="Search for a facility..." onkeyup="searchFacility()"/>
    </div>

    <!-- Rates Table -->
    <table class="rates-table" id="rates-table">
  <thead>
    <tr>
      <th>Court</th>
      <th>Image</th>
      <th>Event</th>
      <th>Duration</th>
      <th>Price</th>
    </tr>
  </thead>
  <tbody>
    <?php if (!empty($prices)): ?>
      <?php foreach ($prices as $row): ?>
        <tr>
          <td><?= htmlspecialchars($row->court_name) ?></td>
          <td>
            <?php if (!empty($row->court_image)): ?>
              <img src="<?= htmlspecialchars($row->court_image) ?>" alt="<?= htmlspecialchars($row->court_name) ?>" width="80">
            <?php endif; ?>
          </td>
          <td><?= htmlspecialchars($row->event) ?></td>
          <td><?= htmlspecialchars($row->duration) ?></td>
          <td><?= number_format($row->price, 2) ?></td>
        </tr>
      <?php endforeach; ?>
    <?php else: ?>
      <tr>
        <td colspan="5">No data available.</td>
      </tr>
    <?php endif; ?>
  </tbody>
</table>

  </div>

  
</body>
</html>