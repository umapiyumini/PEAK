<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/amar/amalgamated/rules.css">

    <title>Rules and Regulations</title>

</head>
<body>

<?php include 'nav.view.php';?>
    
        <main class="main-content">
            <h1>Rules and Regulations</h1>
            <p class="subtext">Upload and update your club's rules and regulations</p>
            
            <section class="download-section">
                <h2>Download current rules and regulations</h2>
                <button class="btn btn-blue">Download PDF</button>
            </section>

            <section class="upload-section">
                <h2>Upload new rules and regulations</h2>
                <label for="upload-file">Upload PDF file</label>
                <input type="file" id="upload-file" class="file-input">
                <button class="btn btn-upload">Upload</button>
            </section>
        </main>

        
    </div>
</body>
</html>
