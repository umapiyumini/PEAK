// Function to load content into the iframe and update the breadcrumb
function loadContent(page, pageName) {
    document.getElementById('contentFrame').src = page; // Load the content in iframe
    document.getElementById('currentPage').textContent = pageName; // Update breadcrumb text
}

// Function to toggle Reservation dropdown
function toggleReservationDropdown() {
const dropdown = document.getElementById('reservationDropdown');
dropdown.classList.toggle('show-dropdown');
}

// Function to toggle Forms dropdown
function toggleFormsDropdown() {
    var dropdown = document.getElementById('formsDropdown');
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
}