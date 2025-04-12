// Show Add Modal
function showAddModal(category) {
    const modal = document.getElementById(`add-upcoming-modal`);
    modal.classList.remove('hidden');
    document.querySelector('.modal-overlay').classList.remove('hidden');
  }
  
  // Show Edit Modal
  function showEditModal(id) {
    const modal = document.getElementById('edit-modal');
    const event = document.querySelector(`.tournament-item[data-id='${id}']`);
  
    document.getElementById('edit-id').value = id;
    document.getElementById('edit-name').value = event.querySelector('h3').textContent;
    document.getElementById('edit-venue').value = event.querySelector('p strong + text')?.textContent || '';
    // You may need to customize these lines based on how the content is structured
  
    modal.classList.remove('hidden');
    document.querySelector('.modal-overlay').classList.remove('hidden');
  }
  
  // Show Delete Confirmation Modal
  function showDeleteConfirmation(id) {
    document.getElementById('delete-id').value = id;
    document.getElementById('delete-modal').classList.remove('hidden');
    document.querySelector('.modal-overlay').classList.remove('hidden');
  }
  
  // Close any modal
  function closeModal() {
    document.querySelectorAll('.modal').forEach(modal => modal.classList.add('hidden'));
    document.querySelector('.modal-overlay').classList.add('hidden');
  }
  