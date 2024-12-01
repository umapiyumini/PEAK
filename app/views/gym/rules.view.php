<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rules and Regulations</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/rules.css">
</head>
<body>
    <div class="topic-header">Rules and Regulations</div>
    <div class="container">
        <header>
            <h1>Create and Manage Rules</h1>
        </header>

        <div class="form-section">
            <label for="title-input">Rule Title:</label>
            <input type="text" id="title-input" placeholder="Enter rule title">
            
            <label for="content-input">Rule Description:</label>
            <textarea id="content-input" placeholder="Write the rule details here..."></textarea>
            
            <div class="buttons">
                <button id="save-draft" class="save-draft">Save as Draft</button>
                <button id="publish">Publish</button>
            </div>
        </div>

        <div class="published-rules">
            <h2>Published Rules</h2>
            <div id="rules-list">
                <p>No published rules yet.</p>
            </div>
        </div>

        <div class="draft-rules">
            <h2>Draft Rules</h2>
            <div id="drafts-list">
                <p>No draft rules available.</p>
            </div>
        </div>
    </div>
    <script src="<?=ROOT?>/assets/js/vidusha/rules.js"></script>
</body>
</html>
