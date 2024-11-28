<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Request Forms</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/amar/medical.css">

   
</head>
<body>

<?php 
include 'nav.view.php';
?>
    

   
    
    <main class="content">
        <h1>Fill in and submit medical request forms</h1>
        
        <section class="form-section">
            <h2>Step 1: Select a form</h2>
            <ul class="form-list">
                <li>
                    Preparticipation Physical Evaluation (PPE) Form
                    <button>Select</button>
                </li>
                <li>
                    Medical History Questionnaire
                    <button>Select</button>
                </li>
               
               
            </ul>
            
            <h2>Step 2: Complete the form</h2>
        </section>
        
        <div class="actions">
            <button class="cancel-btn">Cancel</button>
            <button class="next-btn">Submit</button>
        </div>
    </main>
</body>
</html>
