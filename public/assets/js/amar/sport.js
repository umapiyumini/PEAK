// Sample initial sports data
let sports = [
    {
        id: 1,
        name: "Hockey",
        image: "../assets/images/amar/hockey.jpg"
        
    },
    {
        id: 2,
        name: "Cricket",
        image: "../assets/images/amar/hockey.jpg"
    },
    {
        id: 3,
        name: "Basketball",
        image: "../assets/images/amar/hockey.jpg"
    },
    {
        id: 4,
        name: "Athletics",
        image: "../assets/images/amar/hockey.jpg"
    },
    {
        id: 5,
        name: "Baseball",
        image: "../assets/images/amar/hockey.jpg"
    },
    {
        id: 6,
        name: "Carrom",
        image: "../assets/images/amar/hockey.jpg"
    },
    {
        id: 7,
        name: "Elle",
        image: "../assets/images/amar/hockey.jpg"
    },
    {
        id: 8,
        name: "Beach Volleyball",
        image: "../assets/images/amar/hockey.jpg"
    },
    {
        id: 9,
        name: "Football",
        image: "../assets/images/amar/hockey.jpg"
    },
    {
        id: 10,
        name: "Tennis",
        image: "../assets/images/amar/hockey.jpg"
    },
    {
        id: 11,
        name: "Rugby",
        image: "../assets/images/amar/hockey.jpg"
    },
    {
        id: 12,
        name: "Badminton",
        image: "../assets/images/amar/hockey.jpg"
    }
];

// DOM Elements
const sportsContainer = document.getElementById('sportsContainer');
const addSportBtn = document.getElementById('addSportBtn');
const modal = document.getElementById('addSportModal');
const modalTitle = document.getElementById('modalTitle');
const sportForm = document.getElementById('addSportForm');
const closeBtn = document.querySelector('.close');
const searchInput = document.getElementById('searchInput');

// Current editing sport id
let editingId = null;

// Render sports
function renderSports(sportsToRender = sports) {
    sportsContainer.innerHTML = sportsToRender.map(sport => `
        <div class="sport-card" data-id="${sport.id}">
            <img src="${sport.image}" alt="${sport.name}" class="sport-image">
            <div class="sport-content">
                <h3>${sport.name}</h3>
            </div>
        </div>
    `).join('');
}

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

// Search sports
function searchSports(query) {
    const filteredSports = sports.filter(sport => 
        sport.name.toLowerCase().includes(query.toLowerCase())
    );
    renderSports(filteredSports);
}

// Event Listeners
addSportBtn.addEventListener('click', openModal);

closeBtn.addEventListener('click', closeModal);

window.addEventListener('click', (e) => {
    if (e.target === modal) {
        closeModal();
    }
});

searchInput.addEventListener('input', (e) => {
    searchSports(e.target.value);
});

sportForm.addEventListener('submit', (e) => {
    e.preventDefault();
    
    const sportData = {
        name: document.getElementById('sportName').value,
        image: document.getElementById('imageUrl').value
    };

    if (editingId === null) {
        // Add new sport
        sportData.id = sports.length + 1;
        sports.push(sportData);
    } else {
        // Update existing sport
        sports = sports.map(s => 
            s.id === editingId ? { ...sportData, id: editingId } : s
        );
    }

    renderSports();
    closeModal();
});

// Initial render
renderSports();