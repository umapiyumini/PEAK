<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sports Practice Schedule</title>
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/schedule.css">
</head>
<body>
  <div class="navbar">
  <a href="sportprofile">Home</a>
            <a href="sportattendance">Attendance</a>
            <a href="team">Team</a>
            <a href="coaches">Coaches</a>
            <a href="schedule">Schedule</a>
            <a href="sportrecords">Records</a>
</div>
<div class="container">
<h1>Sports Practice Schedule</h1>
<div class="schedule-actions"> 
    <div class="schedule-filter">
      <div class="filter-controls">
        <select id="filter-month">
          <option value="">All Months</option>
          <option value="01">January</option>
          <option value="02">February</option>
          <option value="03">March</option>
          <option value="04">April</option>
          <option value="05">May</option>
          <option value="06">June</option>
          <option value="07">July</option>
          <option value="08">August</option>
          <option value="09">September</option>
          <option value="10">October</option>
          <option value="11">November</option>
          <option value="12">December</option>
        </select>
        <button id="filter-upcoming" class="btn btn-sm">Upcoming</button>
        <button id="filter-all" class="btn btn-sm btn-active">All</button>
        <button id="add-schedule" class="add-button">Add New Practice</button>
      </div>
     
    </div>
</div> 
    <div class="schedule-list-container">
      <?php if(empty($schedule)): ?>
        <p class="no-records">No practice sessions scheduled yet.</p>
      <?php else: ?>
        <div class="schedule-cards">
          <?php foreach($schedule as $item): ?>
            <div class="schedule-card" data-id="<?= $item->scheduleid ?>">
              <div class="schedule-date">
                <?= date('D, M d', strtotime($item->date)) ?>
              </div>
              <div class="schedule-time">
                <?= date('h:i A', strtotime($item->start_time)) ?> - 
                <?= date('h:i A', strtotime($item->end_time)) ?>
              </div>
              <div class="schedule-category">
                <?= $item->category ?>
              </div>
              <div class="schedule-actions">
                <button class="edit-button" id="edit-button" data-id="<?= $item->id ?>" >Edit</button>
                <button class="delete-button" data-id="<?= $item->id ?>">Cancel</button>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
  
  <!-- Add Schedule Modal -->
  <div id="add-modal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h2>Add New Practice Session</h2>
        <span class="close">&times;</span>
      </div>
      <div class="modal-body">
        <form id="add-form" action="<?=ROOT?>/sportscaptain/Schedule/addschedule" method="POST">
          <div class="form-group">
            <label for="date">Practice Date:</label>
            <input type="date" id="date" name="date" required>
          </div>
          
          <div class="form-group">
            <label for="start_time">Start Time:</label>
            <input type="time" id="start_time" name="start_time" required>
          </div>
          
          <div class="form-group">
            <label for="end_time">End Time:</label>
            <input type="time" id="end_time" name="end_time" required>
          </div>

          <div class="form-group">
            <lable for="category">Category:</label>
            <select id="category" name="category" required>
              <option value="Practice">Practice</option>
              <option value="Match">Match</option>
            </select>
          </div>
          <div class="form-actions">
            <button type="submit" class="submit-button">Save Schedule</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  

  <!-- Edit Schedule Modal -->
   <div id="edit-modal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h2>Edit Practice Session</h2>
        <span class="close">&times;</span>
      </div>
      <div class="modal-body">
        <form id="edit-form" action="<?=ROOT?>/sportscaptain/Schedule/editschedule" method="POST">
          <div class="form-group">
            <lable for="edit-date">Practice Date:</label>
            <input type="date" id="edit-date" name="date" required>
          </div>
          <div class="form-group">
            <label for="edit-start_time">Start Time:</label>
            <input type="time" id="edit-start_time" name="start_time" required>
          </div>
          <div class="form-group">
            <label for="edit-end_time">End Time:</label>
            <input type="time" id="edit-end_time" name="end_time" required>
          </div>
          <div class="form-group">
            <lable for="category">Category:</label>
            <select id="edit-category" name="category" required>
              <option value="Practice">Practice</option>
              <option value="Match">Match</option>
            </select>
          </div>
          <input type="hidden" id="edit-id" name="id">
          <div class="form-actions">
            <button type="submit" class="submit-button">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Confirm Cancel Modal -->
  <div id="cancel-modal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h2>Cancel Practice Session</h2>
        <span class="close">&times;</span>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to cancel this practice session?</p>
        <div id="cancel-details">
          <p><strong>Date:</strong> <span id="cancel-date"></span></p>
          <p><strong>Time:</strong> <span id="cancel-time"></span></p>
        </div>
        <form id="cancel-form" action="<?=ROOT?>/sportscaptain/Schedule/deleteschedule" method="POST">
          <input type="hidden" id="cancel-id" name="id">
          <div class="form-actions">
            <button type="submit" class="submit-button">Confirm Cancel</button>
          </div>
        </form>
      </div>
    </div>
 </div>
 </div>

    <script src="<?=ROOT?>/assets/js/vidusha/schedule.js"></script>
   
</body>
</html>
