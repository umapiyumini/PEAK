<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tournament Records Management</title>
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/tournaments.css">
</head>
<body>

<div class="container">
    <h1>Tournament Records Management</h1>

    <!-- Category Selection Buttons -->
    <div class="category-buttons">
      <button id="interUniBtn" onclick="showCategoryForm('interUni')">Inter University</button>
      <button id="interFacultyBtn" onclick="showCategoryForm('interFaculty')">Inter Faculty</button>
      <button id="freshersBtn" onclick="showCategoryForm('freshers')">Freshers</button>
    </div>

    <!-- Form Container -->
    <div id="formContainer" class="hidden">
      <!-- Inter University Form -->
      <form id="interUniForm" class="hidden" onsubmit="handleFormSubmit(event, 'interUni')">
        <h2>Inter University</h2>
        <input type="text" placeholder="Tournament Name" required>
        <input type="number" placeholder="Year" required>
        <input type="text" placeholder="Place" required>
        <input type="text" placeholder="Venue" required>
        <input type="number" placeholder="No of Players" required>
        <textarea placeholder="Players Reg No" required></textarea>
        <button type="submit">Add Record</button>
      </form>

      <!-- Inter Faculty Form -->
      <form id="interFacultyForm" class="hidden" onsubmit="handleFormSubmit(event, 'interFaculty')">
        <h2>Inter Faculty</h2>
        <input type="text" placeholder="Tournament Name" required>
        <input type="number" placeholder="Year" required>
        <input type="text" placeholder="1st Place Faculty" required>
        <input type="text" placeholder="2nd Place Faculty" required>
        <input type="text" placeholder="3rd Place Faculty" required>
        <input type="number" placeholder="No of Players" required>
        <textarea placeholder="Players Reg No" required></textarea>
        <button type="submit">Add Record</button>
      </form>

      <!-- Freshers Form -->
      <form id="freshersForm" class="hidden" onsubmit="handleFormSubmit(event, 'freshers')">
        <h2>Freshers</h2>
        <input type="text" placeholder="Tournament Name" required>
        <input type="number" placeholder="Year" required>
        <input type="text" placeholder="1st Place Faculty" required>
        <input type="text" placeholder="2nd Place Faculty" required>
        <input type="text" placeholder="3rd Place Faculty" required>
        <input type="number" placeholder="No of Players" required>
        <textarea placeholder="Players Reg No" required></textarea>
        <button type="submit">Add Record</button>
      </form>
    </div>

    <!-- Records Tables -->
    <div id="recordsContainer">
      <h2>Inter University Records</h2>
      <table id="interUniTable">
        <thead>
          <tr>
            <th>Tournament Name</th>
            <th>Year</th>
            <th>Place</th>
            <th>Venue</th>
            <th>No of Players</th>
            <th>Players Reg No</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="interUniList"></tbody>
      </table>

      <h2>Inter Faculty Records</h2>
      <table id="interFacultyTable">
        <thead>
          <tr>
            <th>Tournament Name</th>
            <th>Year</th>
            <th>1st Place Faculty</th>
            <th>2nd Place Faculty</th>
            <th>3rd Place Faculty</th>
            <th>No of Players</th>
            <th>Players Reg No</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="interFacultyList"></tbody>
      </table>

      <h2>Freshers Records</h2>
      <table id="freshersTable">
        <thead>
          <tr>
            <th>Tournament Name</th>
            <th>Year</th>
            <th>1st Place Faculty</th>
            <th>2nd Place Faculty</th>
            <th>3rd Place Faculty</th>
            <th>No of Players</th>
            <th>Players Reg No</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="freshersList"></tbody>
      </table>
    </div>
  </div>

  <script src="<?=ROOT?>/assets/js/vidusha/tournaments.js"></script>
</body>
</html>
