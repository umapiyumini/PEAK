document.addEventListener('DOMContentLoaded', function() {
    // Add event listener to the 'Add' button
    document.getElementById('addRegNoBtn').addEventListener('click', function() {
        // Create a new player group with regNo and priority inputs
        const playerGroup = document.createElement('div');
        playerGroup.classList.add('playerGroup');

        const regNoInput = document.createElement('input');
        regNoInput.type = 'text';
        regNoInput.classList.add('regNo');
        regNoInput.placeholder = 'Enter Registration No';
        playerGroup.appendChild(regNoInput);

        const priorityInput = document.createElement('input');
        priorityInput.type = 'text';
        priorityInput.classList.add('priority');
        priorityInput.placeholder = 'Priority (1-5)';
        playerGroup.appendChild(priorityInput);

        // Append the new player group to the players container
        document.getElementById('playerContainer').appendChild(playerGroup);
    });

    // Add event listener to the form submit
    document.getElementById('form').addEventListener('submit', function(e) {
        e.preventDefault();

        const regNos = [];
        const priorities = [];

        // Collect registration numbers and priorities for each player
        const regNoInputs = document.querySelectorAll('.regNo');
        const priorityInputs = document.querySelectorAll('.priority');

        regNoInputs.forEach((input, index) => {
            if (input.value.trim() && priorityInputs[index].value.trim()) { // Ensure both fields have values
                regNos.push(input.value.trim());
                priorities.push(priorityInputs[index].value.trim());
            }
        });

        const startDate = document.getElementById('startdate').value;
        const endDate = document.getElementById('enddate').value;

        if (regNos.length > 0) {
            regNos.forEach((regNo, index) => {
                const priority = priorities[index];
                addRowToTable(regNo, startDate, endDate, priority); // Add each player's details to the table
            });

            // Optionally, clear the form after submission
            document.getElementById('form').reset();
            document.getElementById('playerContainer').innerHTML = ''; // Reset the players container
            // Add an initial player input group back
            const initialPlayerGroup = document.createElement('div');
            initialPlayerGroup.classList.add('playerGroup');
            
            const initialRegNoInput = document.createElement('input');
            initialRegNoInput.type = 'text';
            initialRegNoInput.classList.add('regNo');
            initialRegNoInput.placeholder = 'Enter Registration No';
            initialPlayerGroup.appendChild(initialRegNoInput);
            
            const initialPriorityInput = document.createElement('input');
            initialPriorityInput.type = 'text';
            initialPriorityInput.classList.add('priority');
            initialPriorityInput.placeholder = 'Priority (1-5)';
            initialPlayerGroup.appendChild(initialPriorityInput);

            document.getElementById('playerContainer').appendChild(initialPlayerGroup);
        } else {
            alert('Please enter at least one player\'s registration number and priority');
        }
    });

    // Function to add the submitted details to the table
    function addRowToTable(regNo, startDate, endDate, priority) {
        const tableBody = document.getElementById('detailsTable').getElementsByTagName('tbody')[0];
        
        const newRow = tableBody.insertRow();
        newRow.insertCell(0).textContent = regNo;
        newRow.insertCell(1).textContent = startDate;
        newRow.insertCell(2).textContent = endDate;
        newRow.insertCell(3).textContent = priority;
    }
});
