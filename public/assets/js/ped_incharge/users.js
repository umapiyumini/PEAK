
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
                // displayUsers();
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

        if (document.getElementById('user-display').classList.contains('active')) {
            displayUsers();
        }

        function filterUsers(role) {
            const rows = document.querySelectorAll('.user-row');
            
            rows.forEach(row => {
                const userRole = row.getAttribute('data-role');
    
                if (role === 'all') {
                    row.style.display = '';
                } else {
                    if (userRole !== role) {
                        row.style.display = 'none';
                    } else {
                        row.style.display = '';
                    }
                }
            });
        }