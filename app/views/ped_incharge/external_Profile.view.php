<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>External Customer Profile</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ped_incharge/ped.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <style>
        .profile-container {
            width: 95%;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 2rem;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .profile-left {
            background: #f8f9fa;
            padding: 2rem;
            text-align: center;
        }

        .profile-image {
            width: 150px;
            height: 150px;
            margin: 0 auto 1.5rem;
            border-radius: 50%;
            overflow: hidden;
            border: 5px solid white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-left h2 {
            margin-bottom: 1rem;
            color: #333;
        }

        .profile-right {
            padding: 2rem;
        }

        .info-card {
            background: #fff;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .info-card h3 {
            color: var(--primary-color);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .info-item.full-width {
            grid-column: 1 / -1;
        }

        .info-item label {
            color: #666;
            font-size: 0.9rem;
        }

        .info-item span {
            color: #333;
            font-weight: 500;
        }

        .edit-buttons {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-bottom: 1rem;
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 500;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-edit { background: #4a90e2; color: white; }
        .btn-save { background: #2ecc71; color: white; }
        .btn-cancel { background: #dc3545; color: white; }

        .info-item input, .info-item textarea {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 0.9rem;
        }

        .edit-mode .info-item span { display: none; }
        .view-mode .info-item input,
        .view-mode .info-item textarea { display: none; }

        @media (max-width: 900px) {
            .profile-container {
                grid-template-columns: 1fr;
            }
            .info-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <?php $current_page = 'externalcustomers'; include 'sidebar.view.php'?>
    <div class="main-content">
        <div class="header">
        <button onclick="history.back()" class="goBackButton"><i class="uil uil-arrow-left"></i></button>
            <h1>External Customer Profile</h1>
           
  
            <button class="bell-icon"><i class="uil uil-bell"></i></button>
            <!-- <div class="notifications-dropdown">
                <div class="notifications-header">
                    <h3>Notifications</h3>
                    <span class="clear-all">Clear All</span>
                </div>
                <div class="notifications-list">
                    <ul id="notificationsList"></ul>
                </div>
              </div> -->
            <button class="bell-icon"><i class="uil uil-signout"></i></button>
        </div>
        <main>
            
            <div class="profile-container view-mode">
                <div class="profile-left">
                    <div class="profile-image">
                        <img src="<?=ROOT?>/assets/images/ped_incharge/externalcustomer.png" alt="Customer Photo" id="customerPhoto">
                    </div>
                    <h2 id="customerName">Customer Name</h2>
                </div>

                <div class="profile-right">
                    <div class="info-card">
                        <h3><i class="uil uil-info-circle"></i> Personal Information</h3>
                        <div class="info-grid">
                            <div class="info-item">
                                <label>Full Name:</label>
                                <span id="customerFullName"></span>
                            </div>
                            <div class="info-item">
                                <label>Email:</label>
                                <span id="customerEmail"></span>
                            </div>
                            <div class="info-item">
                                <label>Contact No:</label>
                                <span id="customerContact"></span>
                            </div>
                            <div class="info-item">
                                <label>NIC:</label>
                                <span id="customerNIC"></span>
                            </div>
                            <div class="info-item full-width">
                                <label>Address:</label>
                                <span id="customerAddress"></span>
                            </div>
                        </div>
                    </div>

                    <div class="info-card">
                        <h3><i class="uil uil-building"></i> Organization Information</h3>
                        <div class="info-grid">
                            <div class="info-item">
                                <label>Organization Name:</label>
                                <span id="customerOrganization"></span>
                            </div>
                            <div class="info-item">
                                <label>Position:</label>
                                <span id="customerPosition"></span>
                            </div>
                            <div class="info-item full-width">
                                <label>Organization Address:</label>
                                <span id="organizationAddress"></span>
                            </div>
                        </div>
                    </div>

                    <div class="info-card">
                        <h3><i class="uil uil-history"></i> Reservation History</h3>
                        <div class="info-grid">
                            <div class="info-item full-width">
                                <label>Recent Bookings:</label>
                                <span id="customerBookings"></span>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="edit-buttons">
                        <button class="btn btn-edit" id="editButton">
                            <i class="uil uil-edit"></i> Edit Profile
                        </button>
                        <button class="btn btn-save" id="saveButton" style="display: none;">
                            <i class="uil uil-save"></i> Save Changes
                        </button>
                        <button class="btn btn-cancel" id="cancelButton" style="display: none;">
                            <i class="uil uil-times"></i> Cancel
                        </button> -->
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
    const customerData = {
        photo: "<?=ROOT?>/assets/images/ped_incharge/externalcustomer.png",
        name: "John Smith",
        fullName: "John William Smith",
        email: "john.smith@example.com",
        contact: "+94 77 123 4567",
        nic: "991234567V",
        address: "123 Main Street, Colombo 05",
        organization: "Sports Club International",
        position: "Events Manager",
        organizationAddress: "45 Sports Avenue, Colombo 07",
        bookings: "Tennis Court (2024-11-25)\nBadminton Court (2024-11-20)"
    };

    function displayCustomerProfile(data) {
        document.getElementById('customerPhoto').src = data.photo;
        document.getElementById('customerName').textContent = data.name;
        document.getElementById('customerFullName').textContent = data.fullName;
        document.getElementById('customerEmail').textContent = data.email;
        document.getElementById('customerContact').textContent = data.contact;
        document.getElementById('customerNIC').textContent = data.nic;
        document.getElementById('customerAddress').textContent = data.address;
        document.getElementById('customerOrganization').textContent = data.organization;
        document.getElementById('customerPosition').textContent = data.position;
        document.getElementById('organizationAddress').textContent = data.organizationAddress;
        document.getElementById('customerBookings').textContent = data.bookings;
    }

    function toggleEditMode(enable) {
        const container = document.querySelector('.profile-container');
        const editButton = document.getElementById('editButton');
        const saveButton = document.getElementById('saveButton');
        const cancelButton = document.getElementById('cancelButton');

        if (enable) {
            container.classList.add('edit-mode');
            container.classList.remove('view-mode');
            editButton.style.display = 'none';
            saveButton.style.display = 'block';
            cancelButton.style.display = 'block';

            document.querySelectorAll('.info-item').forEach(item => {
                const span = item.querySelector('span');
                if (!item.querySelector('input, textarea')) {
                    const input = document.createElement(
                        span.id.includes('Address') || span.id.includes('Bookings') 
                        ? 'textarea' 
                        : 'input'
                    );
                    input.value = span.textContent;
                    input.dataset.forSpan = span.id;
                    item.appendChild(input);
                }
            });
        } else {
            container.classList.remove('edit-mode');
            container.classList.add('view-mode');
            editButton.style.display = 'block';
            saveButton.style.display = 'none';
            cancelButton.style.display = 'none';
        }
    }

    function saveChanges() {
        document.querySelectorAll('.info-item input, .info-item textarea').forEach(input => {
            const span = document.getElementById(input.dataset.forSpan);
            if (span) span.textContent = input.value;
            
            const key = input.dataset.forSpan.replace('customer', '').toLowerCase();
            customerData[key] = input.value;
        });
        toggleEditMode(false);
    }

    document.addEventListener('DOMContentLoaded', () => {
        displayCustomerProfile(customerData);
        
        document.getElementById('editButton').addEventListener('click', () => toggleEditMode(true));
        document.getElementById('saveButton').addEventListener('click', saveChanges);
        document.getElementById('cancelButton').addEventListener('click', () => {
            displayCustomerProfile(customerData);
            toggleEditMode(false);
        });
    });
    </script>
</body>
</html>