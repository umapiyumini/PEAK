document.addEventListener('DOMContentLoaded', function() {
    const addRegNoBtn = document.querySelector('.addRegNoBtn');
    const playerContainer = document.getElementById('playerContainer');
    const subDateField = document.getElementById('subDate');

    // Set today's date for the Submition Date field
    const today = new Date().toISOString().split('T')[0];
    subDateField.value = today;

    addRegNoBtn.addEventListener('click', function() {
        // Create a new input element
        const newInput = document.createElement('input');
        newInput.type = 'text';
        newInput.className = 'regNo';
        newInput.placeholder = 'Enter Registration No';
        newInput.required = true;

        // Add the new input to the container
        playerContainer.appendChild(newInput);
    });
});
