<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baseball - Sports Academy</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        header {
            background-color: #0d47a1;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-bottom: 30px;
        }
        h1 {
            margin: 0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            margin-left: 240px;
        }
        .sport-details {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-bottom: 40px;
        }
        .sport-header {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }
        .sport-icon {
            width: 80px;
            height: 80px;
            background-color: #f0f0f0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            margin-right: 20px;
        }
        .sport-title {
            font-size: 28px;
            color: #0d47a1;
            margin: 0;
        }
        .sport-banner {
            width: 100%;
            height: 300px;
            background-color: #ddd;
            border-radius: 10px;
            margin-bottom: 30px;
            overflow: hidden;
        }
        .sport-banner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .sport-info {
            margin-bottom: 30px;
            line-height: 1.6;
        }
        .info-section {
            margin-bottom: 30px;
        }
        .section-title {
            font-size: 22px;
            color: #0d47a1;
            margin-bottom: 15px;
            border-bottom: 2px solid #e0e0e0;
            padding-bottom: 10px;
        }
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .team-member {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
        }
        .member-photo {
            width: 100px;
            height: 100px;
            background-color: #e0e0e0;
            border-radius: 50%;
            margin: 0 auto 15px;
        }
        .schedule-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #e0e0e0;
        }
        .button-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .back-button, .join-button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #0d47a1;
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            margin-top: 20px;
        }
        .back-button:hover, .join-button:hover {
            background-color: #0a3880;
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px 0;
        }
    </style>
</head>
<body>

<?php include 'nav.view.php';?>

<div class="container">
    <div class="button-row">
        <a href="sports" class="back-button">Back to All Sports</a>
        <a href="<?=ROOT ?>/student/Recruitement" class="join-button">Join</a>
    </div>

    <div class="sport-details">
        <div class="sport-header">
            <div class="sport-icon">⚾</div>
            <h2 class="sport-title">Baseball</h2>
        </div>

        <div class="sport-info">
            <p>Welcome to Baseball at PEAK. Baseball is a thrilling team sport that tests agility, strength, strategy, and coordination. Whether you're stepping onto the diamond for the first time or you’re a seasoned player, our sessions are designed to enhance your skills and game IQ.</p>
            <p>Training covers batting techniques, pitching mechanics, fielding drills, base running strategies, and team tactics. Our experienced coaches work with players to build both individual excellence and team synergy, preparing you for competitive matches and tournaments.</p>
        </div>

        <div class="info-section">
            <h3 class="section-title">Coaches and Captains</h3>
            <div class="team-grid">
                <div class="team-member">
                    
                    <h4>Coach Michael Carter</h4>
                    <p>Head Coach</p>
                </div>
                <div class="team-member">
                    
                    <h4>Sophia Lewis</h4>
                    <p>Assistant Coach</p>
                </div>
                <div class="team-member">
                    
                    <h4>Daniel Kim</h4>
                    <p>Team Captain</p>
                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>
