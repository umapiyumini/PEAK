function showTable(){
    document.getElementById("table").style.display = "flex";
    document.getElementById("board").style.display = "none";
    document.getElementById("tableBtn").classList.add("active");
    document.getElementById("boardBtn").classList.remove("active");
}

function showBoard(){
    document.getElementById("table").style.display = "none";
    document.getElementById("board").style.display = "flex";
    document.getElementById("boardBtn").classList.add("active");
    document.getElementById("tableBtn").classList.remove("active");
}
    
let selectedCardId = null;
let selectedCard = null;

// Mock data for additional details - In a real application, this would come from your backend
const mockReservationDetails = {
    '205176503': {
        company: 'Royal College',
        contactPerson: 'Mr. K.G.A Gamage',
        phone: '+94 876 765 543',
        email: 'abc@example.com',
        participants: '25',
        requirements: 'Hockey court should be drawn',
    }
};

function pickUpCard(event) {
    const card = event.currentTarget;
    const column = card.closest('.column');
    const columnTitle = column.querySelector('h2').textContent.toLowerCase();

    if (columnTitle.includes("new") || columnTitle.includes("in progress") || columnTitle.includes("awaiting")) {
        selectedCardId = card.dataset.id;
        selectedCard = card;
        showActionModal(card, columnTitle);
    } else {
        console.log("This action is not allowed for cards in this column.");
    }
}

function showActionModal(card, columnTitle) {
    const requestInfo = document.getElementById('requestInfo');
    const modalActions = document.getElementById('modalActions');
    
    // Populate basic information
    requestInfo.innerHTML = `
        <div class="info-row">
            <label>Facility:</label>
            <span>${card.querySelector('.facility').textContent}</span>
        </div>
        <div class="info-row">
            <label>Reservation ID:</label>
            <span>${card.querySelector('.reservation-id').textContent}</span>
        </div>
        <div class="info-row">
            <label>Event:</label>
            <span>${card.querySelector('.event').textContent}</span>
        </div>
        <div class="info-row">
            <label>Date:</label>
            <span>${card.querySelector('.date').textContent}</span>
        </div>
        <div class="info-row">
            <label>Time:</label>
            <span>${card.querySelector('.time').textContent}</span>
        </div>
    `;

    // Populate additional information from mock data
    const details = mockReservationDetails[selectedCardId] || {};
    document.getElementById('company').textContent = details.company || 'N/A';
    document.getElementById('contactPerson').textContent = details.contactPerson || 'N/A';
    document.getElementById('phone').textContent = details.phone || 'N/A';
    document.getElementById('email').textContent = details.email || 'N/A';
    document.getElementById('participants').textContent = details.participants || 'N/A';
    document.getElementById('requirements').textContent = details.requirements || 'None';

    // Set up action buttons based on column
    modalActions.innerHTML = `
        <button class="accept-btn" onclick="acceptRequest()">Accept</button>
        <button class="reject-btn" onclick="rejectRequest()">Reject</button>
    `;

    if (columnTitle.includes("new") || columnTitle.includes("awaiting")) {
        modalActions.innerHTML += `
            <button class="in-progress-btn" onclick="moveToInProgress()">Move To In Progress</button>
        `;
    }

    // Show the modal with animation
    const modal = document.getElementById('actionModal');
    modal.style.display = 'block';
    modal.querySelector('.modal-content').style.opacity = '0';
    setTimeout(() => {
        modal.querySelector('.modal-content').style.opacity = '1';
    }, 10);
}

function closeActionModal() {
    const modal = document.getElementById('actionModal');
    modal.querySelector('.modal-content').style.opacity = '0';
    setTimeout(() => {
        modal.style.display = 'none';
        selectedCardId = null;
        selectedCard = null;
    }, 300);
}

function acceptRequest() {
    moveCardToColumn('done');
    closeActionModal();
    updateColumnCounts();
}

function rejectRequest() {
    moveCardToColumn('rejected');
    closeActionModal();
    updateColumnCounts();
}

function moveToInProgress() {
    moveCardToColumn('progress');
    closeActionModal();
    updateColumnCounts();
}

function moveCardToColumn(targetColumnClass) {
    const targetColumn = document.querySelector(`.column.${targetColumnClass}`);
    if (targetColumn && selectedCard) {
        targetColumn.appendChild(selectedCard);
    } else {
        console.log("Error: Target column or selected card is not available.");
    }
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('actionModal');
    if (event.target == modal) {
        closeActionModal();
    }
};

// Update column counts
function updateColumnCounts() {
    document.querySelectorAll('.column').forEach(column => {
        const count = column.querySelectorAll('.card').length;
        column.querySelector('.count').textContent = count;
    });
}

// Initialize event listeners
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.close').addEventListener('click', closeActionModal);
    updateColumnCounts();
});