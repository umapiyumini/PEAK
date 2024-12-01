const studentData = {
    photo: "<?=ROOT?>/assets/images/vidusha/mcaptain.jpeg",
    name: "John Doe",
    regNo: "REG12345",
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
    height: "5' 10\"",
    weight: "55kg",
    allergies: "Peanuts",
    medicines: "None",
    blood: "A+",
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
    
    // Set health information
    document.getElementById('studentHeight').textContent = data.height;
    document.getElementById('studentWeight').textContent = data.weight;
    document.getElementById('studentAllergies').textContent = data.allergies;
    document.getElementById('studentMedicines').textContent = data.medicines;
    document.getElementById('studentBlood').textContent = data.blood;

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
        height: document.getElementById('studentheight').value,
        weight: document.getElementById('studentweight').value,
        allergies: document.getElementById('studentallergies').value,
        medicines: document.getElementById('studentmedicines').value,
        blood: document.getElementById('studentblood').value,
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

        function searchByRegNo() {
    const searchInput = document.getElementById('searchInput').value.trim();
    const studentRegNo = document.getElementById('studentRegNo').textContent.trim();

    if (searchInput === studentRegNo) {
        // If the entered registration number matches, highlight the profile
        alert("Profile Found: " + studentRegNo);
        document.querySelector('.profile-container').style.display = "block";
    } else {
        // Otherwise, display an error or hide the profile
        alert("No Profile Found for Registration No: " + searchInput);
        document.querySelector('.profile-container').style.display = "none";
    }
}

const urlParams = new URLSearchParams(window.location.search);
        const name = urlParams.get("name");
        const regNo = urlParams.get("regNo");

        // Populate the profile container
        document.getElementById("studentName").textContent = name || "N/A";
        document.getElementById("studentRegNo").textContent = regNo || "N/A";

