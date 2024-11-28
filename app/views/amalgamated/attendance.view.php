<!DOCTYPE html>
<html lang="en">
<head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Attendance Tracker</title>
          <link rel="stylesheet" href="<?=ROOT?>/assets/css/amar/amalgamated/attendance.css">

         
        </head>
        <body>
          
        <?php include 'nav.view.php';?>
 

          <div class="container">
            <h1>Attendance Tracker</h1>
            
            <!-- Attendance Management Section -->
            <div class="attendance-controls">
              <input type="text" id="memberName" placeholder="Enter team member's name" />
              <input type="date" id="attendanceDate" />
              <button id="addMemberBtn">Add Member</button>
            </div>
            
            <!-- Filter Section -->
            <div class="filter-section">
              <select id="filterStatus">
                <option value="all">All</option>
                <option value="present">Present</option>
                <option value="absent">Absent</option>
              </select>
              <button id="applyFilterBtn">Apply Filter</button>
            </div>
            
            <!-- Attendance Table -->
            <table class="attendance-table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="attendanceTable">
                <!-- Rows will be dynamically added here -->
              </tbody>
            </table>
        
            <!-- Summary Section -->
            <div class="summary">
              <h3>Attendance Summary</h3>
              <p id="summaryText">No data available</p>
            </div>
          </div>
          
          <script>
            let attendanceData = [];

document.getElementById('addMemberBtn').addEventListener('click', () => {
  const name = document.getElementById('memberName').value.trim();
  const date = document.getElementById('attendanceDate').value;

  if (!name || !date) {
    alert('Please provide both name and date.');
    return;
  }

  attendanceData.push({ name, date, status: 'pending' });
  renderTable();
  document.getElementById('memberName').value = '';
  document.getElementById('attendanceDate').value = '';
});

document.getElementById('attendanceTable').addEventListener('click', (e) => {
  const rowIndex = e.target.dataset.index;
  if (e.target.classList.contains('presentBtn')) {
    attendanceData[rowIndex].status = 'present';
  } else if (e.target.classList.contains('absentBtn')) {
    attendanceData[rowIndex].status = 'absent';
  }
  renderTable();
});

document.getElementById('applyFilterBtn').addEventListener('click', () => {
  renderTable();
});

function renderTable() {
  const filterStatus = document.getElementById('filterStatus').value;
  const tableBody = document.getElementById('attendanceTable');
  tableBody.innerHTML = '';

  const filteredData = attendanceData.filter(item => 
    filterStatus === 'all' || item.status === filterStatus
  );

  filteredData.forEach((item, index) => {
    const row = document.createElement('tr');
    row.className = item.status;

    row.innerHTML = `
      <td>${item.name}</td>
      <td>${item.date}</td>
      <td>${item.status}</td>
      <td>
        <button class="presentBtn" data-index="${index}">Present</button>
        <button class="absentBtn" data-index="${index}">Absent</button>
      </td>
    `;
    tableBody.appendChild(row);
  });

  updateSummary();
}

function updateSummary() {
  const presentCount = attendanceData.filter(item => item.status === 'present').length;
  const absentCount = attendanceData.filter(item => item.status === 'absent').length;

  document.getElementById('summaryText').textContent = 
    `Present: ${presentCount}, Absent: ${absentCount}`;
}

          </script>
        </body>
        </html>
     
