// Store tournaments for each category in localStorage
let tournaments = {
  "inter-university": JSON.parse(localStorage.getItem('inter-university')) || [
    {
      id: 1,
      name: "Inter-University Tournament",
      date: "2024-03-15",
      place: "1st place",
      venue: "University of Colombo",
      participants: 16,
    },
    {
      id: 2,
      name: "National Chess Championship",
      date: "2024-04-10",
      place: "2nd place",
      venue: "University of Moratuwa",
      participants: 10,
    },
  ],
  "inter-faculty": JSON.parse(localStorage.getItem('inter-faculty')) || [
    {
      id: 3,
      name: "Inter Faculty Championship",
      date: "2024-02-20",
      place: "2nd place",
      venue: "Faculty of Science",
      participants: 12,
    },
    {
      id: 4,
      name: "Inter Faculty Basketball Tournament",
      date: "2024-05-05",
      place: "1st place",
      venue: "Faculty of Arts",
      participants: 8,
    },
  ],
  "freshers-meet": JSON.parse(localStorage.getItem('freshers-meet')) || [
    {
      id: 5,
      name: "Freshers Meet",
      date: "2024-01-30",
      place: "3rd place",
      venue: "University of Colombo",
      participants: 14,
    },
    {
      id: 6,
      name: "Freshers Volleyball Tournament",
      date: "2024-06-10",
      place: "1st place",
      venue: "University Gymnasium",
      participants: 18,
    },
  ],
};

// Save tournaments to localStorage
function saveTournamentsToStorage() {
  Object.keys(tournaments).forEach((category) => {
    localStorage.setItem(category, JSON.stringify(tournaments[category]));
  });
}

// Switch tabs
function switchTab(tabId) {
  document.querySelectorAll('.tab-button').forEach(button => button.classList.remove('active'));
  document.querySelector(`#${tabId}`).classList.add('active');

  document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
  document.getElementById(tabId).classList.add('active');

  // Populate table with the relevant category tournaments
  populateTable(tabId);
}

// Populate table based on selected category
function populateTable(category) {
  const tbody = document.getElementById(`${category}TournamentsBody`);
  tbody.innerHTML = "";

  tournaments[category].forEach((tournament) => {
    const row = document.createElement("tr");
    row.innerHTML = `
      <td>${tournament.name}</td>
      <td>${new Date(tournament.date).toLocaleDateString()}</td>
      <td>${tournament.place}</td>
      <td>${tournament.venue}</td>
      <td>${tournament.participants}</td>
    `;
    row.dataset.id = tournament.id; // Add tournament ID for reference
    tbody.appendChild(row);
  });

  addRowClickListeners(category); // Add event listeners to rows for the current category
}

// Add event listeners to rows in the table
function addRowClickListeners(category) {
  const rows = document.querySelectorAll(`#${category}TournamentsBody tr`);
  rows.forEach((row) => {
    row.addEventListener("click", () => {
      const id = parseInt(row.dataset.id);
      editTournament(category, id);
    });
  });
}

// Open modal for adding/editing a tournament
function openModal(category, tournamentId = null) {
  document.getElementById("modalTitle").textContent = tournamentId ? "Edit Tournament" : "Add Tournament";
  document.getElementById("tournamentForm").reset();
  document.getElementById("tournamentId").value = tournamentId || "";

  if (tournamentId) {
    const tournament = tournaments[category].find((t) => t.id === tournamentId);
    document.getElementById("name").value = tournament.name;
    document.getElementById("date").value = tournament.date;
    document.getElementById("place").value = tournament.place;
    document.getElementById("venue").value = tournament.venue;
    document.getElementById("participants").value = tournament.participants;
  }

  document.getElementById("tournamentModal").style.display = "block";
}

// Close the modal
function closeModal() {
  document.getElementById("tournamentModal").style.display = "none";
}

// Save tournament (add or edit)
function saveTournament(event) {
  event.preventDefault();

  const category = document.querySelector('.tab-button.active').id; // Get active tab category
  const tournamentId = document.getElementById("tournamentId").value;
  const tournament = {
    id: tournamentId ? parseInt(tournamentId) : Date.now(),
    name: document.getElementById("name").value,
    date: document.getElementById("date").value,
    place: document.getElementById("place").value,
    venue: document.getElementById("venue").value,
    participants: parseInt(document.getElementById("participants").value),
  };

  if (tournamentId) {
    // Update existing tournament
    const index = tournaments[category].findIndex((t) => t.id === parseInt(tournamentId));
    tournaments[category][index] = tournament;
  } else {
    // Add new tournament
    tournaments[category].push(tournament);
  }

  saveTournamentsToStorage();
  populateTable(category);
  closeModal();
}

// Edit tournament by row click
function editTournament(category, id) {
  openModal(category, id);
}

// Delete tournament
function deleteTournament(category, id) {
  if (confirm("Are you sure you want to delete this tournament?")) {
    tournaments[category] = tournaments[category].filter((t) => t.id !== id);
    saveTournamentsToStorage();
    populateTable(category);
  }
}

// Event listeners for filtering
document.getElementById("search").addEventListener("input", filterTournaments);
document.getElementById("year").addEventListener("change", filterTournaments);

// Filter tournaments
function filterTournaments() {
  const searchTerm = document.getElementById("search").value.toLowerCase();
  const yearFilter = document.getElementById("year").value;
  const category = document.querySelector('.tab-button.active').id;

  const filtered = tournaments[category].filter((tournament) => {
    const matchesSearch = tournament.name.toLowerCase().includes(searchTerm);
    const matchesYear = !yearFilter || tournament.date.includes(yearFilter);

    return matchesSearch && matchesYear;
  });

  populateTable(category);
}

// Initial population of tables for each category
populateTable("inter-university");

// Close modal when clicking outside
window.onclick = function (event) {
  if (event.target === document.getElementById("tournamentModal")) {
    closeModal();
  }
};

// Add event listeners for tab switching
document.querySelectorAll('.tab-button').forEach(button => {
  button.addEventListener('click', () => switchTab(button.id));
});
