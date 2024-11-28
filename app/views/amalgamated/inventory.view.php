<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inventory Requests</title>

<style>
    /* styles.css */

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body
{
    background-color: #f4f7fb;

}


.container {
    display: flex;
    min-height: 100vh;
}

.sidebar {
    width: 250px;
    background-color: #eef2f7;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
}

.sidebar nav ul {
    list-style-type: none;
    width: 100%;
}

.sidebar nav ul li a {
    text-decoration: none;
    color: #333;
    display: block;
    padding: 10px;
    border-radius: 5px;
    font-weight: 500;
}

.sidebar nav ul li a.active,
.sidebar nav ul li a:hover {
    background-color: #dde6f2;
}

.new-request-btn {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    margin-top: 20px;
    border-radius: 5px;
    cursor: pointer;
}



.main-content {
    flex: 1;
    padding: 20px;
    margin-left: 230px;
    margin-top: 10px;
}

.main-content h1 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
}

.inventory-table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.inventory-table thead {
    background-color: #f4f4f4;
    font-weight: 600;
}

.inventory-table th,
.inventory-table td {
    padding: 15px;
    text-align: left;
    color: #555;
}

.inventory-table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

.status {
    padding: 5px 10px;
    border-radius: 5px;
    font-weight: bold;
    color: #fff;
}

.status.pending {
    background-color: #9370DB;
}

.status.approved {
    background-color: #4B0082;
}

.status.in-progress {
    background-color: #D8BFD8;
}

.status.declined {
    background-color: #800080;
}


h2{
    font-size: 24px;
    margin: 20px;
}

</style>
</head>
<body>

<?php include 'nav.view.php';?>

    
        
        <main class="main-content">
            <table class="inventory-table">
                <h2>Inventory Requests Status</h2>
                <thead>
                    <tr>
                        <th>Requester</th>
                        <th>Date</th>
                        <th>Items</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Badminton</td>
                        <td>Jan 30</td>
                        <td>6x Shuttle</td>
                        <td><span class="status pending">Pending</span></td>
                    </tr>
                    <tr>
                        <td>Volleyball</td>
                        <td>Jan 30</td>
                        <td>1x Net</td>
                        <td><span class="status approved">Approved</span></td>
                    </tr>
                    <tr>
                        <td>Basketball</td>
                        <td>Jan 25</td>
                        <td>2x Basketballs</td>
                        <td><span class="status in-progress">In Progress</span></td>
                    </tr>
                    <tr>
                        <td>Soccer</td>
                        <td>Jan 20</td>
                        <td>1x Goal</td>
                        <td><span class="status approved">Approved</span></td>
                    </tr>
                    <tr>
                        <td>Baseball</td>
                        <td>Jan 15</td>
                        <td>3x Bats</td>
                        <td><span class="status declined">Declined</span></td>
                    </tr>
                    <tr>
                        <td>Swimming</td>
                        <td>Jan 10</td>
                        <td>4x Goggles</td>
                        <td><span class="status pending">Pending</span></td>
                    </tr>
                    <tr>
                        <td>Tennis</td>
                        <td>Jan 5</td>
                        <td>5x Balls</td>
                        <td><span class="status in-progress">In Progress</span></td>
                    </tr>
                </tbody>
            </table>
        </main>
       
    </div>
</body>
</html>
