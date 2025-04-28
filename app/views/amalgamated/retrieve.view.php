

<?php
    $tournamentreq = $data['details'];
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retrieved Data</title>
</head>
<body>
    <h2>Sport</h2>

    <?php if(!empty($tournamentreq)):?>
                            <?php foreach($tournamentreq as $tr): ?>
                            
                              
                            <p><?= $tr->Sport ?></p>
                             <?php endforeach; ?>
                            <?php else:?>
                            
            <p>not retrieve the number of sports from the tournament table</p>
        
    <?php endif; ?> 
</body>
</html>