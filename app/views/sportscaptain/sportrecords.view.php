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
                <h3><?php echo htmlspecialchars($event->tournament_name); ?></h3>
                <p><strong>Date:</strong> <?php echo htmlspecialchars($event->year); ?></p>
                <?php if (!empty($event->first_place)): ?>
                            <p><strong>1st Place:</strong> <?php echo htmlspecialchars($event->first_place); ?></p>
                <?php endif; ?>
                <?php if (!empty($event->second_place)): ?>
                            <p><strong>2nd Place:</strong> <?php echo htmlspecialchars($event->second_place); ?></p>
                <?php endif; ?>
                <?php if (!empty($event->third_place)): ?>
                            <p><strong>3rd Place:</strong> <?php echo htmlspecialchars($event->third_place); ?></p>
                <?php endif; ?>
                <?php if (!empty($event->place)): ?>
                            <p><strong>Place:</strong> <?php echo htmlspecialchars($event->place); ?></p>
                <?php endif; ?>
                <?php if (!empty($event->venue)): ?>
                            <p><strong>venue:</strong> <?php echo htmlspecialchars($event->venue); ?></p>
                <?php endif; ?>
                <div class = "Button">

                <form method="POST" action="<?php echo ROOT; ?>/sportrecords/handleRequest">
                        <input type="hidden" name="edit_id" value="<?php echo htmlspecialchars($event->id); ?>">
                        <button type="submit">Edit</button>
                </form>

                    <button class="delete-button" onclick="showUpdateModal(<?php echo htmlspecialchars($event->id); ?>)">Delete</button>
                </div>
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
        
      <?php if(!empty($upcomingevents)):?>
        <?php foreach($upcomingevents as $event): ?>
          <div class ="event-item">
            <h3><?php echo htmlspecialchars($event->event_name); ?></h3>
            <p><strong>Date:</strong><?php echo htmlspecialchars($event->date); ?></p>
            <p><strong>Time:</strong><?php echo htmlspecialchars($event->time); ?></p>
            <p><strong>Location:</strong><?php echo htmlspecialchars($event->venue); ?></p>
      </div>
      <?php endforeach; ?>
      <?php else: ?>
        <p>No upcoming events found.</p>
      <?php endif; ?>
    </div>
  </div>

  <!-- Modal for Adding Items -->
  <div id="add-modal" class="modal hidden">
    <div class="modal-content">
      <h2>Add New Event</h2>
      <form id="add-form" action="<?=ROOT?>/sportscaptain/upcomingevent/addevent" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="event_name" required />
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required />
        <label for="time">Time:</label>
        <input type="text" id="time" name="time" required />
        <label for="location">Location:</label>
        <input type="text" id="location" name="venue" required />
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
<!-- <div id="update-modal" class="modal hidden"> -->
    <!-- <div class="modal-content"> -->
      <!-- <h2>Update Event</h2> -->
      <!-- <form id="update-form"> -->
        <!-- <label for="update-name">Name:</label> -->
        <!-- <input type="text" id="update-name" required /> -->
        <!-- <label for="update-date">Date:</label> -->
        <!-- <input type="date" id="update-date" required /> -->
        <!-- <label for="update-location">Location:</label> -->
        <!-- <input type="text" id="update-location" required /> -->
        <!-- <button type="submit">Update</button> -->
        <!-- <button type="button" onclick="closeModal()">Cancel</button> -->
      <!-- </form> -->
    <!-- </div> -->
  <!-- </div> -->
  
  <!-- Hidden Edit Modal -->
<?php if (!empty($event)): ?>
  <div id="update-modal" class="modal hidden">
  <div class="modal-content">
  <h2>Update Event</h2>
    <form id ="update-form" method="POST" action="<?php echo ROOT; ?>/sportrecords/updateEvent">
        <input type="hidden" name="id" value="<?php echo $event->id; ?>">

        <label>Tournament Name:</label>
        <input type="text" name="tournament_name" value="<?php echo $event->tournament_name; ?>" required>

        <label>Year:</label>
        <input type="text" name="year" value="<?php echo $event->year; ?>" required>

        <label>1st Place:</label>
        <input type="text" name="first_place" value="<?php echo $event->first_place; ?>">

        <label>2nd Place:</label>
        <input type="text" name="second_place" value="<?php echo $event->second_place; ?>">

        <label>3rd Place:</label>
        <input type="text" name="third_place" value="<?php echo $event->third_place; ?>">

        <label>Place:</label>
        <input type="text" name="place" value="<?php echo $event->place; ?>">

        <label>Venue:</label>
        <input type="text" name="venue" value="<?php echo $event->venue; ?>">

        <button type="submit" name="update">Update</button>
        <button type="button" onclick="hideModal()">Cancel</button>
    </form>
</div>
<?php endif; ?>
  

  <script src="<?=ROOT?>/assets/js/vidusha/records.js"></script>
</body>
</html>
