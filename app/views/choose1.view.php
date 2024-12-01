<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose a Role</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #e6e6fa, #9370db);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }

        .title {
            color: #5a2d81;
            font-size: 2.5rem;
            margin-bottom: 40px;
            text-align: center;
        }

        .container {
            display: flex;
            gap: 30px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .card {
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            width: 250px;
            height: 350px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 20px;
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 20px rgba(0,0,0,0.15);
        }

        .card h2 {
            color: #5a2d81;
            margin-bottom: 15px;
        }

        #executive-card {
            border-top: 5px solid #7a4ebf;
        }

        #sports-card {
            border-top: 5px solid #9370db;
        }

        #student-card {
            border-top: 5px solid #ba55d3;
        }
    </style>
</head>
<body>
    <h1 class="title">Choose a Role</h1>
    <div class="container">
        <a href="amalgamated/home" id="executive-card" class="card">
            <h2>Amalgamated Club Executive</h2>
            <p>Manage and lead club activities with strategic oversight.</p>
        </a>
        <a href="sportscaptain/sportcaptainhome" id="sports-card" class="card">
            <h2>Sports Captain</h2>
            <p>Lead and motivate sports teams to excellence.</p>
        </a>
        <a href="student/home" id="student-card" class="card">
            <h2>Student</h2>
            <p>Engage in academic and extracurricular activities.</p>
        </a>
    </div>
</body>
</html>