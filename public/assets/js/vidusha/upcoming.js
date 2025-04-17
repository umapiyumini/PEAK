function showAddModal(category) {
  document.getElementById('add-upcoming-modal').classList.remove('hidden');
  document.querySelector('.modal-overlay').classList.remove('hidden');
}

function showEditModal(id) {
  const modal = document.getElementById('edit-modal');
  const event = document.querySelector(`.tournament-item[data-id='${id}']`);

  if (!event) return;

  // Get clean values by skipping label text
  const name = event.querySelector('h3').textContent.trim();

  const dateText = event.querySelector('p:nth-of-type(1)').innerHTML.split('</strong>')[1].trim();
  const timeText = event.querySelector('p:nth-of-type(2)').innerHTML.split('</strong>')[1].trim();
  const venueText = event.querySelector('p:nth-of-type(3)').innerHTML.split('</strong>')[1].trim();

  // Populate modal form fields
  document.getElementById('edit-id').value = id;
  document.getElementById('edit-name').value = name;
  document.getElementById('edit-date').value = dateText;
  document.getElementById('edit-time').value = timeText;
  document.getElementById('edit-venue').value = venueText;

  modal.classList.remove('hidden');
  document.querySelector('.modal-overlay').classList.remove('hidden');
}

function showDeleteConfirmation(id) {
  document.getElementById('delete-id').value = id;
  document.getElementById('delete-modal').classList.remove('hidden');
  document.querySelector('.modal-overlay').classList.remove('hidden');
}

function closeModal() {
  document.querySelectorAll('.modal').forEach(modal => modal.classList.add('hidden'));
  document.querySelector('.modal-overlay').classList.add('hidden');
}
