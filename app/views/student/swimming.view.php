<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hockey</title>
    <style>
        @charset "utf-8";

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f8f8;
            color: #333;
            line-height: 1.6;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            background-color: #222;
            padding: 15px 30px;
            position: fixed;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            margin-left: 220px;
            
           
           
        }


        .navbar .sports-btn
        {
            margin-right: 220px;
        }

      

        .navbar h2 {
            color: #fff;
            font-size: 24px;
            font-weight: bold;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            background-color: #5a2e8a;
            border-radius: 5px;
            font-weight: 500;
            transition: background-color 0.3s ease, transform 0.3s ease;
            margin-right: 280px;
        }

        .navbar a:hover {
            background-color: #7a4bb8;
            transform: scale(1.05);
        }

        .content-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            padding: 120px 40px 30px;
            background-color: #f8f8f8;
            margin-left: 220px;
        }

        .main-content {
            width: 100%;
            margin-bottom: 30px;
        }

        .main-content h2 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }

        .captains {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 40px;
            margin-top: 30px;
        }

        .captains .tile2 {
            flex: 1 1 200px;
            text-align: center;
            padding: 20px;
            background-color: #fff;
            border: 2px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
            margin-bottom: 20px;
            max-width: 240px;
        }

        .captains .tile2 img {
            width: 100%;
            border-radius: 50%;
            margin-bottom: 15px;
            transition: transform 0.3s ease;
        }

        .captains .tile2 p {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            text-transform: uppercase;
        }

        .captains .tile2:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
            background-color: #e1f7e1;
        }

        .captains .tile2:hover img {
            transform: scale(1.05);
        }

        .latest-news {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            width: 100%;
        }

        .latest-news h2 {
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #222;
        }

        .news-row {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: space-between;
        }

        .news-item {
            flex: 1 1 280px;
            max-width: 400px;
            border-radius: 10px;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease, box-shadow 0.3s ease;
        }

        .news-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .news-item h3 {
            font-size: 22px;
            color: #222;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .news-item p {
            font-size: 16px;
            color: #666;
            line-height: 1.5;
            margin-bottom: 10px;
        }

        .news-item .news-date {
            font-size: 14px;
            color: #888;
            font-style: italic;
            margin-top: 10px;
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                align-items: center;
            }

            .content-container {
                flex-direction: column;
                align-items: center;
            }

            .captains .tile2 {
                margin-bottom: 20px;
                width: 100%;
            }

            .news-row {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
<?php include 'nav.view.php';?>
    
    <nav class="navbar">
        <h2>Captains and Coaches</h2>
        <a href="request" class="sports-btn">Join</a>
    </nav>

    <main>
        <section class="content-container">
            <div class="main-content">
                <h2>Captain and Vice Captain</h2>
                <article class="captains">
                    <div class="tile2">
                        <img src="http://localhost/PEAK/public/assets/images/amar/men_coach.jpg" alt="cap-men">
                        <p>Men's Captain</p>
                    </div>
                    <div class="tile2">
                        <img src="http://localhost/PEAK/public/assets/images/amar/women.png" alt="cap-women">
                        <p>Women's Captain</p>
                    </div>
                    <div class="tile2">
                        <img src="http://localhost/PEAK/public/assets/images/amar/men_coach.jpg" alt="vc-men">
                        <p>Men's Vice Captain</p>
                    </div>
                    <div class="tile2">
                        <img src="http://localhost/PEAK/public/assets/images/amar/women.png" alt="vc-women">
                        <p>Women's Vice Captain</p>
                    </div>
                </article>

                <h2>Coaches</h2>
                <article class="captains">
                    <div class="tile2">
                        <img src="http://localhost/PEAK/public/assets/images/amar/men_coach.jpg" alt="cap-men">
                        <p>Men's Coach</p>
                    </div>
                    <div class="tile2">
                        <img src="http://localhost/PEAK/public/assets/images/amar/women.png" alt="cap-women">
                        <p>Women's Coach</p>
                    </div>
                    <div class="tile2">
                        <img src="http://localhost/PEAK/public/assets/images/amar/men_coach.jpg" alt="assistant-men">
                        <p>Men's Instructor Coach</p>
                    </div>
                    <div class="tile2">
                        <img src="http://localhost/PEAK/public/assets/images/amar/women.png" alt="assistant-women">
                        <p>Women's Instructor Coach</p>
                    </div>
                </article>
            </div>

            <aside class="latest-news">
                <h2>Latest News</h2>
                <div class="news-row">
                    <div class="news-item">
                        <h3>Inter-Faculty Tournament Winners</h3>
                        <p>The hockey team from the Faculty of Science emerged as champions in the inter-faculty hockey tournament. Their teamwork and dedication set a new benchmark for sportsmanship!</p>
                        <p class="news-date">Published: November 18, 2024</p>
                    </div>
                    <div class="news-item">
                        <h3>Hockey Tournament 2024</h3>
                        <p>Congratulations to the Hockey team for an incredible performance! They clinched the title in this year’s Hockey Tournament, showcasing immense potential and talent.</p>
                        <p class="news-date">Published: November 15, 2024</p>
                    </div>
                </div>
            </aside>
        </section>
    </main>
</body>
</html>
