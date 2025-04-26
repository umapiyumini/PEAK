<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-1.0">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/uma/prices.css">
    <title>Discount Policies</title>
</head>
<body>
    <?php include 'enav.view.php'; ?>
    <div class="main">
        <?php include 'top.view.php'; ?>
        <div class="container1">
            <h1 class="title1">Discount Policies</h1>
            <div class="cards">
                <div class="card">
                    <h2>State Universities</h2>
                    <p>
                        <?= htmlspecialchars($discounts['State Universities'] * 100) ?>% Discount will be given for State Universities.
                    </p>
                </div>
                <div class="card">
                    <h2>Registered Student Clubs & Associations</h2>
                    <p>
                        <?= htmlspecialchars($discounts['Registered Student Clubs & Associations'] * 100) ?>% Discount will be given for registered Student Clubs and Alumni Associations for tournament/matches/sports festivals organized for outsiders.
                    </p>
                </div>
                <div class="card">
                    <h2>Government Schools</h2>
                    <p>
                        <?= htmlspecialchars($discounts['Government Schools'] * 100) ?>% Discount for tournament/matches/sports festivals.
                    </p>
                </div>
                <div class="card">
                    <h2>Semi-Government Schools</h2>
                    <p>
                        <?= htmlspecialchars($discounts['Semi-Government Schools'] * 100) ?>% Discount for tournament/matches/sports festivals.
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
