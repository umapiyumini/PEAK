<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upload Rules and Regulations</title>
  <style>
    /* Main Content Styles */
    .main-content {
        flex-grow: 1;
        margin-left: 220px;
        padding: 30px;
        background-color: #ffffff;
        border-radius: 10px;
        min-height: 100vh;
        color: #333;
    }

    h1 {
        font-size: 28px;
        margin-bottom: 10px;
        color: #4B0082;
    }

    .subtext {
        color: #6c757d;
        font-size: 16px;
        margin-bottom: 30px;
    }

    h2 {
        font-size: 22px;
        color: #4B0082;
        margin-bottom: 15px;
    }

    .upload-section {
        background-color: #fff;
        padding: 20px;
        margin-bottom: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn {
        padding: 12px 30px;
        font-size: 16px;
        font-weight: bold;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-blue {
        background-color: #9370DB;
        color: white;
    }

    .btn-blue:hover {
        background-color: #6a4ea3;
    }

    .btn-upload {
        background-color: #9370DB;
        color: #fff;
        padding: 12px 30px;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
        margin-top: 20px;
    }

    .btn-upload:hover {
        background-color: #6a4ea3;
    }

    .file-input {
        width: calc(100% - 110px);
        padding: 10px;
        font-size: 14px;
        margin-top: 10px;
        margin-right: 10px;
        border: 2px solid #ccc;
        border-radius: 5px;
        transition: border 0.3s;
    }

    .file-input:focus {
        border-color: #9370DB;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .container {
            flex-direction: column;
        }

        .sidebar {
            width: 100%;
            margin-bottom: 20px;
        }

        .main-content {
            margin-left: 0;
        }
    }
  </style>
</head>
<body>

<?php include 'nav.view.php'; ?>

<main class="main-content">
  <h1>Upload Rules and Regulations</h1>
  <p class="subtext">Upload and update the rules and regulations for the Colours Night awarding ceremony for outstanding performance in sports</p>

  <section class="upload-section">
    <h2>Upload Rules and Regulations</h2>
    <label for="upload-file">Upload PDF file</label>
    <input type="file" id="upload-file" class="file-input">
    <button class="btn btn-upload" onclick="handleUpload()">Upload</button>
  </section>
</main>

<script>
function handleUpload() {
    const fileInput = document.getElementById('upload-file');
    if (fileInput.files.length === 0) {
        alert("Please select a file to upload!");
    } else {
        alert("Uploaded successfully!");
    }
}
</script>

</body>
</html>
