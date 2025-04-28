
// DOM Elements
const sportsContainer = document.getElementById('sportsContainer');
// const addSportBtn = document.getElementById('addSportBtn');
const modal = document.getElementById('addSportModal');
const modalTitle = document.getElementById('modalTitle');
const sportForm = document.getElementById('addSportForm');
const closeBtn = document.querySelector('.close');
const searchInput = document.getElementById('searchInput');

let editingId = null;



// Add new sport
function openModal() {
    editingId = null;
    modalTitle.textContent = 'Add Sport';
    sportForm.reset();
    modal.style.display = 'block';
}

// Close modal
function closeModal() {
    modal.style.display = 'none';
    sportForm.reset();
    editingId = null;
}


window.addEventListener('click', (e) => {
    if (e.target === modal) {
        closeModal();
    }
});



