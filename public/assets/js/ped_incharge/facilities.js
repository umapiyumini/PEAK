 // Sample initial facilities data
 let facilities = [
    {
        id: 1,
        name: "Multi-functional Ground",
        description: "Our ground features a well-maintained, expansive area perfect for various sports and events. Equipped with quality turf and state-of-the-art facilities.",
        image: "../assets/images/ped_incharge/ground.jpg"
    },
    {
        id: 2,
        name: "Top tier Tennis court",
        description: "Our tennis courts offer a pristine playing surface for enthusiasts and professionals. Well-maintained and equipped with the latest amenities.",
        image: "../assets/images/ped_incharge/tennis.jpg"
    },
    {
        id: 3,
        name: "State-of-the-art Indoor stadium",
        description: "Our indoor stadium is a versatile facility designed to host a wide range of sports and events. With modern amenities and ample seating.",
        image: "../assets/images/ped_incharge/indoor.jpg"
    },
    {
        id: 4,
        name: "BasketBall Court",
        description: "Our indoor stadium is a versatile facility designed to host a wide range of sports and events. With modern amenities and ample seating.",
        image: "../assets/images/ped_incharge/basketballcourt.jpg"
    }
];

// DOM Elements
const facilitiesContainer = document.getElementById('facilitiesContainer');
const addFacilityBtn = document.getElementById('addFacilityBtn');
const modal = document.getElementById('facilityModal');
const modalTitle = document.getElementById('modalTitle');
const facilityForm = document.getElementById('facilityForm');
const closeBtn = document.querySelector('.close');

// Current editing facility id
let editingId = null;

// Render facilities
function renderFacilities() {
    facilitiesContainer.innerHTML = facilities.map(facility => `
        <div class="facility-card" data-id="${facility.id}">
            <img src="${facility.image}" alt="${facility.name}" class="facility-image">
            <div class="facility-content">
                <h3>${facility.name}</h3>
                <p>${facility.description}</p>
            </div>
            <div class="facility-actions">
                <button class="btn btn-edit" onclick="editFacility(${facility.id})">
                    <i class="uil uil-edit"></i> 
                </button>
                <button class="btn btn-delete" onclick="deleteFacility(${facility.id})">
                    <i class="uil uil-trash-alt"></i> 
                </button>
            </div>
        </div>
    `).join('');
}

// Add new facility
function addFacility() {
    editingId = null;
    modalTitle.textContent = 'Add Facility';
    facilityForm.reset();
    modal.style.display = 'block';
}

// Edit facility
function editFacility(id) {
    editingId = id;
    modalTitle.textContent = 'Edit Facility';
    const facility = facilities.find(f => f.id === id);
    
    document.getElementById('facilityName').value = facility.name;
    document.getElementById('facilityDescription').value = facility.description;
    document.getElementById('facilityImage').value = facility.image;
    
    modal.style.display = 'block';
}

// Delete facility
function deleteFacility(id) {
    if (confirm('Are you sure you want to delete this facility?')) {
        facilities = facilities.filter(f => f.id !== id);
        renderFacilities();
    }
}

// Event Listeners
addFacilityBtn.addEventListener('click', addFacility);

closeBtn.addEventListener('click', () => {
    modal.style.display = 'none';
});

window.addEventListener('click', (e) => {
    if (e.target === modal) {
        modal.style.display = 'none';
    }
});

facilityForm.addEventListener('submit', (e) => {
    e.preventDefault();
    
    const facilityData = {
        name: document.getElementById('facilityName').value,
        description: document.getElementById('facilityDescription').value,
        image: document.getElementById('facilityImage').value
    };

    if (editingId === null) {
        // Add new facility
        facilityData.id = facilities.length + 1;
        facilities.push(facilityData);
    } else {
        // Update existing facility
        facilities = facilities.map(f => 
            f.id === editingId ? { ...facilityData, id: editingId } : f
        );
    }

    renderFacilities();
    modal.style.display = 'none';
});

// Initial render
renderFacilities();