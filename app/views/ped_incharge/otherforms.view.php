<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Other Forms</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ped_incharge/otherforms.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
    <?php $current_page = 'otherforms'; include 'sidebar.view.php'?>

    <?php
        if (isset($_SESSION['error'])) {
            echo "<div id='error-message' style='position: fixed ;top: 20px; right: 20px;background-color:rgb(206, 29, 29);color: white; padding: 15px 20px; border-radius: 5px; z-index: 9999; box-shadow: 0 2px 10px rgba(0,0,0,0.2); transition: opacity 0.5s ease-out;'>"
                . htmlspecialchars($_SESSION['error']) . "</div>";
            unset($_SESSION['error']);
        }

        if (isset($_SESSION['success'])) {
            echo "<div id='success-message' style='position: fixed ;top: 20px; right: 20px;background-color:rgb(57, 184, 11);color: white; padding: 15px 20px; border-radius: 5px; z-index: 9999; box-shadow: 0 2px 10px rgba(0,0,0,0.2); transition: opacity 0.5s ease-out;'>"
                . htmlspecialchars($_SESSION['success']) . "</div>";
            unset($_SESSION['success']);
        }
    ?>
    
    <div class="main-content">
        <div class="header">
            <h1>Other Forms</h1>
            <button class="bell-icon"><i class="uil uil-bell"></i></button>
            <button class="bell-icon"><i class="uil uil-signout"></i></button>
        </div>
        <main>
            <div class="container">
                <div class="tabs">
                    <button class="tab active" onclick="showSection('colors-night')">Colors Night</button>
                    <button class="tab" onclick="showSection('certificates')">Certificates Requests</button>
                    <button class="tab" onclick="showSection('medical')">Medical Requests</button>
                    <button class="tab" onclick="showSection('transport')">Transport Requests</button>
                    <button class="tab" onclick="showSection('hostel')">Hostel Facilities Requests</button>
                </div>

                <!-- colors night -->
                <div id="colors-night" class="form-section active">
                    <h2>Colors Night Requests</h2>
                    
                    <!-- requests table -->
                    <table class="request-table">
                        <thead>
                            <tr>
                                <th>Request ID</th>
                                <th>Sport</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th><!-- Actions --></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Sample row - duplicate and modify as needed -->
                            <tr>
                                <td>REQ001</td>
                                <td>Hockey</td>
                                <td>2024-11-29</td>
                                <td><span class="status-badge status-pending">Pending</span></td>
                                <td>
                                    <button class="action-btn view-btn" onclick="openModal('REQ001', 'colors-night')">View</button>
                                    <!-- <button class="action-btn approve-btn">Approve</button> -->
                                    <!-- <button class="action-btn reject-btn">Reject</button> -->
                                </td>
                            </tr>
                            <tr>
                                <td>REQ002</td>
                                <td>Baseball</td>
                                <td>2024-11-29</td>
                                <td><span class="status-badge status-approved">Approved</span></td>
                                <td>
                                    <button class="action-btn view-btn" onclick="openModal('REQ001', 'colors-night')">View</button>
                                    <!-- <button class="action-btn approve-btn">Approve</button> -->
                                    <!-- <button class="action-btn reject-btn">Reject</button> -->
                                </td>
                            </tr>
                            <tr>
                                <td>REQ003</td>
                                <td>Swimmming</td>
                                <td>2024-11-29</td>
                                <td><span class="status-badge status-rejected">Rejected</span></td>
                                <td>
                                    <button class="action-btn view-btn" onclick="openModal('REQ001', 'colors-night')">View</button>
                                    <!-- <button class="action-btn approve-btn">Approve</button> -->
                                    <!-- <button class="action-btn reject-btn">Reject</button> -->
                                </td>
                            </tr>
                            <tr>
                                <td>REQ004</td>
                                <td>Cricket</td>
                                <td>2024-11-29</td>
                                <td><span class="status-badge status-pending">Pending</span></td>
                                <td>
                                    <button class="action-btn view-btn" onclick="openModal('REQ001', 'colors-night')">View</button>
                                    <!-- <button class="action-btn approve-btn">Approve</button> -->
                                    <!-- <button class="action-btn reject-btn">Reject</button> -->
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- modal for viewing request -->
                    <div id="colors-nightModal" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeModal('colors-nightModal')">&times;</span>
                            <h2>Colors Night Request Details</h2>
                            <div class="form-details">
                                <div class="request-info">
                                    <p><strong>Request ID:</strong> <span id="requestId"></span></p>
                                    <p><strong>Student Name:</strong> <span id="studentName"></span></p>
                                    <p><strong>Student ID:</strong> <span id="studentId"></span></p>
                                    <p><strong>Sport:</strong> <span id="sport"></span></p>
                                    <p><strong>Year:</strong> <span id="year"></span></p>
                                </div>

                                <div class="nominations-section">
                                    <h3>Colors Nominations</h3>
                                    <table class="nominations-table">
                                        <thead>
                                            <tr>
                                                <th>Student Name</th>
                                                <th>Student ID</th>
                                                <th>Achievement</th>
                                                <th>Qualification Met</th>
                                            </tr>
                                        </thead>
                                        <tbody id="colorsTableBody">
                                            <!-- Will be populated dynamically -->
                                        </tbody>
                                    </table>

                                    <h3>Merit Awards Nominations</h3>
                                    <table class="nominations-table">
                                        <thead>
                                            <tr>
                                                <th>Student Name</th>
                                                <th>Student ID</th>
                                                <th>Achievement</th>
                                                <th>Qualification Met</th>
                                            </tr>
                                        </thead>
                                        <tbody id="meritsTableBody">
                                            <!-- Will be populated dynamically -->
                                        </tbody>
                                    </table>

                                    <h3>Special Awards Nominations</h3>
                                    <table class="nominations-table">
                                        <thead>
                                            <tr>
                                                <th>Student Name</th>
                                                <th>Student ID</th>
                                                <th>Award Category</th>
                                                <th>Qualification Met</th>
                                            </tr>
                                        </thead>
                                        <tbody id="specialAwardsTableBody">
                                            <!-- Will be populated dynamically -->
                                        </tbody>
                                    </table>
                                </div>

                                <div class="modal-actions">
                                    <button class="action-btn approve-btn">Approve Request</button>
                                    <button class="action-btn reject-btn">Reject Request</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="certificates" class="form-section">
                    <h2>Certificates Requests</h2>
                    
                    <!-- requests table -->
                    <table class="request-table">
                        <thead>
                            <tr>
                                <th>Request ID</th>
                                <th>Student Name</th>
                                <th>Registration No</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if(!empty($allcertificates)): ?>
                            <?php foreach($allcertificates as $i): ?>
                                <tr>
                                    <td><?= $i->RequestID ?></td>
                                    <td><?= $i->name ?></td>
                                    <td><?= $i->RegistrationNumber ?></td>
                                    <td><span class="status-badge status-pending"><?= $i->status ?></span></td>
                                <td>
                                <button class="action-btn view-btn" onclick="openModalCert(this)" 
                                data-id = "<?=$i->RequestID?>"
                                data-name = "<?=$i->name?>"
                                data-userid = "<?=$i->UserID?>"
                                data-tournament = "<?=$i->tournament?>"
                                data-Year = "<?=$i->Year?>"
                                data-sport_name = "<?=$i->sport_name?>"
                                data-date = "<?=$i->date?>"
                                >View</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>

                    <!-- Certificates Request Modal Content -->
                    <div id="certificatesModal" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeModal('certificatesModal')">&times;</span>
                            <h2>Certificate Request Details</h2>
                            <div class="certificate-data form-details">
                                <div class="request-info">
                                    <p><strong>Request ID:</strong> <span id="cert-requestId"></span></p>
                                    <p><strong>Student Name:</strong> <span id="cert-studentName"></span></p>
                                    <p><strong>Student ID:</strong> <span id="cert-studentId"></span></p>
                                    <p><strong>Tournament:</strong> <span id="cert-type"></span></p>
                                    <p><strong>Year:</strong> <span id="cert-year"></span></p>
                                    <p><strong>Sport:</strong> <span id="cert-sport"></span></p>
                                    <p><strong>Required By Date:</strong> <span id="cert-requiredDate"></span></p>
                                </div>
                                <div class="modal-actions">
                                    <button class="action-btn approve-btn" onclick="handleAction('certificates', 'approve', 'cert-requestId')">Approve Request</button>
                                    <button class="action-btn reject-btn" onclick="handleAction('certificates', 'reject', 'cert-requestId')">Reject Request</button>
                                    <button class="action-btn ready-btn" onclick="markCertificateReady('cert-requestId')">Mark Ready for Collection</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="medical" class="form-section">
                    <h2>Medical Requests</h2>
                    
                    <!-- requests table -->
                    <table class="request-table">
                        <thead>
                            <tr>
                                <th>Request ID</th>
                                <th>Student Name</th>
                                <th>Registration No</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if(!empty($allmedical)): ?>
                            <?php foreach($allmedical as $i): ?>
                                <tr>
                                    <td><?= $i->RequestID ?></td>
                                    <td><?= $i->name ?></td>
                                    <td><?= $i->RegistrationID ?></td>
                                    <td><span class="status-badge status-pending"><?= $i->status ?></span></td>
                                <td>
                                <button class="action-btn view-btn" onclick="openModalMed(this)" 
                                data-id = "<?=$i->RequestID?>"
                                data-name = "<?=$i->name?>"
                                data-userid = "<?=$i->userid?>"
                                data-reason = "<?=$i->ReasonForMedical?>"
                                >View</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>

                    <!-- modal for viewing request -->
                    <div id="medicalModal" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeModal('medicalModal')">&times;</span>
                            <h2>Request Details</h2>
                            <div class="medical-data form-details">
                                <div class="request-info">
                                    <p><strong>Request ID:</strong> <span id="med-requestId"></span></p>
                                    <p><strong>Student Name:</strong> <span id="med-studentName"></span></p>
                                    <p><strong>Student ID:</strong> <span id="med-studentId"></span></p>
                                    <p><strong>Reason:</strong> <span id="med-ReasonForMedical"></span></p>
                                </div>
                                <div class="modal-actions">
                                    <button class="action-btn approve-btn" onclick="handleAction('medical', 'approve', 'med-requestId')">Approve Request</button>
                                    <button class="action-btn reject-btn" onclick="handleAction('medical', 'reject', 'med-requestId')">Reject Request</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="transport" class="form-section">
                    <h2>Transport Requests</h2>                    
                    <table class="request-table">
                        <thead>
                        <tr>
                                <th>Request ID</th>
                                <th>Sport</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if(!empty($alltransport)): ?>
                            <?php foreach($alltransport as $i): ?>
                                <tr>
                                    <td><?= $i->request_id ?></td>
                                    <td><?= $i->sport_name ?></td>
                                    <td><?= $i->date ?></td>
                                    <td><span class="status-badge status-pending"><?= $i->status ?></span></td>
                                <td>
                                <button class="action-btn view-btn" onclick="openModalTrans(this)" 
                                data-id = "<?=$i->request_id?>"
                                data-sport = "<?=$i->sport_name?>"
                                data-date = "<?=$i->date?>"
                                data-location = "<?=$i->location?>"
                                data-time = "<?=$i->time?>"
                                data-reason = "<?=$i->reason?>"
                                >View</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>

                    <!-- modal for viewing request -->
                    <div id="transportModal" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeModal('transportModal')">&times;</span>
                            <h2>Request Details</h2>
                            <div class="transport-data form-details">
                                <div class="request-info">
                                    <p><strong>Request ID:</strong> <span id="trans-requestId"></span></p>
                                    <p><strong>Sport:</strong> <span id="trans-sport"></span></p>
                                    <p><strong>Date:</strong> <span id="trans-date"></span></p>
                                    <p><strong>Location:</strong> <span id="trans-location"></span></p>
                                    <p><strong>Time:</strong> <span id="trans-time"></span></p>
                                    <p><strong>Reason:</strong> <span id="trans-reason"></span></p>
                                </div>
                                <div class="modal-actions">
                                    <button class="action-btn approve-btn" onclick="handleAction('transport', 'approve', 'trans-requestId')">Approve Request</button>
                                    <button class="action-btn reject-btn" onclick="handleAction('transport', 'reject', 'trans-requestId')">Reject Request</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    
                <div id="hostel" class="form-section">
                    <h2>Hostel Facilities Requests</h2>
                    
                    <!-- requests table -->
                    <table class="request-table">
                        <thead>
                            <tr>
                                <th>Request ID</th>
                                <th>Student Name</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Sample row - duplicate and modify as needed -->
                          
                         
                            <tr>
                                <td>REQ001</td>
                                <td>John Doe</td>
                                <td>2024-11-29</td>
                                <td><span class="status-badge status-pending">Pending</span></td>
                                <td>
                                    <button class="action-btn view-btn" onclick="openModal('REQ001', 'medical')">View</button>
                                    <!-- <button class="action-btn approve-btn">Approve</button> -->
                                    <!-- <button class="action-btn reject-btn">Reject</button> -->
                                </td>
                            </tr>
                            <tr>
                                <td>REQ001</td>
                                <td>John Doe</td>
                                <td>2024-11-29</td>
                                <td><span class="status-badge status-pending">Pending</span></td>
                                <td>
                                    <button class="action-btn view-btn" onclick="openModal('REQ001', 'medical')">View</button>
                                    <!-- <button class="action-btn approve-btn">Approve</button> -->
                                    <!-- <button class="action-btn reject-btn">Reject</button> -->
                                </td>
                            </tr>
                            <tr>
                                <td>REQ001</td>
                                <td>John Doe</td>
                                <td>2024-11-29</td>
                                <td><span class="status-badge status-pending">Pending</span></td>
                                <td>
                                    <button class="action-btn view-btn" onclick="openModal('REQ001', 'medical')">View</button>
                                    <!-- <button class="action-btn approve-btn">Approve</button> -->
                                    <!-- <button class="action-btn reject-btn">Reject</button> -->
                                </td>
                            </tr>
                            <tr>
                                <td>REQ001</td>
                                <td>John Doe</td>
                                <td>2024-11-29</td>
                                <td><span class="status-badge status-pending">Pending</span></td>
                                <td>
                                    <button class="action-btn view-btn" onclick="openModal('REQ001', 'medical')">View</button>
                                    <!-- <button class="action-btn approve-btn">Approve</button> -->
                                    <!-- <button class="action-btn reject-btn">Reject</button> -->
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- modal for viewing request -->
                    <div id="hostelModal" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeModal('hostelModal')">&times;</span>
                            <h2>Request Details</h2>
                            <div class="form-details">
                                <!-- Details will be populated dynamically -->
                            </div>
                        </div>
                    </div>
                </div>
        
            </div>

        </main>

    </div>

	<script src="<?=ROOT?>/assets/js/ped_incharge/otherforms.js"></script>
	<script src="<?=ROOT?>/assets/js/ped_incharge/navbar.js"></script>
</body>
</html>