
  // Open Add Modal
  function openAddModal(modalId) {
    // Hide all modals
    document.querySelectorAll('.modal').forEach(modal => {
      modal.style.display = 'none';
      modal.querySelector('form').classList.add('hidden');
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
    }
  }
  

function closeModal(modalId) {
  document.getElementById(modalId).style.display = 'none';
}



  window.onclick = function(e) {
    document.querySelectorAll('.modal').forEach(modal => {
      if (e.target === modal) modal.style.display = 'none';
    });
  };

