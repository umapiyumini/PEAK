<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requests</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ped_incharge/requests.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
    <?php $current_page = 'reservation'; include 'sidebar.view.php'?>


    <div class="main-content">
        <div class="header">
            <button onclick="history.back()" class="goBackButton"><i class="uil uil-arrow-left"></i></button>
            <h1>Indoor Reservation Requests</h1>
            <button class="bell-icon"><i class="uil uil-bell"></i></button>
            <div class="notifications-dropdown">
                <div class="notifications-header">
                    <h3>Notifications</h3>
                    <span class="clear-all">Clear All</span>
                </div>
                <div class="notifications-list">
                    <ul id="notificationsList"></ul>
                </div>
            </div>
            
            <button class="bell-icon"><i class="uil uil-signout"></i></button>
        </div>

        <main>

 <main>
  <div id="board" class="board">
    
    <!-- New Column -->
    <div class="column new" id="newColumn">
      <h2><span class="dot new"></span> New <span class="count"></span></h2>
      <?php if(!empty($newPendingReservations)): ?>
        <?php foreach($newPendingReservations as $i): ?>
          <div class="card sports" onclick="viewCard(this)" data-id="<?= $i->reservationid ?>" data-courtname="<?= $i->courtname ?>" data-location="<?= $i->location ?>" data-event="<?= $i->event ?>" data-date="<?= $i->date ?>" data-time="<?= $i->time ?>" data-numberof_participants="<?= $i->numberof_participants ?>" data-extradetails="<?= $i->extradetails ?>" data-userdescription="<?= $i->userdescription ?>" data-userproof="<?= $i->userproof ?>" data-name="<?= $i->name ?>" data-contact_number="<?= $i->contact_number ?>" data-email="<?= $i->email ?>" data-cardtype="new" data-has_conflict="<?= $i->has_conflict ? '1' : '0' ?> "data-duration="<?= $i->duration?>>
            <p class="facility"><?= $i->courtname ?></p>
            <p class="facility"><?= $i->location ?></p>
            <p class="reservation-id">ID: <?= $i->reservationid ?></p>
            <p class="event"><?= $i->event ?></p>
            <p class="date"><?= $i->date ?></p>
            <?php
              $durationMap = [
                  '1 hour' => '1 Hours',
                  'full' => 'Full day',
                  'half' => 'Half day'
              ];
              $displayDuration = $durationMap[$i->duration] ?? ucfirst($i->duration);
              ?>

            <p class="time"><?= $displayDuration ?></p>

          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p style="padding: 10px;">No New pending requests.</p>
      <?php endif; ?>
    </div>

    <!-- Awaiting Column -->
    <div class="column awaiting" id="awaitingColumn" onmouseup="dropCard('awaitingColumn')">
      <h2><span class="dot awaiting"></span> Awaiting <span class="count"></span></h2>
      <?php if(!empty($oldPendingReservations)): ?>
        <?php foreach($oldPendingReservations as $i): ?>
          <div class="card sports" onclick="viewCard(this)" data-id="<?= $i->reservationid ?>" data-courtname="<?= $i->courtname ?>" data-location="<?= $i->location ?>" data-event="<?= $i->event ?>" data-date="<?= $i->date ?>" data-time="<?= $i->time ?>" data-numberof_participants="<?= $i->numberof_participants ?>" data-extradetails="<?= $i->extradetails ?>" data-userdescription="<?= $i->userdescription ?>" data-userproof="<?= $i->userproof ?>" data-name="<?= $i->name ?>" data-contact_number="<?= $i->contact_number ?>" data-email="<?= $i->email ?>" data-cardtype="awaiting" data-has_conflict="<?= $i->has_conflict ? '1' : '0' ?>" data-duration="<?= $i->duration?>">
            <p class="facility"><?= $i->courtname ?></p>
            <p class="facility"><?= $i->location ?></p>
            <p class="reservation-id">ID: <?= $i->reservationid ?></p>
            <p class="event"><?= $i->event ?></p>
            <p class="date"><?= $i->date ?></p>
            <p class="time"><?= $i->time ?></p>
                <?php
                  $durationMap = [
                      '1 hour' => '1 Hours',
                      'full' => 'Full day',
                      'half' => 'Half day'
                  ];
                  $displayDuration = $durationMap[$i->duration] ?? ucfirst($i->duration);
                  ?>

            <p class="time"><?= $displayDuration ?></p>

          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p style="padding: 10px;">No pending requests.</p>
      <?php endif; ?>
    </div>

    <!-- Topay -->
    <div class="column topay" id="topayColumn" onmouseup="dropCard('acceptedColumn')">
      <h2><span class="dot done"></span> To Pay <span class="count"></span></h2>
      <?php if(!empty($topayReservations)): ?>
        <?php foreach($topayReservations as $i): ?>
          <div class="card sports" onclick="viewCard(this)" data-id="<?= $i->reservationid ?>" data-courtname="<?= $i->courtname ?>" data-location="<?= $i->location ?>" data-event="<?= $i->event ?>" data-date="<?= $i->date ?>" data-time="<?= $i->time ?>" data-numberof_participants="<?= $i->numberof_participants ?>" data-extradetails="<?= $i->extradetails ?>" data-userdescription="<?= $i->userdescription ?>" data-userproof="<?= $i->userproof ?>" data-name="<?= $i->name ?>" data-contact_number="<?= $i->contact_number ?>" data-email="<?= $i->email ?>" data-cardtype="topay" data-duration="<?= $i->duration?>">
            <p class="facility"><?= $i->courtname ?></p>
            <p class="facility"><?= $i->location ?></p>
            <p class="reservation-id">ID: <?= $i->reservationid ?></p>
            <p class="event"><?= $i->event ?></p>
            <p class="date"><?= $i->date ?></p>
            <p class="time"><?= $i->time ?></p>
            <?php
                  $durationMap = [
                      '1 hour' => '1 Hours',
                      'full' => 'Full day',
                      'half' => 'Half day'
                  ];
                  $displayDuration = $durationMap[$i->duration] ?? ucfirst($i->duration);
                  ?>

            <p class="time"><?= $displayDuration ?></p>

          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p style="padding: 10px;">No To-pay requests.</p>
      <?php endif; ?>
    </div>

    <!-- Paid -->
    <div class="column paid" id="acceptedColumn" onmouseup="dropCard('acceptedColumn')">
      <h2><span class="dot done"></span> Paid <span class="count"></span></h2>
      <?php if(!empty($paidReservations)): ?>
        <?php foreach($paidReservations as $i): ?>
          <div class="card sports" onclick="viewCard(this)" data-id="<?= $i->reservationid ?>" data-courtname="<?= $i->courtname ?>" data-location="<?= $i->location ?>" data-event="<?= $i->event ?>" data-date="<?= $i->date ?>" data-time="<?= $i->time ?>" data-numberof_participants="<?= $i->numberof_participants ?>" data-extradetails="<?= $i->extradetails ?>" data-userdescription="<?= $i->userdescription ?>" data-payment_proof="<?= $i->payment_proof ?>" data-name="<?= $i->name ?>" data-contact_number="<?= $i->contact_number ?>" data-email="<?= $i->email ?>" data-cardtype="paid" data-duration="<?= $i->duration?>">
            <p class="facility"><?= $i->courtname ?></p>
            <p class="facility"><?= $i->location ?></p>
            <p class="reservation-id">ID: <?= $i->reservationid ?></p>
            <p class="event"><?= $i->event ?></p>
            <p class="date"><?= $i->date ?></p>
            <p class="time"><?= $i->time ?></p>
            <?php
                  $durationMap = [
                      '1 hour' => '1 Hours',
                      'full' => 'Full day',
                      'half' => 'Half day'
                  ];
                  $displayDuration = $durationMap[$i->duration] ?? ucfirst($i->duration);
                  ?>

            <p class="time"><?= $displayDuration ?></p>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p style="padding: 10px;">No Paid Reservations.</p>
      <?php endif; ?>
    </div>

    <!-- Accepted Column -->
    <div class="column done" id="acceptedColumn" onmouseup="dropCard('acceptedColumn')">
      <h2><span class="dot done"></span> confirmed <span class="count"></span></h2>
      <?php if(!empty($confirmedReservations)): ?>
        <?php foreach($confirmedReservations as $i): ?>
          <div class="card sports" onclick="viewCard(this)" data-id="<?= $i->reservationid ?>" data-courtname="<?= $i->courtname ?>" data-location="<?= $i->location ?>" data-event="<?= $i->event ?>" data-date="<?= $i->date ?>" data-time="<?= $i->time ?>" data-numberof_participants="<?= $i->numberof_participants ?>" data-extradetails="<?= $i->extradetails ?>" data-userdescription="<?= $i->userdescription ?>" data-payment_proof="<?= $i->payment_proof ?>" data-name="<?= $i->name ?>" data-contact_number="<?= $i->contact_number ?>" data-email="<?= $i->email ?>" data-cardtype="confirmed" data-duration="<?= $i->duration?>">
            <p class="facility"><?= $i->courtname ?></p>
            <p class="facility"><?= $i->location ?></p>
            <p class="reservation-id">ID: <?= $i->reservationid ?></p>
            <p class="event"><?= $i->event ?></p>
            <p class="date"><?= $i->date ?></p>
            <p class="time"><?= $i->time ?></p>
            <?php
                  $durationMap = [
                      '1 hour' => '1 Hours',
                      'full' => 'Full day',
                      'half' => 'Half day'
                  ];
                  $displayDuration = $durationMap[$i->duration] ?? ucfirst($i->duration);
                  ?>

            <p class="time"><?= $displayDuration ?></p>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p style="padding: 10px;">No Paid Reservations.</p>
      <?php endif; ?>
    </div>

    <!-- Cancelled Column -->
    <div class="column cancelled" id="cancelledColumn" onmouseup="dropCard('cancelledColumn')">
      <h2><span class="dot cancelled"></span> Cancelled <span class="count"></span></h2>
      <?php if(!empty($cancelledReservation)): ?>
        <?php foreach($cancelledReservation as $i): ?>
          <div class="card sports" onclick="viewCard(this)" data-id="<?= $i->reservationid ?>" data-courtname="<?= $i->courtname ?>" data-location="<?= $i->location ?>" data-event="<?= $i->event ?>" data-date="<?= $i->date ?>" data-time="<?= $i->time ?>" data-numberof_participants="<?= $i->numberof_participants ?>" data-extradetails="<?= $i->extradetails ?>" data-userdescription="<?= $i->userdescription ?>" data-payment_proof="<?= $i->payment_proof ?>" data-name="<?= $i->name ?>" data-contact_number="<?= $i->contact_number ?>" data-email="<?= $i->email ?>" data-cardtype="confirmed" data-duration="<?= $i->duration?>">
            <p class="facility"><?= $i->courtname ?></p>
            <p class="facility"><?= $i->location ?></p>
            <p class="reservation-id">ID: <?= $i->reservationid ?></p>
            <p class="event"><?= $i->event ?></p>
            <p class="date"><?= $i->date ?></p>
            <p class="time"><?= $i->time ?></p>
            <?php
                  $durationMap = [
                      '1 hour' => '1 Hours',
                      'full' => 'Full day',
                      'half' => 'Half day'
                  ];
                  $displayDuration = $durationMap[$i->duration] ?? ucfirst($i->duration);
                  ?>

            <p class="time"><?= $displayDuration ?></p>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p style="padding: 10px;">No Paid Reservations.</p>
      <?php endif; ?>
    </div>

    <!-- Rejected Column -->
    <div class="column rejected" id="rejectedColumn" onmouseup="dropCard('rejectedColumn')">
      <h2><span class="dot rejected"></span> Rejected <span class="count"></span></h2>
      <?php if(!empty($rejectedReservations)): ?>
        <?php foreach($rejectedReservations as $i): ?>
          <div class="card sports" onclick="viewCard(this)" data-id="<?= $i->reservationid ?>" data-courtname="<?= $i->courtname ?>" data-location="<?= $i->location ?>" data-event="<?= $i->event ?>" data-date="<?= $i->date ?>" data-time="<?= $i->time ?>" data-numberof_participants="<?= $i->numberof_participants ?>" data-extradetails="<?= $i->extradetails ?>" data-userdescription="<?= $i->userdescription ?>" data-payment_proof="<?= $i->payment_proof ?>" data-name="<?= $i->name ?>" data-contact_number="<?= $i->contact_number ?>" data-email="<?= $i->email ?>" data-cardtype="rejected" data-duration="<?= $i->duration?>">
            <p class="facility"><?= $i->courtname ?></p>
            <p class="facility"><?= $i->location ?></p>
            <p class="reservation-id">ID: <?= $i->reservationid ?></p>
            <p class="event"><?= $i->event ?></p>
            <p class="date"><?= $i->date ?></p>
            <p class="time"><?= $i->time ?></p>
            <?php
                  $durationMap = [
                      '1 hour' => '1 Hours',
                      'full' => 'Full day',
                      'half' => 'Half day'
                  ];
                  $displayDuration = $durationMap[$i->duration] ?? ucfirst($i->duration);
                  ?>

            <p class="time"><?= $displayDuration ?></p>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p style="padding: 10px;">No Paid Reservations.</p>
      <?php endif; ?>
    </div>

  </div>
</main>
</div>


   
    <!-- reservation details modal -->
<div id="actionModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <div class="modal-header">
            <h2>Reservation Details</h2>
        </div>
        <div class="modal-body">
            <div class="details-grid">
                <div class="basic-info">
                    <h3>Basic Information</h3>
                    <div id="requestInfo">
                    <div class="info-row">
                            <label>Court:</label>
                            <span id="court"></span>
                        </div>
                        <div class="info-row">
                            <label>Location:</label>
                            <span id="location"></span>
                        </div>
                        <div class="info-row">
                            <label>Reservation ID:</label>
                            <span id="reservationID"></span>
                        </div>
                        <div class="info-row">
                            <label>Event:</label>
                            <span id="event"></span>
                        </div>
                        <div class="info-row">
                            <label>Date:</label>
                            <span id="date"><span>
                        </div>
                        <div class="info-row">
                            <label>Time:</label>
                            <span id="time"><span>
                        </div>
                        <div class="info-row">
                            <label>Duration:</label>
                            <span id="duration"><span>
                        </div>
                    </div>
                </div>
                <div class="additional-info">
                    <h3>Additional Information</h3>
                    <div id="additionalInfo">
                        <div class="info-row">
                            <label>Company:</label>
                            <span id="company"></span>
                        </div>
                    <div id="additionalInfo">
                        <div class="info-row">
                            <label>Contact Person:</label>
                            <span id="contactPerson"></span>
                        </div>
                        <div class="info-row">
                            <label>Phone:</label>
                            <span id="phone"></span>
                        </div>
                        <div class="info-row">
                            <label>Email:</label>
                            <span id="email"></span>
                        </div>
                        <div class="info-row">
                            <label>Number of Participants:</label>
                            <span id="participants"></span>
                        </div>
                        <div class="info-row">
                            <label>Special Requirements:</label>
                            <span id="requirements"></span>
                        </div>
                        <div class="info-row">
                            <label>Proof:</label>
                            <span><a href="<?=LINKROOT?>/" id="proof">Click To View</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="conflictWarning" style="display: none; color: red; font-weight: bold; text-align: center; margin-bottom: 10px;">
            ⚠️ This reservation conflicts with an already accepted one.
        </div>

        <div id="modalActions" class="modal-footer">     
          <button class="accept-btn" onclick="acceptRequestIndoor()" id="acceptbtn">Accept</button>
          <button class="reject-btn" onclick="rejectRequestIndoor()">Reject</button>
        </div>
    </div>


  

    <script src="<?=ROOT?>/assets/js/ped_incharge/requests.js"></script>
    <script src="<?=ROOT?>/assets/js/ped_incharge/navbar.js"></script>

</body>
</html>
