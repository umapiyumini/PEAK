<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Page</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        header {
            background-color:purple;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-bottom: 30px;
            margin-left: 220px;
        }
       
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            margin-left: 240px;
        }
        .sports-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }
        .sport-card {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            margin-bottom: 25px;
        }
        .sport-card:hover {
            transform: translateY(-5px);
        }
        .sport-image {
            width: 100%;
            height: 200px;
            background-color: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        .sport-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .sport-name {
            padding: 15px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }
        .coaches-button {
            display: block;
            width: 200px;
            margin: 0 auto 40px;
            padding: 12px 0;
            background-color: #e53935;
            color: white;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .coaches-button:hover {
            background-color: #c62828;
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
<header>
    
    <h2 style=>Welcome to Sports Blog</h2>
</header>


<div class="container">
    <div class="sports-grid">
        <div class="sport-card">
            <a href="<?=ROOT ?>/student/Swimming">
                <div class="sport-image">
                    <img src="/api/placeholder/400/320" alt="Basketball player dunking" />
                </div>
            </a>
            <div class="sport-name">Basketball</div>
        </div>
        
        <div class="sport-card">
            <a href="<?=ROOT ?>/student/Swimming">
                <div class="sport-image">
                    <img src="/api/placeholder/400/320" alt="Soccer player kicking ball" />
                </div>
            </a>
            <div class="sport-name">Soccer</div>
        </div>
        
        <div class="sport-card">
            <a href="<?=ROOT ?>/student/Swimming">
                <div class="sport-image">
                    <img src="/api/placeholder/400/320" alt="Tennis player serving" />
                </div>
            </a>
            <div class="sport-name">Tennis</div>
        </div>
        
        <div class="sport-card">
            <a href="<?=ROOT ?>/student/Swimming">
                <div class="sport-image">
                    <img src="/api/placeholder/400/320" alt="Swimming competition" />
                </div>
            </a>
            <div class="sport-name">Swimming</div>
        </div>
        
        <div class="sport-card">
            <a href="<?=ROOT ?>/student/Swimming">
                <div class="sport-image">
                    <img src="/api/placeholder/400/320" alt="Baseball player batting" />
                </div>
            </a>
            <div class="sport-name">Baseball</div>
        </div>
    </div>

   
</div>

</body>

