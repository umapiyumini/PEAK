<?php
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Certificate Requests</title>
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
            <h2>Certificate Request Portal</h2>
            <button class="add-btn" onclick="(window.location.href='<?= ROOT ?>/student/Addmedical')">Add Certificate</button>

            <div class="table-section">
                <h3>Your Certificate Requests</h3>
                <div id="requestsTable">
                    <table>
                        <thead>
                            <tr>
                                <th>Request ID</th>
                                <th>Sport</th>
                                <th>Year</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <?php foreach($certificateRequests as $certificateRequest): ?>
                            <tr>
                                <td><?= $certificateRequest->RequestID ?></td>
                                <td><?= $certificateRequest->ReasonForMedical ?></td>
                                <td><?= $certificateRequest->TimePeriod ?></td>
                                <td>
                                    <button class="action-btn view-btn" 
                                        onclick="openModal('<?= $certificateRequest->RequestID ?>', '<?= htmlspecialchars($certificateRequest->ReasonForMedical, ENT_QUOTES) ?>', '<?= $certificateRequest->TimePeriod ?>')">
                                        View
                                    </button>
                                    <?php $RequestId = $certificateRequest->RequestID ?>
                                    <button class="action-btn edit-btn" onclick="window.location.href='<?= ROOT ?>/student/Editmedical?RequestId=<?= $RequestId ?>'">Edit</button>
                                    <button class="action-btn delete-btn" onclick="confirmDelete(<?= $RequestId ?>)">Delete</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div id="emptyState" class="empty-state" style="display: none;">
                    <p>You don't have any certificate requests yet.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="viewModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h3>Certificate Request Details</h3>
            <p><strong>Request ID:</strong> <span id="modalRequestID"></span></p>
            <p><strong>Sport:</strong> <span id="modalReason"></span></p>
            <p><strong>Year:</strong> <span id="modalDuration"></span></p>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this request?")) {
                window.location.href = `<?= ROOT ?>/student/Medical/delete?RequestId=${id}`;
            }
        }

        function openModal(id, reason, duration) {
            document.getElementById('modalRequestID').innerText = id;
            document.getElementById('modalReason').innerText = reason;
            document.getElementById('modalDuration').innerText = duration;
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
    </script>
</body>
</html>
