let currentRecord = null;

function showCategoryForm(category) {
  document.getElementById('formContainer').style.display = 'block';

  // Hide all forms initially
  document.getElementById('interUniForm').classList.add('hidden');
  document.getElementById('interFacultyForm').classList.add('hidden');
  document.getElementById('freshersForm').classList.add('hidden');

  // Show the relevant form based on the selected category
  if (category === 'interUni') {
    document.getElementById('interUniForm').classList.remove('hidden');
  } else if (category === 'interFaculty') {
    document.getElementById('interFacultyForm').classList.remove('hidden');
  } else if (category === 'freshers') {
    document.getElementById('freshersForm').classList.remove('hidden');
  }
}

function handleFormSubmit(event, category) {
  event.preventDefault();
  const form = event.target;
  const data = Array.from(form.elements).reduce((acc, element) => {
    if (element.tagName === 'INPUT' || element.tagName === 'TEXTAREA') {
      acc[element.placeholder] = element.value;
    }
    return acc;
  }, {});

  if (currentRecord) {
    updateRecord(data, category);
  } else {
    addRecordToTable(data, category);
  }

  form.reset();
  currentRecord = null; // Reset the current record after submitting
}

function addRecordToTable(data, category) {
  const list = document.getElementById(category + 'List');

  // Create a table row
  const row = document.createElement('tr');

  // Add table data for each field
  row.innerHTML = `
    <td>${data['Tournament Name']}</td>
    <td>${data['Year']}</td>
    <td>${data['Place'] || data['1st Place Faculty']}</td>
    <td>${data['Venue'] || data['2nd Place Faculty']}</td>
    <td>${data['No of Players']}</td>
    <td>${data['Players Reg No'].replace(/\n/g, ', ')}</td>
    <td>
      <button class="update-btn" onclick="editRecord(this)">Update</button>
      <button onclick="deleteRecord(this)">Delete</button>
    </td>
  `;

  list.appendChild(row);
}

function editRecord(button) {
  const row = button.closest('tr');
  const cells = row.getElementsByTagName('td');

  // Determine the category
  const category = row.closest('table').id.replace('Table', '').toLowerCase();
  const form = document.getElementById(category + 'Form');
  const inputs = form.elements;

  // Populate the form with the existing record's data
  inputs[0].value = cells[0].innerText; // Tournament Name
  inputs[1].value = cells[1].innerText; // Year
  inputs[2].value = cells[2].innerText; // Place / 1st Place Faculty
  inputs[3].value = cells[3].innerText; // Venue / 2nd Place Faculty
  inputs[4].value = cells[4].innerText; // No of Players
  inputs[5].value = cells[5].innerText.replace(/, /g, '\n'); // Players Reg No (multi-line)

  // Set the current record to be updated
  currentRecord = row;
}

function deleteRecord(button) {
  const row = button.closest('tr');
  row.remove();
}

function updateRecord(data, category) {
  const row = currentRecord;
  const cells = row.getElementsByTagName('td');

  // Update the table row with the new data
  cells[0].innerText = data['Tournament Name'];
  cells[1].innerText = data['Year'];
  cells[2].innerText = data['Place'] || data['1st Place Faculty'];
  cells[3].innerText = data['Venue'] || data['2nd Place Faculty'];
  cells[4].innerText = data['No of Players'];
  cells[5].innerText = data['Players Reg No'].replace(/\n/g, ', ');

  // Reset the form after updating the record
  document.getElementById(category + 'Form').reset();
  currentRecord = null; // Clear the reference to the current record
}
