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

body {
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

h2 {
    font-size: 24px;
    margin: 20px;
}

.input-field {
    margin-bottom: 20px;
}

.input-field label {
    font-size: 16px;
    color: #555;
}

.input-field input {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
}

</style>
</head>
<body>

<?php include 'nav.view.php';?>

<main class="main-content">
    <h2>Sport Requests with Student Details</h2>

    <table class="inventory-table">
        <thead>
            <tr>
                <th>Sport Name</th>
                <th>Student Details (Registration No.)</th>
                <th>Priority (1-5)</th>
                <th>Starting Date</th>
                <th>End Date</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Badminton</td>
                <td>John Doe (20210001)</td>
                <td>5</td>
                <td>Jan 1, 2024</td>
                <td>Jan 15, 2024</td>
            </tr>
            <tr>
                <td>Volleyball</td>
                <td>Jane Smith (20210002)</td>
                <td>4</td>
                <td>Jan 10, 2024</td>
                <td>Jan 20, 2024</td>
            </tr>
            <tr>
                <td>Basketball</td>
                <td>Michael Lee (20210003)</td>
                <td>3</td>
                <td>Jan 5, 2024</td>
                <td>Jan 15, 2024</td>
            </tr>
            <tr>
                <td>Football</td>
                <td>Emily Clark (20210004)</td>
                <td>2</td>
                <td>Jan 12, 2024</td>
                <td>Jan 18, 2024</td>
            </tr>
            <tr>
                <td>Cricket</td>
                <td>James Brown (20210005)</td>
                <td>4</td>
                <td>Jan 8, 2024</td>
                <td>Jan 22, 2024</td>
            </tr>
            <tr>
                <td>Swimming</td>
                <td>Sarah White (20210006)</td>
                <td>1</td>
                <td>Jan 4, 2024</td>
                <td>Jan 14, 2024</td>
            </tr>
            <tr>
                <td>Multiple Sports</td>
                <td>Daniel Green (20210007)</td>
                <td>3</td>
                <td>Jan 3, 2024</td>
                <td>Jan 10, 2024</td>
            </tr>
        </tbody>
    </table>
</main>

</body>
</html>
