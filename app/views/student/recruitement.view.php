
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Recruitment Requests</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: #f5f5f5;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            margin-left: 220px;
        }

        .card {
            background-color: white;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        h2 {
            font-size: 22px;
            margin-bottom: 15px;
            color: #003366;
        }

        .add-btn {
            background-color: #0066cc;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-bottom: 20px;
        }

        .add-btn:hover {
            background-color: #004c99;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f8f9fa;
            color: #333;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .action-btn {
            padding: 6px 12px;
            margin: 0 3px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            color: white;
        }

        .view-btn {
            background-color: #28a745;
        }

        .view-btn:hover {
            background-color: #218838;
        }

        .delete-btn {
            background-color: #dc3545;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }

        .empty-state {
            text-align: center;
            padding: 40px 0;
            color: #6c757d;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
        }

        .modal-content {
            background-color: white;
            margin: 10% auto;
            padding: 20px;
            border-radius: 8px;
            width: 50%;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .close {
            float: right;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
            color: #aaa;
        }

        .close:hover {
            color: black;
        }

        .modal h3 {
            margin-bottom: 10px;
        }

        .modal p {
            margin: 8px 0;
        }
    </style>
</head>
<body>
    <?php include 'nav.view.php'; ?>

    <div class="container">
        <div class="card">
            <h2>Recruitment Request Portal</h2>
            <button class="add-btn" onclick="(window.location.href='<?= ROOT ?>/student/Addrecruitement')">Add Recruitment Request</button>

            <h3>Your Recruitment Requests</h3>
            <div id="requestsTable">
                <table>
                    <thead>
                        <tr>
                            <th>Request ID</th>
                            <th>Faculty</th>
                            <th>Year of Study</th>
                            <th>Contact Number</th>
                            <th>University Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <?php if(!empty($recruitmentRequests)):?>
                            <?php foreach($recruitmentRequests as $request): ?>
                                <tr>
                                    <td><?= $request->request_id ?></td>
                                    <td><?= $request->faculty ?></td>
                                    <td><?= $request->year_of_study ?></td>
                                    <td><?= $request->contact_number ?></td>
                                    <td><?= $request->university_email ?></td>
                                    <td>
                                        <button class="action-btn view-btn" 
                                            onclick="openModal(
                                                '<?= $request->request_id ?>',
                                                '<?= htmlspecialchars($request->faculty, ENT_QUOTES) ?>',
                                                '<?= $request->year_of_study ?>',
                                                '<?= $request->contact_number ?>',
                                                '<?= htmlspecialchars($request->university_email, ENT_QUOTES) ?>'
                                            )">View</button>
                                        <button class="action-btn delete-btn" onclick="confirmDelete(<?= $request->request_id ?>)">Delete</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif;?>
                    </tbody>
                </table>
            </div>

            <div id="emptyState" class="empty-state" style="display: none;">
                <p>You don't have any recruitment requests yet.</p>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="viewModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h3>Recruitment Request Details</h3>
            <p><strong>Request ID:</strong> <span id="modalRequestID"></span></p>
            <p><strong>Faculty:</strong> <span id="modalFaculty"></span></p>
            <p><strong>Year of Study:</strong> <span id="modalYear"></span></p>
            <p><strong>Contact Number:</strong> <span id="modalContact"></span></p>
            <p><strong>University Email:</strong> <span id="modalEmail"></span></p>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this recruitment request?")) {
                window.location.href = `<?= ROOT ?>/student/Recruitment/delete?request_id=${id}`;
            }
        }

        function openModal(id, faculty, year, contact, email) {
            document.getElementById('modalRequestID').innerText = id;
            document.getElementById('modalFaculty').innerText = faculty;
            document.getElementById('modalYear').innerText = year;
            document.getElementById('modalContact').innerText = contact;
            document.getElementById('modalEmail').innerText = email;
            document.getElementById('viewModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('viewModal').style.display = 'none';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('viewModal');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        function checkIfEmpty() {
            const tableBody = document.getElementById('tableBody');
            if (tableBody.children.length === 0) {
                document.getElementById('requestsTable').style.display = 'none';
                document.getElementById('emptyState').style.display = 'block';
            }
        }

        checkIfEmpty();
    </script>
</body>
</html>
