// sportprofile.js

// Open modal by ID
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
      modal.style.display = 'block';
    }
  }
  
  // Close modal by ID
  function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
      modal.style.display = 'none';
    }
  }
  
  // Open the edit modal and populate form fields with data
  function openEditModal(type, tournamentId, name, regno, tournament, date, place, venue,men_women) {
    if (type === 'others') {
      document.getElementById('tournamentEditId').value = tournamentId;
      document.getElementById('otherEditpname').value = name;
      document.getElementById('otherEditName').value = tournament;
      document.getElementById('otherEditDate').value = date;
      document.getElementById('otherEditPlace').value = place;
      document.getElementById('otherEditVenue').value = venue;
      document.getElementById('otherEditRegno').value = regno;
      document.getElementById('men_women').value = men_women;
      openModal('othersModal');
    }
  }
  
  // Show the Add Record Modal and clear form
  document.addEventListener('DOMContentLoaded', () => {
    const addBtn = document.querySelector('.add-btn');
    const addForm = document.getElementById('othersForm');
  
    if (addBtn && addForm) {
      addBtn.addEventListener('click', () => {
        addForm.reset();
        openModal('othersAddModal');
      });
    }
  
    // Close modal when clicking outside content
    window.onclick = function (event) {
      const addModal = document.getElementById('othersAddModal');
      const editModal = document.getElementById('othersModal');
      if (event.target === addModal) {
        closeModal('othersAddModal');
      } else if (event.target === editModal) {
        closeModal('othersModal');
      }
    };
  });
  