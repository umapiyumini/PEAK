<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-1.0">
        <link rel="stylesheet" href="<?=ROOT?>/assets/css/uma/facility.css">
        
        <title>External User Dashboard</title>
    </head>


    <body>
        <!-- navigation bar -->
        <?php include 'enav.view.php'; ?>
        <div class="main">
        <?php include 'top.view.php'; ?>

        <div class="main1">
                <!-- Page Title -->
                <div class="page-title">
                    <h1>Explore Our Facilities</h1>
                    <p>Choose the perfect space for your next event or activity!</p>
                </div>
        
               <!-- Facility Grid -->
               <div class="facility-grid">
                    <?php foreach ($courts as $court): ?>
                        <div class="facility-card">
                            <div class="overlay"></div>
                                <img src="<?=  $court->image ?>" alt="<?= htmlspecialchars($court->name) ?>">
                                <h3><?= htmlspecialchars($court->name) ?></h3>
                                <p><?= htmlspecialchars($court->description) ?></p>
                                <a href="<?= strtolower(str_replace(' ', '', $court->name)) ?>form">
                                <button >Book</button>
                                </a>
                            </div>
                    <?php endforeach; ?>
                </div>

        
            
        </body>
        </html>