document.addEventListener('DOMContentLoaded', () => {
    const ROOT = "<?=ROOT?>"; // make sure this is defined above if needed
    const filterSelect = document.getElementById('taskFilterSelect');
    const rows = document.querySelectorAll('#taskTable tbody tr');
    const checkboxes = document.querySelectorAll('.status-checkbox');

    // Apply initial checkbox-based class
    rows.forEach(row => {
        const checkbox = row.querySelector('.status-checkbox');
        if (checkbox && checkbox.checked) {
            row.classList.add('completed');
        }
    });

    // Handle checkbox toggle
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const taskId = this.dataset.taskId;
            const status = this.checked ? 'Completed' : 'Not Completed';

            fetch(`${ROOT}/staff/stafftodo/updatestatus`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `taskid=${taskId}&status=${encodeURIComponent(status)}`
            })
            .then(response => response.json())
            .then(data => {
                console.log('Status updated:', data);
            })
            .catch(error => {
                console.error('Error updating status:', error);
            });
        });
    });

    // Filter logic
    function filterTasks() {
        const selected = filterSelect.value;

        rows.forEach(row => {
            const checkbox = row.querySelector('.status-checkbox');
            const isChecked = checkbox && checkbox.checked;

            if (selected === 'all') {
                row.style.display = '';
            } else if (selected === 'completed' && isChecked) {
                row.style.display = '';
            } else if (selected === 'notCompleted' && !isChecked) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    filterSelect.addEventListener('change', filterTasks);
    filterTasks(); // Initial filter
});
