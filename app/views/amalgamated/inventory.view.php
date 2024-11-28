<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inventory Requests</title>
<link rel="stylesheet" href="<?=ROOT?>/assets/css/amar/amalgamated/inventory.css">
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
