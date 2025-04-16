<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-1.0">
        <link rel="stylesheet" href="<?=ROOT?>/assets/css/uma/prices.css">
        <title>External User Dashboard</title>
    </head>


    <body>
        <!-- navigation bar -->
        <?php include 'enav.view.php'; ?>
        <div class="main">
        <?php include 'top.view.php'; ?>

        
        <div class="container1">
    <h1 class="title1">Select a Facility to Reserve</h1>
    <div class="cards">
        <?php foreach ($courts as $court): ?>
        <div class="card">
            <h2><?= htmlspecialchars($court->name) ?></h2>
            <img src="<?= $court->image ?>" alt="<?= htmlspecialchars($court->name) ?>" class="card-image">
            <p><?= htmlspecialchars($court->description) ?></p>

            <a href="<?= strtolower(str_replace(' ', '', $court->name)) ?>form">
                <button onclick="reserveFacility('<?= htmlspecialchars($court->name) ?>')">Book</button>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
</div>





        
        
    </body>
</html>