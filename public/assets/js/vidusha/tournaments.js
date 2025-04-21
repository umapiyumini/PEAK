// Open Add Modal
function openAddModal(modalId) {
  // Hide all modals
  document.querySelectorAll('.modal').forEach(modal => {
    modal.style.display = 'none';
    const form = modal.querySelector('form');
    if (form) form.classList.add('hidden');
  });

  // Show the selected modal
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.style.display = 'block';
    const form = modal.querySelector('form');
    if (form) form.classList.remove('hidden');
  }
}

// Close Modal
function closeModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.style.display = 'none';
    const form = modal.querySelector('form');
    if (form) form.classList.add('hidden');
  }
}

// Close modal when clicking outside the content
window.onclick = function(event) {
  document.querySelectorAll('.modal').forEach(modal => {
    if (event.target === modal) {
      modal.style.display = 'none';
      const form = modal.querySelector('form');
      if (form) form.classList.add('hidden');
    }
  });
}

// Open Edit Modal with correct parameter handling for each tournament type
function openEditModal(type, id, name, yearOrDate, placeOrFirst, venueOrSecond, thirdOrPlayers, noOfPlayers, regNo) {
  if (type === 'interUni') {
    document.getElementById('interUniModal').style.display = 'block';
    document.getElementById('interUniEditId').value = id;
    document.getElementById('interUniEditName').value = name;
    document.getElementById('interUniEditDate').value = yearOrDate;
    document.getElementById('interUniEditPlace').value = placeOrFirst;
    document.getElementById('interUniEditVenue').value = venueOrSecond;
    document.getElementById('interUniEditPlayers').value = thirdOrPlayers; // This is no_of_players for interUni
    document.getElementById('interUniEditRegno').value = noOfPlayers; // This is players_Regno for interUni
  } else if (type === 'interFaculty') {
    document.getElementById('interFacultyModal').style.display = 'block';
    document.getElementById('interFacultyEditId').value = id;
    document.getElementById('interFacultyEditName').value = name;
    document.getElementById('interFacultyEditYear').value = yearOrDate;
    document.getElementById('interFacultyEditFirst').value = placeOrFirst;
    document.getElementById('interFacultyEditSecond').value = venueOrSecond;
    document.getElementById('interFacultyEditThird').value = thirdOrPlayers; // This is third_place
    document.getElementById('interFacultyEditPlayers').value = noOfPlayers; // This is no_of_players
    document.getElementById('interFacultyEditRegno').value = regNo; // This is players_regno
  } else if (type === 'freshers') {
    document.getElementById('freshersModal').style.display = 'block';
    document.getElementById('freshersEditId').value = id;
    document.getElementById('freshersEditName').value = name;
    document.getElementById('freshersEditYear').value = yearOrDate;
    document.getElementById('freshersEditFirst').value = placeOrFirst;
    document.getElementById('freshersEditSecond').value = venueOrSecond;
    document.getElementById('freshersEditThird').value = thirdOrPlayers; // This is third_place
    document.getElementById('freshersEditPlayers').value = noOfPlayers; // This is no_of_players
    document.getElementById('freshersEditRegno').value = regNo; // This is playersregno
  } else if (type === 'others') {
    document.getElementById('othersModal').style.display = 'block';
    document.getElementById('tournamentEditId').value = id;
    document.getElementById('otherEditName').value = name;
    document.getElementById('otherEditDate').value = yearOrDate;
    document.getElementById('otherEditPlace').value = placeOrFirst;
    document.getElementById('otherEditVenue').value = venueOrSecond;
    document.getElementById('otherEditRegno').value = thirdOrPlayers; // This is player_regno for others
  }
}

// Fix the edit button onclick handler for other records
document.addEventListener('DOMContentLoaded', function() {
  // Find all edit buttons for other records and attach event listeners
  const otherEditButtons = document.querySelectorAll('#otherList .edit-btn');
  otherEditButtons.forEach(button => {
    button.onclick = function() {
      const params = this.getAttribute('onclick')
        .replace('openEditModal(', '')
        .replace(')', '')
        .split(',')
        .map(param => param.trim().replace(/^'|'$/g, ''));
      
      // Change the type from 'interUni' to 'others'
      params[0] = 'others';
      openEditModal(...params);
      
      // Prevent the original onclick from firing
      return false;
    };
  });
});