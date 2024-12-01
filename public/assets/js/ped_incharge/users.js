// Store users in localStorage for demo purposes
        // In a real application, this would be handled by a backend database
        let users = JSON.parse(localStorage.getItem('users')) || [];

        function showSection(sectionId) {
            document.querySelectorAll('.form-section, .display-section').forEach(section => {
                section.classList.remove('active');
            });
            document.getElementById(sectionId).classList.add('active');
            document.querySelectorAll('.tab').forEach(tab => {
                tab.classList.remove('active');
            });
            event.target.classList.add('active');

            if (sectionId === 'user-display') {
                displayUsers();
            }
        }

        function handleStudentSubmit(event) {
            event.preventDefault();
            const formData = new FormData(event.target);
            const data = {
                ...Object.fromEntries(formData),
                type: 'student',
                id: Date.now().toString()
            };
            users.push(data);
            saveUsers();
            event.target.reset();
            alert('Student registered successfully!');
        }

        function handleStaffSubmit(event) {
            event.preventDefault();
            const formData = new FormData(event.target);
            const data = {
                ...Object.fromEntries(formData),
                type: 'staff',
                id: Date.now().toString()
            };
            users.push(data);
            saveUsers();
            event.target.reset();
            alert('Staff member registered successfully!');
        }

        function handleCaptainSubmit(event) {
            event.preventDefault();
            const formData = new FormData(event.target);
            const data = {
                ...Object.fromEntries(formData),
                type: 'captain',
                id: Date.now().toString()
            };
            users.push(data);
            saveUsers();
            event.target.reset();
            alert('Sport Captain assigned successfully!');
        }

        function handleExecutiveSubmit(event) {
            event.preventDefault();
            const formData = new FormData(event.target);
            const data = {
                ...Object.fromEntries(formData),
                type: 'executive',
                id: Date.now().toString()
            };
            users.push(data);
            saveUsers();
            event.target.reset();
            alert('Club Executive assigned successfully!');
        }

        function saveUsers() {
            localStorage.setItem('users', JSON.stringify(users));
            if (document.getElementById('user-display').classList.contains('active')) {
                displayUsers();
            }
        }

        function getRoleName(roleNumber) {
            const roles = {
                '1': 'Administrator',
                '2': 'Student',
                '3': 'Sports Captain',
                '4': 'Club Executive',
                '5': 'Staff Member'
            };
            return roles[roleNumber] || 'Unknown Role';
        }

        function displayUsers(filterRole = 'all') {
            const tableBody = document.getElementById('userTableBody');
            tableBody.innerHTML = '';

            const filteredUsers = filterRole === 'all' 
                ? users 
                : users.filter(user => user.roleNumber === filterRole);
            filteredUsers.forEach(user => {
                const row = document.createElement('tr');
                
                // Determine user details based on type
                let details, status;
                switch(user.type) {
                    case 'student':
                        details = `Faculty: ${user.faculty}<br>NIC: ${user.nic}`;
                        status = isActive(user.startDate, user.endDate) ? 'Active' : 'Inactive';
                        break;
                    case 'staff':
                        details = `Emp #: ${user.employeeNumber}<br>Contact: ${user.contact}`;
                        status = isActive(user.appointmentDate) ? 'Active' : 'Inactive';
                        break;
                    case 'captain':
                        details = `Sport: ${user.sport}`;
                        status = isActive(user.assignedDate, user.endDate) ? 'Active' : 'Inactive';
                        break;
                    case 'executive':
                        details = `Designation: ${user.designation}`;
                        status = isActive(user.assignedDate, user.endDate) ? 'Active' : 'Inactive';
                        break;
                }

                row.innerHTML = `
                    <td>${getRoleName(user.roleNumber)}</td>
                    <td>${user.regNumber || user.staffId || 'N/A'}</td>
                    <td>${user.email || user.name || 'N/A'}</td>
                    <td>${details}</td>
                    <td><span class="status-badge ${status.toLowerCase()}">${status}</span></td>
                    <td>
                        <button onclick="editUser('${user.id}')" class="btn btn-update"><i class="uil uil-edit"></i></button>
                        <button onclick="deleteUser('${user.id}')" class="btn btn-delete"><i class="uil uil-trash-alt"></i></button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }

        function isActive(startDate, endDate = null) {
            const now = new Date();
            const start = new Date(startDate);
            if (endDate) {
                const end = new Date(endDate);
                return now >= start && now <= end;
            }
            return now >= start;
        }

        function filterUsers(roleNumber) {
            displayUsers(roleNumber);
        }

        function editUser(userId) {
            const user = users.find(u => u.id === userId);
            if (!user) return;

            // Create a form with the user's current data
            const form = document.createElement('div');
            form.innerHTML = `
                <div class="edit-form">
                    <h3>Edit ${getRoleName(user.roleNumber)}</h3>
                    <form id="editUserForm">
                        ${getEditFormFields(user)}
                        <button type="submit" class="submit-btn">Save Changes</button>
                        <button type="button" onclick="closeEditForm()" class="cancel-btn">Cancel</button>
                    </form>
                </div>
            `;

            // Add form to page
            document.querySelector('.container').appendChild(form);

            // Handle form submission
            document.getElementById('editUserForm').onsubmit = (e) => {
                e.preventDefault();
                const formData = new FormData(e.target);
                const updatedData = Object.fromEntries(formData);
                
                // Update user data
                const userIndex = users.findIndex(u => u.id === userId);
                users[userIndex] = { ...users[userIndex], ...updatedData };
                
                saveUsers();
                closeEditForm();
            };
        }

        function getEditFormFields(user) {
            let fields = '';
            for (const [key, value] of Object.entries(user)) {
                if (key !== 'id' && key !== 'type') {
                    fields += `
                        <div class="form-group">
                            <label>${key.charAt(0).toUpperCase() + key.slice(1)}:</label>
                            <input type="${getInputType(key)}" name="${key}" value="${value}" required>
                        </div>
                    `;
                }
            }
            return fields;
        }

        function getInputType(key) {
            if (key.includes('date')) return 'date';
            if (key.includes('email')) return 'email';
            if (key === 'contact') return 'tel';
            return 'text';
        }

        function closeEditForm() {
            const form = document.querySelector('.edit-form');
            if (form) {
                form.parentElement.remove();
            }
        }

        function deleteUser(userId) {
            if (confirm('Are you sure you want to delete this user?')) {
                users = users.filter(user => user.id !== userId);
                saveUsers();
            }
        }

        // Add some additional CSS styles dynamically
        const style = document.createElement('style');
        style.textContent = `
            .status-badge {
                padding: 4px 8px;
                border-radius: 4px;
                font-size: 0.9em;
            }
            .status-badge.active {
                background-color: #e6ffe6;
                color: #008000;
            }
            .status-badge.inactive {
                background-color: #ffe6e6;
                color: #cc0000;
            }
            .edit-btn, .delete-btn {
                padding: 4px 8px;
                margin: 2px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
            .edit-btn {
                background-color: #4CAF50;
                color: white;
            }
            .delete-btn {
                background-color: #f44336;
                color: white;
            }
            .edit-form {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background: white;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
                z-index: 1000;
                max-width: 500px;
                width: 90%;
            }
            .cancel-btn {
                background: #777;
                color: white;
                border: none;
                padding: 10px 20px;
                border-radius: 4px;
                cursor: pointer;
                margin-left: 10px;
            }
        `;
        document.head.appendChild(style);

        // Initialize the display if we're on the user display section
        if (document.getElementById('user-display').classList.contains('active')) {
            displayUsers();
        }