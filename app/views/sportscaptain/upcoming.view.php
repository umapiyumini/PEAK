
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
    <?php if (!empty($data['upcomingEvents'])): ?>
      <?php foreach($data['upcomingEvents'] as $event): ?>
        <div class="tournament-item" data-id="<?= $event->id?>">
          <h3><?= $event->event_name?> </h3>
          <p><strong>Date:</strong><?= $event->date?></p>
          <p><strong>Time:</strong><?= $event->time?></p>
          <p><strong>Location:</strong><?= $event->venue?></p>
          <div class="Button">
          <button onclick="showEditModal(<?= $event->id?>)">Edit</button>
            <button class="delete-button" onclick="showDeleteConfirmation(<?= $event->id ?>)">Delete</button>
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
      <form id="add-upcoming-form" action="<?=ROOT?>/sportscaptain/upcoming/addevent" method="POST">
        <label for="event-name">Tournament Name:</label>
        <input type="text" id="event-name" name="event_name" required />
        
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
      <form id="edit-form" action="<?=ROOT?>/sportscaptain/upcoming/editevent" method="POST">
        <input type="hidden" id="edit-id" name="id" />
        
        <label for="edit-name">Event Name:</label>
        <input type="text" id="edit-name" name="event_name" required />
        
        <label for="edit-date">Date:</label>
        <input type="date" id="edit-date" name="date" required />
        
        <label for="edit-time">Time:</label>
        <input type="time" id="edit-time" name="time" required />
        
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
      <form id="delete-form" action="<?=ROOT?>/sportscaptain/upcoming/deleteevent" method="POST">
        <input type="hidden" id="delete-id" name="id" />
        <div class="Button">
          <button type="submit" style="background-color: #dc3545; color: white;">Delete</button>
          <button type="button" onclick="closeModal()" style="background-color: #6c757d; color: white;">Cancel</button>
        </div>
      </form>
    </div>
  </div>

  <div class="modal-overlay hidden"></div>
</div>

  <script src="<?=ROOT?>/assets/js/vidusha/upcoming.js"></script>
</body>
</html>