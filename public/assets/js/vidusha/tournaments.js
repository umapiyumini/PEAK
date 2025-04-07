function showForm(category) {
  // Show form container
  document.getElementById('formContainer').style.display = 'block';
  
  // Hide all forms
  document.getElementById('interUniForm').classList.add('hidden');
  document.getElementById('interFacultyForm').classList.add('hidden');
  document.getElementById('freshersForm').classList.add('hidden');
  
  // Show the selected form
  document.getElementById(category + 'Form').classList.remove('hidden');
  
  // Reset all forms to their default state
  document.getElementById('interUniForm').reset();
  document.getElementById('interFacultyForm').reset();
  document.getElementById('freshersForm').reset();
  
  // Reset the hidden ID fields
  document.getElementById('interunirecordid').value = '';
  document.getElementById('interfacrecordid').value = '';
  document.getElementById('freshersrecordid').value = '';
  
  // Change button text to "Add Record"
  var buttons = document.querySelectorAll('#formContainer button[type="submit"]');
  buttons.forEach(function(button) {
    button.textContent = 'Add Record';
  });
}

/*function editRecord(type, id, ...fields) {
  // Show the form for this category
  showForm(type);
  
  const form = document.getElementById(type + 'Form');
  
  // Set form button text to "Update Record"
  form.querySelector('button[type="submit"]').textContent = 'Update Record';
  
  // Set the record ID based on the record type
  if (type === 'interUni') {
    document.getElementById('interunirecordid').value = id;
    form.elements['tournament_name'].value = fields[0];
    form.elements['year'].value = fields[1];
    form.elements['place'].value = fields[2];
    form.elements['venue'].value = fields[3];
    form.elements['no_of_players'].value = fields[4];
    form.elements['players_Regno'].value = fields[5];
  } 
  else if (type === 'interFaculty') {
    document.getElementById('interfacrecordid').value = id;
    form.elements['tournament_name'].value = fields[0];
    form.elements['year'].value = fields[1];
    form.elements['first_place'].value = fields[2];
    form.elements['second_place'].value = fields[3];
    form.elements['third_place'].value = fields[4];
    form.elements['no_of_players'].value = fields[5];
    form.elements['players_regno'].value = fields[6];
  }
  else if (type === 'freshers') {
    document.getElementById('freshersrecordid').value = id;
    form.elements['tournament_name'].value = fields[0];
    form.elements['year'].value = fields[1];
    form.elements['first_place'].value = fields[2];
    form.elements['second_place'].value = fields[3];
    form.elements['third_place'].value = fields[4];
    form.elements['no_of_players'].value = fields[5];
    form.elements['playersregno'].value = fields[6];
  }
}*/

function openEditModal(type, id, ...fields) {
  let modalId = type + 'Modal';
  
  // Get the modal element
  let modal = document.getElementById(modalId);
  
  // Set the record ID and form data based on the record type
  if (type === 'interUni') {
    document.getElementById('interUniEditId').value = id;
    document.getElementById('interUniEditName').value = fields[0];
    document.getElementById('interUniEditYear').value = fields[1];
    document.getElementById('interUniEditPlace').value = fields[2];
    document.getElementById('interUniEditVenue').value = fields[3];
    document.getElementById('interUniEditPlayers').value = fields[4];
    document.getElementById('interUniEditRegno').value = fields[5];
  } 
  else if (type === 'interFaculty') {
    document.getElementById('interFacultyEditId').value = id;
    document.getElementById('interFacultyEditName').value = fields[0];
    document.getElementById('interFacultyEditYear').value = fields[1];
    document.getElementById('interFacultyEditFirst').value = fields[2];
    document.getElementById('interFacultyEditSecond').value = fields[3];
    document.getElementById('interFacultyEditThird').value = fields[4];
    document.getElementById('interFacultyEditPlayers').value = fields[5];
    document.getElementById('interFacultyEditRegno').value = fields[6];
  }
  else if (type === 'freshers') {
    document.getElementById('freshersEditId').value = id;
    document.getElementById('freshersEditName').value = fields[0];
    document.getElementById('freshersEditYear').value = fields[1];
    document.getElementById('freshersEditFirst').value = fields[2];
    document.getElementById('freshersEditSecond').value = fields[3];
    document.getElementById('freshersEditThird').value = fields[4];
    document.getElementById('freshersEditPlayers').value = fields[5];
    document.getElementById('freshersEditRegno').value = fields[6];
  }
  
  // Display the modal
  modal.style.display = 'block';
}

function closeModal(modalId) {
  document.getElementById(modalId).style.display = 'none';
}

// Close modal when clicking outside of it
window.onclick = function(event) {
  if (event.target.className === 'modal') {
    event.target.style.display = 'none';
  }
}