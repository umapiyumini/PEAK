<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
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

        /* Left sidebar styles */
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

        .basic-info {
            text-align: left;
            margin-top: 1.5rem;
        }

        .basic-info p {
            margin: 0.5rem 0;
            color: #666;
        }

        /* Right content styles */
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

        /* Responsive design */
        @media (max-width: 900px) {
            .profile-container {
                grid-template-columns: 1fr;
            }
            
            .profile-left {
                padding: 1.5rem;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
            }
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

        .btn-edit {
            background: var(--edit-color);
            color: white;
        }

        .btn-save {
            background: var(--success-color);
            color: white;
        }

        .btn-cancel {
            background: #dc3545;
            color: white;
        }

        .info-item input, .info-item textarea {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 0.9rem;
        }

        .info-item.editing label {
            color: #007bff;
        }

        .upload-photo {
            margin-top: 1rem;
            display: none;
        }

        .upload-photo.show {
            display: block;
        }

        .edit-mode .info-item span {
            display: none;
        }

        .view-mode .info-item input,
        .view-mode .info-item textarea {
            display: none;
        }
    </style>
</head>
<body>
<?php $current_page = 'studentprofile'; include 'sidebar.view.php'?>
    <div class="main-content">
        
        <div class="header">
            <h1>Student Profile</h1>
        </div>
        <main>
            
            <div class="profile-container">
        <div class="profile-left">
            <div class="profile-image">
                <img src="<?=ROOT?>/assets/images/ped_incharge/pro_icon.jpg" alt="Student Photo" id="studentPhoto">
            </div>
            <h2 id="studentName">Student Name</h2>
            <div class="basic-info">
                <p>Registration No: <span id="studentRegNo"></span></p>
                <p>Faculty: <span id="studentFaculty"></span></p>
            </div>
        </div>
        <div class="profile-right">
        
            <div class="info-card">
                <h3><i class="uil uil-info-circle"></i> General Information</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <label>Registered Date:</label>
                        <span id="studentRegDate"></span>
                    </div>
                    <div class="info-item">
                        <label>ID Expiry Date:</label>
                        <span id="studentExpireDate"></span>
                    </div>
                    <div class="info-item">
                        <label>Academic Year:</label>
                        <span id="academicYearDisplay"></span>
                    </div>
                    <div class="info-item">
                        <label>Gender:</label>
                        <span id="studentGender"></span>
                    </div>
                </div>
            </div>

            <div class="info-card">
                <h3><i class="uil uil-user"></i> Personal Information</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <label>studentBirthDate:</label>
                        <span id="dobDisplay"></span>
                    </div>
                    <div class="info-item">
                        <label>NIC:</label>
                        <span id="studentNIC"></span>
                    </div>
                    <div class="info-item">
                        <label>Email:</label>
                        <span id="studentEmail"></span>
                    </div>
                    <div class="info-item">
                        <label>Contact:</label>
                        <span id="studentContact"></span>
                    </div>
                    <div class="info-item">
                        <label>Address:</label>
                        <span id="studentAddress"></span>
                    </div>
                </div>
            </div>

            <div class="info-card">
                <h3><i class="uil uil-medal"></i> Achievements & Activities</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <label>Sports:</label>
                        <span id="studentSports"></span>
                    </div>
                    <div class="info-item full-width">
                        <label>Achievements:</label>
                        <span id="studentAchievements"></span>
                    </div>
                </div>
            </div>
            <div class="edit-buttons">
                <button class="btn btn-edit" id="editButton">
                    <i class="uil uil-edit"></i> Edit Profile
                </button>
                <button class="btn btn-save" id="saveButton" style="display: none;">
                    <i class="uil uil-save"></i> Save Changes
                </button>
                <button class="btn btn-cancel" id="cancelButton" style="display: none;">
                    <i class="uil uil-times"></i> Cancel
                </button>
            </div>
        </div>
    </div>
        </main>
	<script src="navbar.js"></script>
    <script>


const studentData = {
    photo: "../assets/images/ped_incharge/pro_icon.jpg",
    name: "Ryan ",
    regNo: "321000001",
    faculty: "Medicine",
    regDate: "2023-09-01",
    expireDate: "2027-09-01",
    academicYear: "2023",
    gender: "Male",
    dateOfBirth: "2000-01-01",
    nic: "1234567890",
    email: "john.doe@example.com",
    contact: "0123456789",
    address: "123 Student Street, City",
    sports: "Football, Cricket",
    achievements: "Cricket SLUG Champions-2024"
};

// Function to display student data in the profile
function displayStudentProfile(data) {
    // Set profile image and name
    document.getElementById('studentPhoto').src = data.photo;
    document.getElementById('studentName').textContent = data.name;
    
    // Set basic info
    document.getElementById('studentRegNo').textContent = data.regNo;
    document.getElementById('studentFaculty').textContent = data.faculty;
    
    // Set general information
    document.getElementById('studentRegDate').textContent = formatDate(data.regDate);
    document.getElementById('studentExpireDate').textContent = formatDate(data.expireDate);
    document.getElementById('academicYearDisplay').textContent = data.academicYear;
    document.getElementById('studentGender').textContent = data.gender;
    
    // Set personal information
    document.getElementById('dobDisplay').textContent = formatDate(data.dateOfBirth);
    document.getElementById('studentNIC').textContent = data.nic;
    document.getElementById('studentEmail').textContent = data.email;
    document.getElementById('studentContact').textContent = data.contact;
    document.getElementById('studentAddress').textContent = data.address;
    
    // Set achievements and activities
    document.getElementById('studentSports').textContent = data.sports;
    document.getElementById('studentAchievements').textContent = data.achievements;
}

// Helper function to format dates nicely
function formatDate(dateString) {
    if (!dateString) return '';
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateString).toLocaleDateString(undefined, options);
}

// Function to get student data from form
function getStudentDataFromForm() {
    return {
        photo: document.getElementById('studentPhoto').src,
        name: document.getElementById('studentName').value,
        regNo: document.getElementById('studentRegNo').value,
        faculty: document.getElementById('studentFaculty').value,
        regDate: document.getElementById('studentRegDate').value,
        expireDate: document.getElementById('studentExpireDate').value,
        academicYear: document.getElementById('academicYear').value,
        gender: document.getElementById('studentGender').value,
        dateOfBirth: document.getElementById('studentBirthDate').value,
        nic: document.getElementById('studentNIC').value,
        email: document.getElementById('studentEmail').value,
        contact: document.getElementById('studentContact').value,
        address: document.getElementById('studentAddress').value,
        sports: document.getElementById('studentSports').value,
        achievements: document.getElementById('studentAchievements').value
    };
}

// Function to update profile from form data
function updateProfileFromForm() {
    const formData = getStudentDataFromForm();
    displayStudentProfile(formData);
}

// Initialize profile when page loads
document.addEventListener('DOMContentLoaded', () => {
    // Display initial data
    displayStudentProfile(studentData);
    
    // If there's a form, add submit event listener
    const studentForm = document.getElementById('addStudentForm');
    if (studentForm) {
        studentForm.addEventListener('submit', (e) => {
            e.preventDefault();
            updateProfileFromForm();
            // Close modal if it exists
            const modal = document.getElementById('addModal');
            if (modal) {
                modal.style.display = 'none';
            }
        });
    }
});

// Function to display student data when clicking view button in table
function viewStudent(studentData) {
    displayStudentProfile(studentData);
}

// Function to fetch student data from backend (example)
async function fetchStudentData(studentId) {
    try {
        // Replace with your actual API endpoint
        const response = await fetch(`/api/students/${studentId}`);
        if (!response.ok) throw new Error('Failed to fetch student data');
        const data = await response.json();
        displayStudentProfile(data);
    } catch (error) {
        console.error('Error fetching student data:', error);
        alert('Failed to load student data');
    }
}

// Function to handle view button click in table
function onViewButtonClick(studentId) {
    fetchStudentData(studentId);
}

// edit
let isEditing = false;
        const editButton = document.getElementById('editButton');
        const saveButton = document.getElementById('saveButton');
        const cancelButton = document.getElementById('cancelButton');

        // Function to toggle edit mode
        function toggleEditMode(enable) {
            isEditing = enable;
            const container = document.querySelector('.profile-container');
            
            if (enable) {
                container.classList.add('edit-mode');
                container.classList.remove('view-mode');
                editButton.style.display = 'none';
                saveButton.style.display = 'block';
                cancelButton.style.display = 'block';
                document.querySelector('.upload-photo').classList.add('show');
            } else {
                container.classList.remove('edit-mode');
                container.classList.add('view-mode');
                editButton.style.display = 'block';
                saveButton.style.display = 'none';
                cancelButton.style.display = 'none';
                document.querySelector('.upload-photo').classList.remove('show');
            }

            // Convert spans to input fields
            document.querySelectorAll('.info-item').forEach(item => {
                const span = item.querySelector('span');
                const existingInput = item.querySelector('input, textarea');
                
                if (!existingInput) {
                    const input = document.createElement(
                        span.id === 'studentAddress' || span.id === 'studentAchievements' 
                        ? 'textarea' 
                        : 'input'
                    );
                    input.type = 'text';
                    input.value = span.textContent;
                    input.dataset.forSpan = span.id;
                    item.appendChild(input);
                }
            });
        }

        // Function to save changes
        function saveChanges() {
            const updatedData = {...studentData};
            
            document.querySelectorAll('.info-item input, .info-item textarea').forEach(input => {
                const spanId = input.dataset.forSpan;
                const key = spanId.replace('student', '').replace('Display', '');
                updatedData[key.toLowerCase()] = input.value;
            });

            // Update the global studentData object
            Object.assign(studentData, updatedData);
            
            // Display updated data
            displayStudentProfile(studentData);
            
            // Exit edit mode
            toggleEditMode(false);
        }

        // Function to cancel editing
        function cancelEdit() {
            displayStudentProfile(studentData);
            toggleEditMode(false);
        }

        // Event listeners for edit buttons
        editButton.addEventListener('click', () => toggleEditMode(true));
        saveButton.addEventListener('click', saveChanges);
        cancelButton.addEventListener('click', cancelEdit);

        // Modify the display function to create input fields
        function displayStudentProfile(data) {
            // Existing display logic remains the same
            document.getElementById('studentPhoto').src = data.photo;
            document.getElementById('studentName').textContent = data.name;
            
            // Update all spans with corresponding data
            Object.keys(data).forEach(key => {
                const elementId = 'student' + key.charAt(0).toUpperCase() + key.slice(1);
                const element = document.getElementById(elementId);
                if (element) {
                    element.textContent = key.includes('date') ? formatDate(data[key]) : data[key];
                }
            });
        }

        // Initialize the profile in view mode
        document.addEventListener('DOMContentLoaded', () => {
            displayStudentProfile(studentData);
            toggleEditMode(false);
        });
    </script>
</body>
</html>

