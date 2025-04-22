<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Medical Requests</title>
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
        
        .header {
            background-color: #003366;
            color: white;
            padding: 20px 0;
            text-align: center;
            margin-bottom: 30px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
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
            margin-bottom: 20px;
            color: #003366;
        }
        
        .action-buttons {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        
        .btn {
            display: inline-block;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        
        .btn-back {
            background-color: #6c757d;
            color: white;
        }
        
        .btn-back:hover {
            background-color: #5a6268;
        }
        
        .btn-add {
            background-color: #0066cc;
            color: white;
        }
        
        .btn-add:hover {
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
        
        .status-pending {
            color: #ffc107;
            font-weight: bold;
        }
        
        .status-approved {
            color: #28a745;
            font-weight: bold;
        }
        
        .status-rejected {
            color: #dc3545;
            font-weight: bold;
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
    </style>
</head>
<body>

<?php include 'nav.view.php';?>

   
    
    <div class="container">
        <div class="card">
            <h2>Your Medical Requests</h2>
            
            <div class="action-buttons">
                <a href="index.html" class="btn btn-back">Back to Dashboard</a>
                <a href="add-medical-request.html" class="btn btn-add">Add New Request</a>
            </div>
            
            <div id="requestsTable">
                <table>
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Registration ID</th>
                            <th>Reason for Medical</th>
                            <th>Duration</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John Smith</td>
                            <td>ST12345</td>
                            <td>Ankle sprain during football practice</td>
                            <td>2 weeks</td>
                            <td><span class="status-pending">Pending</span></td>
                            <td>
                                <button class="action-btn edit-btn" onclick="editRequest(1)">Edit</button>
                                <button class="action-btn delete-btn" onclick="deleteRequest(1)">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Sarah Johnson</td>
                            <td>ST67890</td>
                            <td>Respiratory infection</td>
                            <td>1 week</td>
                            <td><span class="status-approved">Approved</span></td>
                            <td>
                                <button class="action-btn edit-btn" onclick="editRequest(2)">Edit</button>
                                <button class="action-btn delete-btn" onclick="deleteRequest(2)">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Michael Lee</td>
                            <td>ST54321</td>
                            <td>Annual sports physical checkup</td>
                            <td>1 day</td>
                            <td><span class="status-rejected">Rejected</span></td>
                            <td>
                                <button class="action-btn edit-btn" onclick="editRequest(3)">Edit</button>
                                <button class="action-btn delete-btn" onclick="deleteRequest(3)">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Empty state (hidden by default) -->
            <div id="emptyState" class="empty-state" style="display: none;">
                <p>You don't have any medical requests yet.</p>
                <a href="add-medical-request.html" class="btn btn-add">Create Your First Request</a>
            </div>
        </div>
    </div>
    
    <script>
        function editRequest(id) {
            // In a real application, this would redirect to an edit page with the request ID
            window.location.href = 'edit-medical-request.html?id=' + id;
        }
        
        function deleteRequest(id) {
            // In a real application, this would send a delete request to the server
            if (confirm('Are you sure you want to delete this medical request?')) {
                alert('Request deleted successfully');
                // Here you would remove the row from the table or refresh the data
            }
        }
        
        // Check if there are requests (for demo purposes)
        function checkForEmptyState() {
            const tableRows = document.querySelector('#requestsTable tbody').getElementsByTagName('tr');
            if (tableRows.length === 0) {
                document.getElementById('requestsTable').style.display = 'none';
                document.getElementById('emptyState').style.display = 'block';
            }
        }
        
        // Call this function when page loads
        // checkForEmptyState();
    </script>
</body>
</html>