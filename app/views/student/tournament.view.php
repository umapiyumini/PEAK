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
            
            .cancel-btn {
                background-color: #6c757d;
                color: white;
                padding: 12px 24px;
                border: none;
                border-radius: 5px;
                font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            align-self: flex-start;
            margin-top: 10px;
            margin-left: 20px; ;
        }
        
        .cancel-btn:hover {
            background-color: #5a6268;
        }
        
        .button-group {
            display: flex;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<?php include 'nav.view.php';?>

    <div class="container">
        <div class="card">
            <h2>Tournament Entry Form</h2>
            
            <div class="form-container">
                <form id="sportRegistrationForm" onsubmit="return validateForm()">
                    <div class="form-group">
                        <label for="sportType">Torunament Type:</label>
                        <select id="sportType" name="sportType" required>
                            <option value="">-- Select Tournament Type --</option>
                            <option value="interfaculty_freshers">Interfaculty Freshers Tournament</option>
                            <option value="interfaculty_tournament">Interfaculty Tournament</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="faculty">Faculty:</label>
                        <select id="faculty" name="faculty" required>
                            <option value="">-- Select Faculty --</option>
                            <option value="UCSC">UCSC</option>
                            <option value="FMF">FMF</option>
                            <option value="FOA">FOA</option>
                            <option value="FOT">FOT</option>
                            <option value="UCIARS">UCIARS</option>
                            <option value="FIM">FIM</option>
                            <option value="FOM">FOM</option>
                            <option value="FOL">FOL</option>
                            <option value="FON">FON</option>
                            <option value="Sripalee">Sripalee Campus</option>
                        </select>
                    </div>
                    
                    
                    
                    <div class="form-group">
                        <label for="registrationNumber">Registration Number:</label>
                        <input type="text" id="registrationNumber" name="registrationNumber" placeholder="Enter registration number" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="year">Year:</label>
                        <input type="text" id="year" name="year" placeholder="Enter your year " required>
                    </div>
                    
                    
                    <div class="button-group">
                        <button type="submit" class="submit-btn">Submit Registration</button>
                        <button type="button" class="cancel-btn" onclick="resetForm()">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        function validateForm() {
            // Get form values
            const sportType = document.getElementById('sportType').value;
            const faculty = document.getElementById('faculty').value;
            const studentName = document.getElementById('studentName').value;
            const registrationNumber = document.getElementById('registrationNumber').value;
            const year = document.getElementById('year').value;
            
            // Basic validation
            if (!sportType || !faculty || !studentName || !registrationNumber || !year) {
                alert('Please fill in all fields');
                return false;
            }
            
            // If validation passes
            alert('Form submitted successfully!');
            // In a real application, you would submit the form data to the server here
            
            return false; // Prevent actual form submission for this demo
        }
        
        function resetForm() {
            document.getElementById('sportRegistrationForm').reset();
        }
    </script>
</body>
</html>