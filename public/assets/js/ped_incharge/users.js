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

        function getRoleName(role) {
            const roles = {
                '1': 'Admin',
                '2': 'Internal User',
                '3': 'Sports Captain',
                '4': 'Amalgamated Club Executive',
                '5': 'GroundIndoorStaff'
            };
            return roles[role] || 'Unknown Role';
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

 

        // Initialize the display if we're on the user display section
        if (document.getElementById('user-display').classList.contains('active')) {
            displayUsers();
        }