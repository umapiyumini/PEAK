
// Data structure for tournaments with participants
let tournaments = JSON.parse(localStorage.getItem('tournaments')) || [
  {
      id: 1,
      name: "Spring Basketball Championship",
      sport: "Basketball",
      date: "2024-03-15",
      place: "1st place",
      men_women: "Men",
      venue: "Main Sports Complex",
      participants: ["2021/IS/001", "2021/IS/002", "2021/IS/003"],
      totalParticipants: 3
  }
];

// Save tournaments to localStorage
function saveTournamentsToStorage() {
  localStorage.setItem('tournaments', JSON.stringify(tournaments));
}

// Populate table with tournament data
function populateTable(data) {
  const tbody = document.getElementById('tournamentsBody');
  tbody.innerHTML = '';

  data.forEach(tournament => {
      const row = document.createElement('tr');
      row.innerHTML = `
          <td>${tournament.name}</td>
          <td>${tournament.sport}</td>
          <td>${new Date(tournament.date).toLocaleDateString()}</td>
          <td>${tournament.place}</td>
          <td>${tournament.men_women}</td>
          <td>${tournament.venue}</td>
          <td>${tournament.totalParticipants}</td>
          <td class="action-buttons">
              <button class="btn btn-update" onclick="editTournament(${tournament.id})">
                  <i class="uil uil-edit"></i>
              </button>
              <button class="btn btn-danger" onclick="deleteTournament(${tournament.id})">
                  <i class="uil uil-trash-alt"></i>
              </button>
              <button class="btn btn-view" onclick="viewParticipants(${tournament.id})">
                  <i class="uil uil-eye"></i>
              </button>
          </td>
      `;
      tbody.appendChild(row);
  });
}

// Filter tournaments based on search criteria
function filterTournaments() {
  const searchTerm = document.getElementById('search').value.toLowerCase();
  const sportFilter = document.getElementById('sport').value.toLowerCase();
  const yearFilter = document.getElementById('year').value;

  const filtered = tournaments.filter(tournament => {
      const matchesSearch = tournament.name.toLowerCase().includes(searchTerm);
      const matchesSport = !sportFilter || tournament.sport.toLowerCase() === sportFilter;
      const matchesYear = !yearFilter || tournament.date.includes(yearFilter);

      return matchesSearch && matchesSport && matchesYear;
  });

  populateTable(filtered);
}

// Participant management
function addParticipant() {
  const container = document.getElementById('participantsContainer');
  const participantDiv = document.createElement('div');
  participantDiv.className = 'participant-input';
  participantDiv.innerHTML = `
      <input type="text" 
             name="participants[]" 
             placeholder="Enter Registration Number" 
             required>
      <button type="button" class="btn btn-remove" onclick="removeParticipant(this)">
          <i class="uil uil-trash-alt"></i>
      </button>
  `;
  container.appendChild(participantDiv);
}

function removeParticipant(button) {
  button.parentElement.remove();
}

function clearParticipants() {
  const container = document.getElementById('participantsContainer');
  container.innerHTML = '';
}

// Modal management
function openModal(isEdit = false) {
  const modalTitle = document.getElementById('modalTitle');
  modalTitle.textContent = isEdit ? 'Edit Tournament' : 'Add Tournament';
  
  if (!isEdit) {
      document.getElementById('tournamentForm').reset();
      document.getElementById('tournamentId').value = '';
      clearParticipants();
      addParticipant(); // Add initial participant field
  }
  
  document.getElementById('tournamentModal').style.display = 'block';
}

function closeModal() {
  document.getElementById('tournamentModal').style.display = 'none';
  clearParticipants();
}

// CRUD Operations
function saveTournament(event) {
  event.preventDefault();

  const participantInputs = document.querySelectorAll('input[name="participants[]"]');
  const participants = Array.from(participantInputs).map(input => input.value);

  const tournamentId = document.getElementById('tournamentId').value;
  const tournament = {
      id: tournamentId ? parseInt(tournamentId) : Date.now(),
      name: document.getElementById('name').value,
      sport: document.getElementById('sportInput').value,
      date: document.getElementById('date').value,
      place: document.getElementById('place').value,
      men_women: document.getElementById('men_women').value,
      venue: document.getElementById('venue').value,
      participants: participants,
      totalParticipants: participants.length
  };

  if (tournamentId) {
      // Update existing tournament
      const index = tournaments.findIndex(t => t.id === parseInt(tournamentId));
      if (index !== -1) {
          tournaments[index] = tournament;
      }
  } else {
      // Add new tournament
      tournaments.push(tournament);
  }

  saveTournamentsToStorage();
  populateTable(tournaments);
  closeModal();
}

function editTournament(id) {
  const tournament = tournaments.find(t => t.id === id);
  if (tournament) {
      openModal(true);
      
      // Populate form fields
      document.getElementById('tournamentId').value = tournament.id;
      document.getElementById('name').value = tournament.name;
      document.getElementById('sportInput').value = tournament.sport;
      document.getElementById('date').value = tournament.date;
      document.getElementById('place').value = tournament.place;
      document.getElementById('men_women').value = tournament.men_women;
      document.getElementById('venue').value = tournament.venue;

      // Clear and populate participants
      clearParticipants();
      tournament.participants.forEach(participant => {
          addParticipant();
          const lastInput = document.querySelector('.participant-input:last-child input');
          lastInput.value = participant;
      });
  }
}

function deleteTournament(id) {
  if (confirm('Are you sure you want to delete this tournament?')) {
      tournaments = tournaments.filter(t => t.id !== id);
      saveTournamentsToStorage();
      populateTable(tournaments);
  }
}

function viewParticipants(id) {
  const tournament = tournaments.find(t => t.id === id);
  if (tournament) {
      alert(`Participants for ${tournament.name}:\n\n${tournament.participants.join('\n')}`);
  }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
  // Initialize table
  populateTable(tournaments);

  // Add event listeners for filters
  document.getElementById('search').addEventListener('input', filterTournaments);
  document.getElementById('sport').addEventListener('change', filterTournaments);
  document.getElementById('year').addEventListener('change', filterTournaments);

  // Close modal when clicking outside
  window.onclick = function(event) {
      if (event.target === document.getElementById('tournamentModal')) {
          closeModal();
      }
  };

  // Add event listener for opening modal
  document.querySelector('.btn-add').addEventListener('click', () => openModal(false));

  window.onclick = function(event) {
    if (event.target === document.getElementById('tournamentModal')) {
        closeModal();
    }
    if (event.target === document.getElementById('viewTournamentModal')) {
        closeViewModal();
    }
};
});


// view
function viewTournament(id) {
  const tournament = tournaments.find(t => t.id === id);
  if (tournament) {
      // Populate the view modal with tournament details
      document.getElementById('viewName').textContent = tournament.name;
      document.getElementById('viewSport').textContent = tournament.sport;
      document.getElementById('viewDate').textContent = new Date(tournament.date).toLocaleDateString();
      document.getElementById('viewPlace').textContent = tournament.place;
      document.getElementById('viewMenWomen').textContent = tournament.men_women;
      document.getElementById('viewVenue').textContent = tournament.venue;

      // Populate participants list
      const participantsList = document.getElementById('viewParticipantsList');
      participantsList.innerHTML = '';
      tournament.participants.forEach((participant, index) => {
          const participantCard = document.createElement('div');
          participantCard.className = 'participant-card';
          participantCard.innerHTML = `
              <span>${index + 1}. ${participant}</span>
          `;
          participantsList.appendChild(participantCard);
      });

      // Show the modal
      const modal = document.getElementById('viewTournamentModal');
      modal.style.display = 'block';
  }
}

function closeViewModal() {
  const modal = document.getElementById('viewTournamentModal');
  modal.style.display = 'none';
}


window.onclick = function(event) {
  const viewModal = document.getElementById('viewTournamentModal');
  if (event.target === viewModal) {
      closeViewModal();
  }
};

// Update the populateTable function to include the view button
function populateTable(data) {
  const tbody = document.getElementById('tournamentsBody');
  tbody.innerHTML = '';

  data.forEach(tournament => {
      const row = document.createElement('tr');
      row.innerHTML = `
          <td>${tournament.name}</td>
          <td>${tournament.sport}</td>
          <td>${new Date(tournament.date).toLocaleDateString()}</td>
          <td>${tournament.place}</td>
          <td>${tournament.men_women}</td>
          <td>${tournament.venue}</td>
          <td>${tournament.totalParticipants}</td>
          <td class="action-buttons">
              <button class="btn btn-view" onclick="viewTournament(${tournament.id})">
                  <i class="uil uil-eye"></i>
              </button>
              <button class="btn btn-update" onclick="editTournament(${tournament.id})">
                  <i class="uil uil-edit"></i>
              </button>
              <button class="btn btn-danger" onclick="deleteTournament(${tournament.id})">
                  <i class="uil uil-trash-alt"></i>
              </button>
          </td>
      `;
      tbody.appendChild(row);
  });
}