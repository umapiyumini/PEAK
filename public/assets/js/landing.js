var navLinks = document.getElementById("navLinks");

function shownav() {
    navLinks.style.right = "0";
}

function hidenav() {
    navLinks.style.right = "-200px";
}


// -------------------------------scroll pop----------------
document.addEventListener("DOMContentLoaded", function() {
const facilities = document.querySelectorAll('.facility');

const options = {
root: null, // Use the viewport as the container
threshold: 0.1 // Trigger when at least 10% of the element is visible
};

const observer = new IntersectionObserver((entries) => {
entries.forEach((entry) => {
    if (entry.isIntersecting) {
        const facility = entry.target;

        // Delay the visibility by its index
        const index = Array.from(facilities).indexOf(facility);
        setTimeout(() => {
            facility.classList.add('visible');
        }, index * 100); // Adjust the delay (300ms) as needed

        observer.unobserve(facility); // Stop observing after it becomes visible
    }
});
}, options);

facilities.forEach(facility => {
observer.observe(facility); // Start observing each facility
});
});

// entry animation
window.addEventListener('load', () => {
    console.log('Page loaded');
    const preloader = document.getElementById('preloader');
    const mainContent = document.getElementById('main-content');

    // Fade out preloader
    preloader.style.opacity = '0';
    setTimeout(() => {
        preloader.style.display = 'none';
        mainContent.style.display = 'block';
    }, 1000); // Matches fade-out duration
});
