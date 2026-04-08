<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sport Management System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            margin-left: 220px;
            padding: 20px;
        }
        
        .card {
            background-color: white;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        
        h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }
        
        h2 {
            font-size: 22px;
            margin-bottom: 15px;
            color: #003366;
        }
        
        h3 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #333;
        }
        
        p {
            margin-bottom: 15px;
            color: #555;
        }
        
        .form-container {
            display: flex;
            flex-direction: column;
            max-width: 100%;
            margin-bottom: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        
        input[type="text"],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        
        select {
            height: 45px;
            background-color: white;
        }
        
        .submit-btn {
            background-color: #0066cc;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            align-self: flex-start;
            margin-top: 10px;
        }
            
        .submit-btn:hover {
            background-color: #004c99;
        }
        
        .button-group {
            display: flex;
            margin-top: 20px;
            gap: 10px;
        }
        
        .player-section {
            margin-top: 25px;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
        
        .player-rows {
            margin-bottom: 20px;
        }
        
        .player-row {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }
        
        .player-header {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
            font-weight: bold;
        }
        
        .player-header div, .player-row div {
            padding: 5px 0;
        }
        
        .col-number {
            width: 50px;
            text-align: center;
        }
        
        .col-reg {
            flex: 1;
        }
        
        .add-row-btn {
            background-color: #28a745;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }
        
        .add-row-btn:hover {
            background-color: #218838;
        }
        
        .note {
            font-size: 14px;
            color: #666;
            margin-top: 5px;
            font-style: italic;
        }
    </style>
</head>
<body>
<?php include 'nav.view.php';?>

    <div class="container">
        <div class="card">
            <h2>Tournament Entry Form</h2>
            
            <div class="form-container">
                <form id="sportRegistrationForm" action="<?= ROOT ?>/student/Tournament/">
                    <div class="form-group">
                        <label for="sportType">Tournament Type:</label>
                        <select id="sportType" name="sportType" >
                            <option value="">-- Select Tournament Type --</option>
                            <option value="Inter Faculty">Interfaculty Tournament</option>
                            <option value="freshers">Freshers Tournament</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="faculty">Faculty:</label>
                        <select id="faculty" name="faculty" >
                            <option value="">-- Select Faculty --</option>
                            <option value="UCSC">UCSC</option>
                            <option value="Management">Management</option>
                            <option value="Arts">Arts</option>
                            <option value="Technology">Technology</option>
                            <option value="Science">Science</option>
                            <option value="Indigenous Medicine">FIM</option>
                            <option value="Medicine">FOM</option>
                            <option value="Law">FOL</option>
                            <option value="Nursing">Nursing</option>
                            <option value="Sri Palee">Sri Palee</option>
                            <option value="Education">Education</option>
                            <option value="Graduate Studies">Sripalee Campus</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="category">Category:</label>
                        <select id="category" name="category" >
                            <option value="">-- Select Category --</option>
                            <option value="men">Men</option>
                            <option value="women">Women</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
    <label for="year">Year:</label>
    <input type="text" id="year" name="year" placeholder="Enter your year">
</div>

                    
                    <!-- Players Registration Section -->
                    <div class="player-section">
                        <h3>Team Members</h3>
                        <p>Add all student registration numbers who will participate in this tournament.</p>
                        
                        <div class="player-header">
                            <div class="col-number">#</div>
                            <div class="col-reg">Registration Number</div>
                        </div>
                        
                        <div class="player-rows">
                            <!-- First row (always present) -->
                            <div class="player-row">
                                <div class="col-number">1</div>
                                <div class="col-reg">
                                    <input type="text" name="regNumber[]" placeholder="Enter registration number" >
                                </div>
                            </div>
                            
                            <!-- Additional player rows will be inserted here -->
                            <div class="player-row">
                                <div class="col-number">2</div>
                                <div class="col-reg">
                                    <input type="text" name="regNumber[]" placeholder="Enter registration number">
                                </div>
                            </div>
                            
                            <div class="player-row">
                                <div class="col-number">3</div>
                                <div class="col-reg">
                                    <input type="text" name="regNumber[]" placeholder="Enter registration number">
                                </div>
                            </div>
                            
                            <div class="player-row">
                                <div class="col-number">4</div>
                                <div class="col-reg">
                                    <input type="text" name="regNumber[]" placeholder="Enter registration number">
                                </div>
                            </div>
                            
                            <div class="player-row">
                                <div class="col-number">5</div>
                                <div class="col-reg">
                                    <input type="text" name="regNumber[]" placeholder="Enter registration number">
                                </div>
                            </div>
                        </div>
                        
                        <p class="note">* Only the first player is required. Fill in as many players as needed for your team.</p>
                    </div>
                    
                    <div class="button-group">
                        <button type="submit" class="submit-btn">Submit Registration</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        // Very minimal JavaScript - just for form validation
        document.getElementById('sportRegistrationForm').addEventListener('submit', function(e) {
            // Get all filled registration numbers
            const regFields = document.querySelectorAll('input[name="regNumber[]"]');
            
            let validPlayerCount = 0;
            
            // Count valid player entries
            for (let i = 0; i < regFields.length; i++) {
                if (regFields[i].value) {
                    validPlayerCount++;
                }
            }
            
            // Validate at least one player is entered
            if (validPlayerCount === 0) {
                alert('Please add at least one player with registration number');
                e.preventDefault();
                return false;
            }
            
            // Check that required fields are filled
            const sportType = document.getElementById('sportType').value;
            const faculty = document.getElementById('faculty').value;
            const category = document.getElementById('category').value;
            const year = document.getElementById('year').value;
            
            if (!sportType || !faculty || !category || !year) {
                alert('Please fill in all required fields');
                e.preventDefault();
                return false;
            }
        });
    </script>
</body>
</html>