/**
 * Sport Attendance Management JavaScript
 * Handles QR code generation, search filtering, and other attendance-related functionality
 */

// Initialize everything when the DOM is fully loaded
document.addEventListener('DOMContentLoaded', function() {
    console.log('Sport Attendance JS loaded');
    
    // Check if we have a QR button and set up event listener
    const qrButton = document.getElementById('generate-qr');
    if (qrButton) {
        qrButton.addEventListener('click', generateQRCode);
    }
    
    // Set up search functionality
    const searchBar = document.getElementById('search-bar');
    if (searchBar) {
        searchBar.addEventListener('keyup', filterTable);
    }
    
    // Initialize attendance stats if available
    calculateAndDisplayStats();
});

/**
 * Generates a QR code for attendance tracking
 * The QR code contains user ID and current date information
 */
function generateQRCode() {
    // Get user ID from session or use 'guest' as fallback
    const userId = document.querySelector('meta[name="user-id"]')?.content || 'guest';
    
    // Get current date in YYYY-MM-DD format
    const date = new Date().toISOString().slice(0, 10);
    
    // Create QR code text string with attendance info
    const qrText = `attendance|${userId}|${date}`;
    
    // Generate QR code using Google Charts API
    const qrUrl = `https://chart.googleapis.com/chart?cht=qr&chs=200x200&chl=${encodeURIComponent(qrText)}`;
    
    // Update QR image source
    const qrImage = document.getElementById('qr-image');
    if (qrImage) {
        qrImage.src = qrUrl;
        qrImage.style.display = 'block'; // Make sure it's visible
        
    }
    
    console.log("QR code generated for:", qrText);
}

/**
 * Downloads the QR code as an image
 * @param {string} imgUrl - The URL of the QR code image
 * @param {string} filename - The filename to save the image as
 */
function downloadQRCode(imgUrl, filename) {
    // Create an invisible link element
    const link = document.createElement('a');
    link.href = imgUrl;
    link.download = filename;
    
    // Append to the body, click it, and remove it
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

/**
 * Filters the attendance table based on the search input
 */
function filterTable() {
    const searchInput = document.getElementById('search-bar');
    const filter = searchInput.value.toLowerCase();
    const table = document.getElementById('attendance-chart');
    
    if (!table) return;
    
    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    
    let visibleCount = 0;
    
    // Loop through all table rows
    for (let i = 0; i < rows.length; i++) {
        const nameCell = rows[i].getElementsByTagName('td')[0];
        
        if (nameCell) {
            const name = nameCell.textContent || nameCell.innerText;
            
            // If the name includes the search term, show the row, otherwise hide it
            if (name.toLowerCase().includes(filter)) {
                rows[i].style.display = '';
                visibleCount++;
            } else {
                rows[i].style.display = 'none';
            }
        }
    }
    
    // Show a message if no results are found
    let noResultsMsg = document.getElementById('no-results-message');
    
    if (visibleCount === 0 && filter !== '') {
        if (!noResultsMsg) {
            noResultsMsg = document.createElement('p');
            noResultsMsg.id = 'no-results-message';
            noResultsMsg.className = 'no-results';
            noResultsMsg.textContent = 'No players found matching your search.';
            table.parentNode.insertBefore(noResultsMsg, table.nextSibling);
        }
    } else if (noResultsMsg) {
        noResultsMsg.remove();
    }
}

/**
 * Calculates and displays attendance statistics
 */
function calculateAndDisplayStats() {
    const table = document.getElementById('attendance-chart');
    if (!table) return;
    
    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    const headerRow = table.getElementsByTagName('thead')[0].getElementsByTagName('tr')[0];
    const cellCount = headerRow.getElementsByTagName('th').length - 1; // Exclude name column
    
    let totalPresent = 0;
    let totalCells = 0;
    
    // Calculate total present count and percentage
    for (let i = 0; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName('td');
        
        // Start from index 1 to skip the name column
        for (let j = 1; j < cells.length; j++) {
            totalCells++;
            if (cells[j].textContent.trim() === 'Present') {
                totalPresent++;
            }
        }
    }
    
    // Calculate percentage
    const attendanceRate = totalCells > 0 ? (totalPresent / totalCells) * 100 : 0;
    
    // Create or update stats container
    let statsContainer = document.getElementById('attendance-stats');
    
    if (!statsContainer) {
        statsContainer = document.createElement('div');
        statsContainer.id = 'attendance-stats';
        statsContainer.className = 'stats-container';
        
        // Insert before the table
        table.parentNode.insertBefore(statsContainer, table);
    }
    
    // Update stats content
    statsContainer.innerHTML = `
        <div class="stat-card">
            <div class="stat-value">${attendanceRate.toFixed(1)}%</div>
            <div class="stat-label">Overall Attendance Rate</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">${totalPresent}</div>
            <div class="stat-label">Total Present</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">${totalCells - totalPresent}</div>
            <div class="stat-label">Total Absent</div>
        </div>
    `;
}

/**
 * Highlights the current day's column in the attendance table
 */
function highlightCurrentDay() {
    const table = document.getElementById('attendance-chart');
    if (!table) return;
    
    const today = new Date().toISOString().slice(0, 10);
    const headerRow = table.getElementsByTagName('thead')[0].getElementsByTagName('tr')[0];
    const headers = headerRow.getElementsByTagName('th');
    
    // Loop through date headers to find today's date
    for (let i = 1; i < headers.length; i++) { // Start from 1 to skip the name column
        const headerDate = headers[i].textContent.trim();
        if (headerDate === today) {
            // Highlight the column
            highlightColumn(table, i);
            break;
        }
    }
}

/**
 * Highlights a specific column in the table
 * @param {HTMLTableElement} table - The table element
 * @param {number} columnIndex - The index of the column to highlight
 */
function highlightColumn(table, columnIndex) {
    const rows = table.getElementsByTagName('tr');
    
    for (let i = 0; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName(i === 0 ? 'th' : 'td');
        if (cells.length > columnIndex) {
            cells[columnIndex].classList.add('highlighted-column');
        }
    }
}

/**
 * Exports the attendance data to CSV format
 */
function exportToCSV() {
    const table = document.getElementById('attendance-chart');
    if (!table) return;
    
    const rows = table.getElementsByTagName('tr');
    let csvContent = "data:text/csv;charset=utf-8,";
    
    // Extract data from table
    for (let i = 0; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName(i === 0 ? 'th' : 'td');
        const rowData = [];
        
        for (let j = 0; j < cells.length; j++) {
            rowData.push(cells[j].textContent.trim());
        }
        
        csvContent += rowData.join(',') + '\r\n';
    }
    
    // Create and trigger download
    const encodedUri = encodeURI(csvContent);
    const link = document.createElement('a');
    link.setAttribute('href', encodedUri);
    link.setAttribute('download', 'attendance_data.csv');
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

/**
 * Creates a UI for adding export functionality to the page
 */
function setupExportUI() {
    const controls = document.querySelector('.controls');
    if (!controls) return;
    
    // Add export button
    const exportBtn = document.createElement('button');
    exportBtn.id = 'export-csv';
    exportBtn.textContent = 'Export to CSV';
    exportBtn.addEventListener('click', exportToCSV);
    
    controls.appendChild(exportBtn);
}

// Call setup function when page loads
document.addEventListener('DOMContentLoaded', function() {
    setupExportUI();
    highlightCurrentDay();
});