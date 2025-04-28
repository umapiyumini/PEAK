<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Chart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 110px 0px 0px 200px;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        header {
            color: rgb(0, 0, 0);
            padding: 20px;
            padding-bottom: 0px;
            text-align: center;
        }

        main {
            margin-left:20px;
            margin-top: 0;
        }

        .controls {
            margin-bottom: 20px;
            display: flex;
            justify-content: flex-start;
            margin-left: 20px;
            margin-top: 20px;
        }

        #search-bar {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 50%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            margin-left: 20px; /* Aligning table to the left with margin of 20px */
        }

        table th, table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #5a2e8a;
            color: white;
        }

        .present {
            background-color: #d4edda;
            color: #155724;
            font-weight: bold;
        }

        .absent {
            background-color: #f8d7da;
            color: #721c24;
            font-weight: bold;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        h2{
            margin: 20px;
        }

    </style>
</head>
<body>


    <?php include 'nav.view.php'; ?>
    <main>
   
    <h2>Attendance List</h2>
        <div class="controls">

        
        <div id="venue-container">
    <select id="venue">
        <option value="">Select Venue</option>
        <option value="Ground">Ground</option>
        <option value="Indoor Stadium">Indoor Stadium</option>
        <option value="Basket ball court">Basket ball court</option>
        <option value="Tennis court">Tennis court</option>
    </select>
</div>

       
        
            
            <input type="text" id="search-bar" placeholder="Search by player name..." onkeyup="filterTable()">
        </div>
        <table id="attendance-chart">
            <thead>
                <tr>
                    <th>Player Name</th>
                    <th>2024-11-22</th>
                    <th>2024-11-23</th>
                    <th>2024-11-24</th>
                    <th>2024-11-25</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Vidusha</td>
                    <td class="present">Present</td>
                    <td class="absent" title="Sick">Absent</td>
                    <td class="present">Present</td>
                    <td class="absent" title="Sick">Absent</td>
                </tr>
                <tr>
                    <td>Sanudie</td>
                    <td class="present">Present</td>
                    <td class="present">Present</td>
                    <td class="absent" title="Sick">Absent</td>
                    <td class="present">Present</td>
                </tr>
                <tr>
                    <td>Amar</td>
                    <td class="absent" title="Sick">Absent</td>
                    <td class="absent" title="Sick">Absent</td>
                    <td class="present">Present</td>
                    <td class="present">Present</td>
                </tr>
            </tbody>
        </table>
    </main>

    <script>
        function filterTable() {
            const searchInput = document.getElementById("search-bar").value.toLowerCase();
            const table = document.getElementById("attendance-chart");
            const rows = table.getElementsByTagName("tr");

            for (let i = 1; i < rows.length; i++) { // Start from 1 to skip the header row
                const playerName = rows[i].getElementsByTagName("td")[0]?.textContent.toLowerCase();
                rows[i].style.display = playerName.includes(searchInput) ? "" : "none";
            }
        }
    </script>
</body>
</html>