
document.addEventListener('DOMContentLoaded', () => {
    const filterSelect = document.getElementById('taskFilterSelect');
    const rows = document.querySelectorAll('#taskTable tbody tr');

    // Apply initial checkbox-based class
    rows.forEach(row => {
        const checkbox = row.querySelector('.status-checkbox');
        if (checkbox && checkbox.checked) {
            row.classList.add('completed');
        }
    });

    // Handle checkbox toggle
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.status-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                const taskId = this.dataset.taskId;
                const isChecked = this.checked;
                const status = isChecked ? 'Completed' : 'Pending';
    
                fetch("<?= ROOT ?>/stafftodo/updatestatus", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `task_id=${taskId}&status=${status}`
                })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        alert("Failed to update status.");
                        this.checked = !isChecked; // revert checkbox
                    }
                })
                .catch(err => {
                    alert("Error updating task.");
                    this.checked = !isChecked; // revert checkbox
                });
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

    // Filter on change
    filterSelect.addEventListener('change', filterTasks);

    // Initial load
    filterTasks();
});

