<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Hostel Form Details</title>
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/hostal.css" />
</head>
<body>
  <div class="navbar">
    <a href="excuse">Attendance Excuse Letter</a>
    <a href="hostal">Hostel Facilities</a>
    <a href="transport">Transport</a>
    <a href="colorsnight">Colors Night</a>
  </div>

  <div class="container" id="hostelForm">
    <h1>Requesting Hostel Facilities</h1>
    <form id="form" action="<?=ROOT?>/sportscaptain/hostal/insertrequest" method="POST">
      
    <div class="form-group">
    <label for="regNo">Registration Numbers and Priority:</label>
    <div id="playerContainer">
        <div class="player-entry">
            <input type="text" class="regNo" name="reg_no[]" placeholder="Enter Registration No" required> 
            <select class="priority" name="priority[]" required>
                <option value="">Select Priority</option>
                <option value="High">High</option>
                <option value="Medium">Medium</option>
                <option value="Low">Low</option>
            </select>
        </div>
    </div>
    <button type="button" class="addRegNoBtn">Add</button>
</div>


      <div class="form-group">
        <label for="startdate">Start Date:</label>
        <input type="date" name="start_date" id="startdate" required>
      </div>

      <div class="form-group">
        <label for="enddate">End Date:</label>
        <input type="date" name="end_date" id="end_date" required>
      </div>

      <button type="submit" class="submit-btn">Submit</button>
    </form>
  </div>

  <div class="container table-container">
    <h2>Submitted Details</h2>
    <?php if(isset($data['hostal']) && is_array($data['hostal']) && !empty($data['hostal'])): ?>
    <table id="detailsTable">
      <thead>
        <tr>
          <th>Registration No</th>
          <th>Start Date</th>
          <th>End Date</th>
          <th>Priority</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($data['hostal'] as $record): ?>
        <tr>
          <td><?= htmlspecialchars($record->reg_no ?? '') ?></td>
          <td><?= htmlspecialchars($record->start_date ?? '') ?></td>
          <td><?= htmlspecialchars($record->end_date ?? '') ?></td>
          <td><?= htmlspecialchars($record->priority ?? '') ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php else: ?>
    <p>No details found.</p>
    <?php endif; ?>
  </div>

  <script src="<?=ROOT?>/assets/js/vidusha/hostal.js"></script>
</body>
</html>
