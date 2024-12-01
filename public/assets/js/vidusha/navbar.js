function toggleMenu() {
    const navMenu = document.querySelector('nav ul');
    navMenu.classList.toggle('active');
}
// Select the profile icon and dropdown menu
const profileIcon = document.querySelector('.profile-icon img');
const dropdownMenu = document.getElementById('dropdownMenu');

// Toggle dropdown menu visibility when profile icon is clicked
profileIcon.addEventListener('click', () => {
    // Toggle the 'active' class to show or hide the dropdown
    dropdownMenu.classList.toggle('active');
});

// Hide the dropdown if the user clicks anywhere else on the page
window.addEventListener('click', function (e) {
    if (!profileIcon.contains(e.target) && !dropdownMenu.contains(e.target)) {
        dropdownMenu.classList.remove('active');
    }
});


