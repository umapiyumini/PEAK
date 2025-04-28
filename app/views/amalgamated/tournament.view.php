<?php
    $tournamentCards = $data['tournamentdata'];
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Tournament Requests</title>
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

        h1 {
            font-size: 28px;
            margin-bottom: 10px;
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

        .table-section {
            margin-top: 30px;
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

        .edit-btn {
            background-color: #0066cc;
        }

        .edit-btn:hover {
            background-color: #004c99;
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

        .empty-state p {
            margin-bottom: 20px;
            font-size: 18px;
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
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
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
            <h2>Tournament Entry Portal</h2>
            <button class="add-btn" onclick="(window.location.href='<?= ROOT ?>/amalgamated/Addtournament')">Add Tournament Entry</button>

            <div class="table-section">
                <h3>Your Tournament Requests</h3>
                <div id="requestsTable">
                    <table>
                        <thead>
                            <tr>
                                <th>Tournament ID</th>
                                <th>Tournament</th>
                                <th>Faculty</th>
                                <th>Category</th>
                                <th>Sport</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                        <?php if(!empty($tournamentCards)):?>
                            <?php foreach($tournamentCards as $t): ?>
                            <tr>
                                <td><?= $t->tourid  ?></td>
                                <td><?= $t->tournament ?></td>
                                <td><?= $t->faculty ?></td>
                                <td><?= $t->category ?></td>
                                <td><?= $t->Sport ?></td>
                                <td>
                                    <button class="action-btn view-btn" 
                                        onclick="openModal('<?= $t->tourid ?>',
                                         '<?= htmlspecialchars($t->tournament, ENT_QUOTES) ?>',
                                        '<?= $t->faculty ?>',
                                         '<?= $t->category ?>',
                                        '<?= $t->Sport ?>' )">
                                        View
                                    </button>
                                    <?php $Tournamentid = $t->tourid  ?>
                                    <button class="action-btn edit-btn" onclick="window.location.href='<?= ROOT ?>/student/Edittournament?Tournamentid=<?= $Tournamentid ?>'">Edit</button>
                                    <button class="action-btn delete-btn" onclick="confirmDelete(<?= $Tournamentid ?>)">Delete</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else:?>
                            <tr>
                                <td colspan="5" style="text-align: center;">No tournament entry requests to show</td>
                            </tr>
                        <?php endif; ?> 
                        </tbody>
                    </table>
                </div>

                <div id="emptyState" class="empty-state" style="display: none;">
                    <p>You don't have any tournament entry requests yet.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="viewModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h3>Tournament Request Details</h3>
            <p><strong>Tournament ID:</strong> <span id="modalID"></span></p>
            <p><strong>Tournament:</strong> 
            <select id="modaltournament" disabled >
                            
                            <option value="interfaculty">Interfaculty Tournament</option>
                            <option value="freshers">Freshers Tournament</option>
                        </select>
        </p>
            <p><strong>Faculty:</strong> 
            <select id="modalfaculty" disabled >
                            
                            <option value="UCSC">UCSC</option>
                            <option value="Management">Management</option>
                            <option value="Arts">Arts</option>
                            <option value="Technology">Technology</option>
                            <option value="Science">Science</option>
                            <option value="FIM">FIM</option>
                            <option value="FOM">FOM</option>
                            <option value="FOL">FOL</option>
                            <option value="Nursing">Nursing</option>
                            <option value="Sripalee">Sri Palee</option>
                            <option value="Education">Education</option>
                            <option value="graduate ">Graduate Studies</option>
                        </select>
        </p>

            <p><strong>Category:</strong>
            <select id="modalcategory" disabled >
                            
                            <option value="men">Men</option>
                            <option value="women">Women</option>
                        </select>
        </p>

        <p><strong>Sport:</strong>
        <select id="modalSport" disabled >
                            <option value="">-- Select Tournament Type --</option>
                            <option value="football">FootBall</option>
                            <option value="cricket">Cricket</option>
                            <option value="hockey">Hockey</option>
                            <option value="carrom">Carrom</option>
                        </select>
        </div>
    </div>

   

    <script>
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this request?")) {
                window.location.href = `<?= ROOT ?>/amalgamated/Tournament/delete?Tournamentid=${id}`;
            }
        }

        function openModal(id, tournament, faculty, category,sport) {
            document.getElementById('modalID').innerText = id;
            document.getElementById('modaltournament').value = tournament.toLowerCase();
            document.getElementById('modalfaculty').value = faculty;
            document.getElementById('modalcategory').value = category.toLowerCase();
            document.getElementById('modalSport').value = sport.toLowerCase();

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

        function deleteRow(btn) {
            if (confirm('Are you sure you want to delete this tournament entry?')) {
                const row = btn.closest('tr');
                row.remove();
                checkIfEmpty();
            }
        }

        function checkIfEmpty() {
            const tableBody = document.getElementById('tableBody');
            if (tableBody.children.length === 0) {
                document.getElementById('requestsTable').style.display = 'none';
                document.getElementById('emptyState').style.display = 'block';
            }
        }
    </script>
</body>
</html>
