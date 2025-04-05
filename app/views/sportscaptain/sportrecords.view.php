<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sports Events</title>
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/sportrecords.css">
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
    <h1>Sports Events</h1>
    <div class="tabs">
      <button class="tab-button active" data-tab="played-tournaments">Played Tournaments</button>
      <button class="tab-button" data-tab="upcoming-events">Upcoming Tournaments</button>
    </div>
    <div id="played-tournaments" class="tab-content active">
      <h2>Played Tournaments</h2>
      <div id="tournament-list" class="grid">
        <!-- Played tournaments will load dynamically -->
        <?php if (!empty($pastEvents)): ?>
        <?php foreach ($pastEvents as $event): ?>
            <div class="tournament-item">
                <h3><?php echo htmlspecialchars($event['tournament_name']); ?></h3>
                <p><strong>Date:</strong> <?php echo htmlspecialchars($event['year']); ?></p>
                <p><strong>Location:</strong> <?php echo htmlspecialchars($event['place']); ?></p>
                <!--p><strong>Number of Players:</strong> <?php echo htmlspecialchars($event['no_of_players']); ?></p-->
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No past tournaments found.</p>
    <?php endif; ?> 

      </div>
    </div>
    <div id="upcoming-events" class="tab-content">
      <h2>Upcoming Events</h2>
      <button class="add-button" onclick="showAddModal('upcoming')">Add Upcoming Tournaments</button>
      <div id="event-list" class="grid">
        <!-- Upcoming events will load dynamically -->
      </div>
    </div>
  </div>

  <!-- Modal for Adding Items -->
  <div id="add-modal" class="modal hidden">
    <div class="modal-content">
      <h2>Add New Event</h2>
      <form id="add-form">
        <label for="name">Name:</label>
        <input type="text" id="name" required />
        <label for="date">Date:</label>
        <input type="date" id="date" required />
        <label for="location">Location:</label>
        <input type="text" id="location" required />
        <button type="submit">Add</button>
        <button type="button" onclick="closeModal()">Cancel</button>
      </form>
    </div>
  </div>

  <!-- Modal for Viewing Details -->
  <div id="view-modal" class="modal hidden">
    <div class="modal-content">
      <h2 id="view-name"></h2>
      <p id="view-date"></p>
      <p id="view-location"></p>
      <p id="view-status"></p>
      <button onclick="closeModal()">Close</button>
    </div>
  </div>

  <!-- Modal for Updating Items -->
<div id="update-modal" class="modal hidden">
    <div class="modal-content">
      <h2>Update Event</h2>
      <form id="update-form">
        <label for="update-name">Name:</label>
        <input type="text" id="update-name" required />
        <label for="update-date">Date:</label>
        <input type="date" id="update-date" required />
        <label for="update-location">Location:</label>
        <input type="text" id="update-location" required />
        <button type="submit">Update</button>
        <button type="button" onclick="closeModal()">Cancel</button>
      </form>
    </div>
  </div>
  
  

  <script src="<?=ROOT?>/assets/js/vidusha/records.js"></script>
</body>
</html>
