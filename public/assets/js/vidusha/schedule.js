document.addEventListener('DOMContentLoaded', function() {
  // DOM Elements
  const addScheduleBtn = document.getElementById('add-schedule');
  const addModal = document.getElementById('add-modal');
  const cancelModal = document.getElementById('cancel-modal');
  const editModal = document.getElementById('edit-modal');
  const filterMonthSelect = document.getElementById('filter-month');
  const filterUpcomingBtn = document.getElementById('filter-upcoming');
  const filterAllBtn = document.getElementById('filter-all');
  const addForm = document.getElementById('add-form');
  const cancelForm = document.getElementById('cancel-form');
  const editForm = document.getElementById('edit-form');
  
  // Initialize date input with today's date
  if (document.getElementById('date')) {
    const today = new Date();
    const formattedDate = today.toISOString().split('T')[0];
    document.getElementById('date').value = formattedDate;
    
    // Set default start and end times (e.g., 4:00 PM - 6:00 PM)
    document.getElementById('start_time').value = '16:00';
    document.getElementById('end_time').value = '18:00';
  }
  
  // Open add modal
  if (addScheduleBtn) {
    addScheduleBtn.addEventListener('click', function() {
      addModal.style.display = 'block';
    });
  }
  
  // Close modal buttons
  document.querySelectorAll('.close').forEach(function(closeBtn) {
    closeBtn.addEventListener('click', function() {
      addModal.style.display = 'none';
      cancelModal.style.display = 'none';
      editModal.style.display = 'none';
    });
  });
  
  // Cancel close button
  document.getElementById('cancel-close')?.addEventListener('click', function() {
    cancelModal.style.display = 'none';
  });
  
  // Cancel buttons in schedule cards
  document.querySelectorAll('.delete-button').forEach(function(btn) {
    btn.addEventListener('click', function() {
      const scheduleId = this.getAttribute('data-id');
      
      // Find the parent card to get date and time info
      const card = this.closest('.schedule-card');
      const date = card.querySelector('.schedule-date').textContent.trim();
      const time = card.querySelector('.schedule-time').textContent.trim();
      
      // Set values in the cancel modal
      document.getElementById('cancel-id').value = scheduleId;
      document.getElementById('cancel-date').textContent = date;
      document.getElementById('cancel-time').textContent = time;
      
      // Show cancel modal
      cancelModal.style.display = 'block';
    });
  });

  // Edit buttons in schedule cards
  document.querySelectorAll('.edit-button').forEach(function(btn) {
    btn.addEventListener('click', function() {
      const scheduleId = this.getAttribute('data-id');
      const card = this.closest('.schedule-card');
      const dateText = card.querySelector('.schedule-date').textContent.trim();
      const timeText = card.querySelector('.schedule-time').textContent.trim();
  
      // Parse date string like "Fri, Apr 12" - this is where the issue is
      const dateParts = dateText.split(', ')[1].split(' ');
      const month = {Jan: 0, Feb: 1, Mar: 2, Apr: 3, May: 4, Jun: 5, Jul: 6, Aug: 7, Sep: 8, Oct: 9, Nov: 10, Dec: 11}[dateParts[0]];
      const day = parseInt(dateParts[1]);
      const currentYear = new Date().getFullYear();
      
      // Create date without timezone conversion issues
      const parsedDate = new Date(currentYear, month, day);
      const formattedDate = parsedDate.toISOString().split('T')[0];
    // Parse time string like "04:00 PM - 06:00 PM"
    const [startTimeStr, endTimeStr] = timeText.split('-').map(t => t.trim());

    // Convert time to 24hr format (helper function)
    function to24Hour(timeStr) {
      const [time, modifier] = timeStr.split(' ');
      let [hours, minutes] = time.split(':').map(Number);
      if (modifier === 'PM' && hours !== 12) hours += 12;
      if (modifier === 'AM' && hours === 12) hours = 0;
      return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}`;
    }

    const startTime = to24Hour(startTimeStr);
    const endTime = to24Hour(endTimeStr);

    // Populate modal inputs
    document.getElementById('edit-id').value = scheduleId;
    document.getElementById('edit-date').value = formattedDate;
    document.getElementById('edit-start_time').value = startTime;
    document.getElementById('edit-end_time').value = endTime;
   

    // Show edit modal
    editModal.style.display = 'block';
  });
});

  
  // Filter by month
  if (filterMonthSelect) {
    filterMonthSelect.addEventListener('change', function() {
      filterSchedules();
    });
  }
  
  // Filter buttons
  if (filterUpcomingBtn) {
    filterUpcomingBtn.addEventListener('click', function() {
      filterAllBtn.classList.remove('btn-active');
      filterUpcomingBtn.classList.add('btn-active');
      filterSchedules('upcoming');
    });
  }
  
  if (filterAllBtn) {
    filterAllBtn.addEventListener('click', function() {
      filterUpcomingBtn.classList.remove('btn-active');
      filterAllBtn.classList.add('btn-active');
      filterSchedules('all');
    });
  }
  
  // Window click to close modals
  window.addEventListener('click', function(event) {
    if (event.target == addModal) {
      addModal.style.display = 'none';
    }
    if (event.target == cancelModal) {
      cancelModal.style.display = 'none';
    }
  });
  
  // Filter schedules based on selection
  function filterSchedules(type = null) {
    const cards = document.querySelectorAll('.schedule-card');
    const selectedMonth = filterMonthSelect.value;
    const today = new Date();
    
    cards.forEach(function(card) {
      let show = true;
      
      // Date filtering
      const dateText = card.querySelector('.schedule-date').textContent.trim();
      const itemDate = new Date(dateText);
      
      // Month filtering
      if (selectedMonth && itemDate.getMonth() + 1 != parseInt(selectedMonth)) {
        show = false;
      }
      
      // Type filtering (upcoming vs all)
      if (type === 'upcoming' && itemDate < today) {
        show = false;
      }
      
      // Show or hide the card
      card.style.display = show ? 'block' : 'none';
    });
  }
  
  // Optional: Form validation
  if (addForm) {
    addForm.addEventListener('submit', function(e) {
      const startTime = document.getElementById('start_time').value;
      const endTime = document.getElementById('end_time').value;
      
      // Simple validation to ensure end time is after start time
      if (startTime >= endTime) {
        e.preventDefault();
        alert('End time must be after start time.');
      }
    });
  }
});

const category = card.querySelector('.schedule-category').textContent.trim();
document.getElementById('edit-category').value = category;


document.addEventListener('DOMContentLoaded', function() {
    // Check for alerts
    const successAlert = document.querySelector('.alert-success');
    const errorAlert = document.querySelector('.alert-danger');
    
    if (successAlert) {
        successAlert.style.display = 'block';
        setTimeout(function() {
            successAlert.style.opacity = '0';
            setTimeout(function() {
                successAlert.style.display = 'none';
            }, 500);
        }, 3000);
    }
    
    if (errorAlert) {
        errorAlert.style.display = 'block';
        setTimeout(function() {
            errorAlert.style.opacity = '0';
            setTimeout(function() {
                errorAlert.style.display = 'none';
            }, 500);
        }, 3000);
    }
});
