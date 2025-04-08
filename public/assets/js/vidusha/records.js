document.querySelectorAll('.tab-button').forEach(button => {
  button.addEventListener('click', () => {
    // Remove active class from all buttons and contents
    document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
    document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
    
    // Add active class to clicked button and corresponding content
    button.classList.add('active');
    const tabId = button.getAttribute('data-tab');
    document.getElementById(tabId).classList.add('active');
  });
});

// Category filtering functionality
document.querySelectorAll('.category-button').forEach(button => {
  button.addEventListener('click', () => {
    // Remove active class from all category buttons
    document.querySelectorAll('.category-button').forEach(btn => btn.classList.remove('active'));
    
    // Add active class to clicked button
    button.classList.add('active');
    
    const category = button.getAttribute('data-category');
    filterTournaments(category);
  });
});

// Function to filter tournaments by category
function filterTournaments(category) {
  const items = document.querySelectorAll('.tournament-item');
  
  items.forEach(item => {
    if (category === 'all' || item.getAttribute('data-category') === category) {
      item.style.display = 'block';
    } else {
      item.style.display = 'none';
    }
  });
}

// Modal functions
function showAddModal(type) {
  document.querySelector('.modal-overlay').classList.remove('hidden');
  
  if (type === 'past') {
    document.getElementById('add-past-modal').classList.remove('hidden');
  } else if (type === 'upcoming') {
    document.getElementById('add-upcoming-modal').classList.remove('hidden');
  }
}

function showEditModal(id) {
  // In a real application, you would fetch the tournament data here
  // and populate the form fields
  document.getElementById('edit-id').value = id;
  
  // For demonstration, pre-fill with dummy data
  const tournamentItems = document.querySelectorAll('.tournament-item');
  let targetItem;
  
  tournamentItems.forEach(item => {
    const itemButtons = item.querySelector('.Button').querySelectorAll('button');
    itemButtons.forEach(button => {
      if (button.onclick && button.onclick.toString().includes(id)) {
        targetItem = item;
      }
    });
  });
  
  if (targetItem) {
    document.getElementById('edit-name').value = targetItem.querySelector('h3').textContent;
    document.getElementById('edit-category').value = targetItem.getAttribute('data-category');
    
    const dateElement = targetItem.querySelector('p:nth-child(2)');
    if (dateElement) {
      document.getElementById('edit-year').value = dateElement.textContent.replace('Date:', '').trim();
    }
    
    const venueElement = targetItem.querySelector('p:last-of-type');
    if (venueElement && venueElement.textContent.includes('Venue:')) {
      document.getElementById('edit-venue').value = venueElement.textContent.replace('Venue:', '').trim();
    }
  }
  
  document.querySelector('.modal-overlay').classList.remove('hidden');
  document.getElementById('edit-modal').classList.remove('hidden');
}

function showDeleteConfirmation(id) {
  document.getElementById('delete-id').value = id;
  document.querySelector('.modal-overlay').classList.remove('hidden');
  document.getElementById('delete-modal').classList.remove('hidden');
}

function closeModal() {
  document.querySelectorAll('.modal').forEach(modal => {
    modal.classList.add('hidden');
  });
  document.querySelector('.modal-overlay').classList.add('hidden');
}

// Close modal when clicking outside
document.querySelector('.modal-overlay').addEventListener('click', closeModal);

// Prevent form submission (for demo purposes)
document.querySelectorAll('form').forEach(form => {
  form.addEventListener('submit', (e) => {
    e.preventDefault();
    alert('Form submission would happen here in a real application.');
    closeModal();
  });
});