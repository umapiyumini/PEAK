<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colors Night Form</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/colorsnight.css">
</head>
<body>
    <div class="navbar">
        <a href="excuse">Attendance Excuse Letter</a>
        <a href="hostal">Hostal Facilities</a>
        <a href="transport">Transport</a>
        <a href="colorsnight">Colors Night</a>
    </div>
    
    <!-- Colors Night Form -->
    <div class="container">
        <div class="colorsnight">
            <h2>Colors Night Form</h2>
            <form id="colorsnightform">
                
                <!-- Sport -->
                <div class="form-group">
                    <label for="teamName">Sport Name</label>
                    <input type="text" id="teamName" name="teamName" placeholder="Enter the sport name" required>
                </div>
                
                <!-- Gender -->
                <div class="form-group">
                    <label for="gender">Select Team Gender</label>
                    <select id="gender" name="gender" required>
                        <option value="men">Men</option>
                        <option value="women">Women</option>
                    </select>
                </div>

                <!-- Table for Student Details -->
                <div class="form-group">
                    <label>Student Details</label>
                    <table border="1" id="studentDetailsTable">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Registration Number</th>
                                <th>Inter-Uni Performance</th>
                                <th>Awards</th>
                                <th>Rewards</th>
                                <th>Merit Awards</th>
                                <th>Details</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="studentDetailsBody"></tbody>
                    </table>
                    <button type="button" class="add-btn" onclick="addStudentRow()">Add Student</button>
                </div>

                <!-- Sport Captain Registration Number -->
                <div class="form-group">
                    <label for="captainRegNo">Sport Captain Registration Number</label>
                    <input type="text" id="captainRegNo" name="captainRegNo" placeholder="Enter registration number" required>
                </div>

                <!-- Today's Date -->
                <div class="form-group">
                    <label for="todayDate">Today’s Date</label>
                    <input type="date" id="todayDate" name="todayDate" required>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="submit-btn">Submit</button>
            </form>
        </div>
    </div>

    <div id="studentModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal()">&times;</span>
            <h3 id="modalTitle">Add Student Details</h3>
            <form id="studentForm">
                <input type="hidden" id="editIndex">
                <div class="form-group">
                    <label for="studentName">Student Name</label>
                    <input type="text" id="studentName" placeholder="Enter student name" required>
                </div>
                <div class="form-group">
                    <label for="registrationNumber">Registration Number</label>
                    <input type="text" id="registrationNumber" placeholder="Enter registration number" required>
                </div>
                <div class="form-group">
                    <label for="interUniPerformance">Inter-Uni Performance</label>
                    <input type="text" id="interUniPerformance" placeholder="Enter performance">
                </div>
                
                <div class="form-group">
                    <label for="awards">Awards</label>
                    <input type="text" id="awards" placeholder="Enter awards" required>
                </div>

                <div class="form-group">
                    <label for="rewards">Rewards</label>
                    <input type="text" id="rewards" placeholder="Enter rewards" required>
                </div>
                <div class="form-group">
                    <label for="meritawards">Merit Awards</label>
                    <input type="text" id="meritawards" placeholder="Enter Merit awards" required>
                </div>
                <div class="form-group">
                    <label for="details">Details</label>
                    <input type="text" id="details" placeholder="Enter details" required>
                </div>
                <button type="button" class="submit-btn" onclick="saveStudent()">Save</button>
            </form>
        </div>
    </div>

    <script src="<?=ROOT?>/assets/js/vidusha/collorsnight.js">
        
    </script>
</body>
</html>