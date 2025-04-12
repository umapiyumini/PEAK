
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sports Events</title>
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/sportrecords.css">
</head>
<body>

    <div class="container">
    <h1>Upcoming Events</h1>
    
    <div id="upcoming-events">
      <button class="add-button" onclick="showAddModal('upcoming')">Add Upcoming Tournament</button>
      <div id="event-list" class="grid">
      <?php if (!empty($data['upcomingevents'])): ?>
      <?php foreach($data['upcomingevents'] as $event): ?>
        <div class="tournament-item" data-category="upcoming" data-id="<?= $event['event_id'] ?>">
          <h3><?=$event['event_name']?></h3>
          <p><strong>Date:</strong><?=$event['date']?></p>
          <p><strong>Time:</strong> <?=$event['time']?></p>
          <p><strong>Location:</strong><?=$event['venue']?></p>
          <div class="Button">
          <button onclick="showEditModal(<?= $event['event_id'] ?>)">Edit</button>
            <button class="delete-button" onclick="showDeleteConfirmation(<?= $event['event_id'] ?>)">Delete</button>
          </div>
        </div>
        <?php endforeach; ?>
        <?php else: ?>
          <p>No upcoming events found.</p>
        <?php endif; ?>
      </div>
    </div>



  <!-- Modal for Adding Upcoming Event -->
  <div id="add-upcoming-modal" class="modal hidden">
    <div class="modal-content">
      <h2>Add Upcoming Tournament</h2>
      <form id="add-upcoming-form" action="" method="POST">
        <label for="event-name">Tournament Name:</label>
        <input type="text" id="event-name" name="event_name" required />
        
        <label for="event-category">Category:</label>
        <select id="event-category" name="category" required>
          <option value="inter-faculty">Inter Faculty</option>
          <option value="inter-uni">Inter University</option>
          <option value="freshers">Freshers</option>
        </select>
        
        <label for="event-date">Date:</label>
        <input type="date" id="event-date" name="date" required />
        
        <label for="event-time">Time:</label>
        <input type="time" id="event-time" name="time" required />
        
        <label for="event-venue">Venue:</label>
        <input type="text" id="event-venue" name="venue" required />
        
        <button type="submit">Add Event</button>
        <button type="button" onclick="closeModal()">Cancel</button>
      </form>
    </div>
  </div>

  <!-- Modal for Editing Tournament -->
  <div id="edit-modal" class="modal hidden">
    <div class="modal-content">
      <h2>Edit Tournament</h2>
      <form id="edit-form" action="" method="POST">
        <input type="hidden" id="edit-id" name="id" />
        
        <label for="edit-name">Tournament Name:</label>
        <input type="text" id="edit-name" name="tournament_name" required />
        
        <label for="edit-category">Category:</label>
        <select id="edit-category" name="category" required>
          <option value="inter-faculty">Inter Faculty</option>
          <option value="inter-uni">Inter University</option>
          <option value="freshers">Freshers</option>
        </select>
        
        <label for="edit-year">Year:</label>
        <input type="text" id="edit-year" name="year" required />
        
        <label for="edit-first">1st Place:</label>
        <input type="text" id="edit-first" name="first_place" />
        
        <label for="edit-second">2nd Place:</label>
        <input type="text" id="edit-second" name="second_place" />
        
        <label for="edit-third">3rd Place:</label>
        <input type="text" id="edit-third" name="third_place" />
        
        <label for="edit-place">Overall Place:</label>
        <input type="text" id="edit-place" name="place" />
        
        <label for="edit-venue">Venue:</label>
        <input type="text" id="edit-venue" name="venue" />
        
        <button type="submit">Update</button>
        <button type="button" onclick="closeModal()">Cancel</button>
      </form>
    </div>
  </div>

  <!-- Delete Confirmation Modal -->
  <div id="delete-modal" class="modal hidden">
    <div class="modal-content">
      <h2>Confirm Deletion</h2>
      <p>Are you sure you want to delete this tournament?</p>
      <form id="delete-form" action="" method="POST">
        <input type="hidden" id="delete-id" name="delete_id" />
        <div class="Button">
          <button type="submit" style="background-color: #dc3545; color: white;">Delete</button>
          <button type="button" onclick="closeModal()" style="background-color: #6c757d; color: white;">Cancel</button>
        </div>
      </form>
    </div>
  </div>

  <div class="modal-overlay hidden"></div>


  <script src="<?=ROOT?>/assets/js/vidusha/upcoming.js"></script>
</body>
</html>