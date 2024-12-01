

document.addEventListener('DOMContentLoaded', () => {
    // DOM Elements
    const customerTable = document.getElementById('customerTable');
    const searchInput = document.getElementById('searchInput');

    // Sample initial data
    let customerData = [
        { id: 1, name: 'emma', company: 'colts club', nic: '9876543', email: 'nsdjfb@gmail.com', contact_no: 76543, address: 'dejhgey' },
        { id: 2, name: 'john', company: 'abc', nic: '98765d3', email: 'nsdffb@gmail.com', contact_no: 87636576, address: 'dejkfbi' },
        { id: 3, name: 'Amantha srikantha', company: 'abc', nic: '98765d376543', email: 'nsdfjhfrfghyhtgrffb@gmail.com', contact_no: 87636576546, address: '227/10 gemunu mawatha maharagama' },
        { id: 4, name: 'MHM Hamdi', company: 'abc', nic: '98765d3', email: 'nsdffb@gmail.com', contact_no: 87636576, address: 'dejkfbi' }
    ];

    // Render table
    function renderTable(data = customerData) {
        const tbody = document.querySelector('#customerTable tbody');
        tbody.innerHTML = ''; // Clear existing rows

        data.forEach(customer => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${customer.id}</td>
                <td>${customer.name}</td>
                <td>${customer.company}</td>
                <td>${customer.nic}</td>
                <td>${customer.email}</td>
                <td>${customer.contact_no}</td>
                <td>${customer.address}</td>
                <td class="view"><button class="btn btn-view" onclick="window.location.href='external_Profile';"><i class="uil uil-eye"></i></button></td>
            `;
            tbody.appendChild(tr);
        });

        updateCustomerCounters();
    }

    // Optional: Update customer counter
    function updateCustomerCounters() {
        console.log(`Total Customers: ${customerData.length}`);
    }

    // Initial table rendering
    renderTable();

    // Search functionality
    searchInput.addEventListener('input', function (e) {
        const searchTerm = e.target.value.toLowerCase();
        const filteredData = customerData.filter(customer =>
            customer.name.toLowerCase().includes(searchTerm) ||
            customer.company.toLowerCase().includes(searchTerm)
        );
        renderTable(filteredData);
    });
});
