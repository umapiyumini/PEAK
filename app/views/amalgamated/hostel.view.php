<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tournaments Dashboard</title>
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

.container {
    display: flex;
    height: 100vh;
    background-color: #f4f7fa;
}

.sidebar {
    width: 200px;
    background-color: #e9eff5;
    padding: 20px;
}

.sidebar ul {
    list-style: none;
}

.sidebar ul li {
    padding: 15px 0;
    color: #333;
    cursor: pointer;
}

.sidebar ul li.active {
    font-weight: bold;
    color: #0077ff;
}

.content {
    flex: 1;
    padding: 30px;
    background-color: white;
}

.content h1 {
    font-size: 2em;
    margin-bottom: 10px;
}

.content p {
    color: #666;
    margin-bottom: 20px;
}

.new-tournament {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 30px;
    display: flex;
    flex-direction: column;
}

.new-tournament span {
    font-weight: bold;
}

.new-tournament p {
    margin-top: 5px;
    margin-bottom: 10px;
    color: #888;
}

.new-tournament button {
    background-color: #0077ff;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.tournaments h2 {
    font-size: 1.5em;
    margin-top: 30px;
    color: #333;
}

.tournament-card {
    display: flex;
    background-color: #D8BFD8;
    border-radius: 8px;
    overflow: hidden;
    margin: 15px 0;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-left: 220px;
}

.tournament-card img {
    width: 100px;
    height: 100px;
    object-fit: cover;
}

.tournament-card .info {
    padding: 15px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin: 2px;
}

.tournament-card .info span {
    color: #888;
    font-size: 0.9em;
}

.tournament-card .info h3 {
    font-size: 1.2em;
    color: white;
}

.tournament-card .info p {
    font-size: 0.9em;
    color: red;
    
}

.tournament-card .info button {
    background-color: #0077ff;
    color: white;
    padding: 8px 12px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 10px;
    align-self: start;
}



h2{
    text-align: center;
    margin-left: 150px;
}


    </style>
</head>
<body>

<?php include 'nav.view.php';?>

  
        </aside>
        
        <main class="content">
          
            <h2>Hostel Requests</h2>
            
            <section class="tournaments">
                <div class="tournament-card">
                    <div class="info">
                        <h3>2022/IS/002</h3>
                        <br>
                        <p>Distance: 110Km</p>
                        <p>Period: 2024:04:02 to 2024:04:11</p>
                        <p>Duration: 5 Min</p>
                    </div>
                </div>
                
                <div class="tournament-card">
                    <div class="info">
                        <h3>2022/IS/046</h3>
                        <br>
                        <p>Distance: 35 Km</p>
                        <p>Period: 2024:03:02 to 2024:03:05</p>
                        <p>Duration: 2 Min</p>
                    </div>
                </div>
                
                <div class="tournament-card">
                    <div class="info">
                        
                        <h3>2022/IS/038</h3>
                        <br>
                        <p>Distance: 12 Km</p>
                        <p>Period: 2024:06:02 to 2024:06:03</p>
                        <p>Duration: 1 Min</p>
                    </div>
                </div>
            
                </div>
            </section>
        </main>
        
    </div>
</body>
</html>
