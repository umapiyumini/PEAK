document.addEventListener('DOMContentLoaded', function () {
    // Form date validation
    document.getElementById('form').addEventListener('submit', function (e) {
        const startDate = document.getElementById('startdate').value;
        const endDate = document.getElementById('end_date').value;

        if (new Date(endDate) < new Date(startDate)) {
            e.preventDefault();
            alert('End date cannot be before start date.');
        }
    });
});

document.querySelector('.addRegNoBtn').addEventListener('click', function () {
    const container = document.getElementById('playerContainer');
    
    const entry = document.createElement('div');
    entry.classList.add('player-entry');
    entry.innerHTML = `
        <input type="text" class="regNo" name="reg_no[]" placeholder="Enter Registration No" required> 
        <select class="priority" name="priority[]" required>
            <option value="">Select Priority</option>
            <option value="1">1 (Highest)</option>
            <option value="2">2 (High)</option>
            <option value="3">3 (Medium)</option>
            <option value="4">4 (Low)</option>
            <option value="5">5 (Lowest)</option>
        </select>
        <button type="button" class="removeBtn">Remove</button>
    `;

    container.appendChild(entry);
});

// Delegate remove button clicks
document.getElementById('playerContainer').addEventListener('click', function (e) {
    if (e.target.classList.contains('removeBtn')) {
        e.target.parentElement.remove();
    }
});