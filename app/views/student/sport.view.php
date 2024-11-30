<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/amar/sport.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <style>
        /* Base Styles */
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f5f5f5;
  color: #333;
}

/* Header */
header {
  background-color: #003366;
  color: white;
  padding: 10px 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  position: sticky;
  top: 0;
  z-index: 1000;
}

.header-container {
  display: flex;
  align-items: center;
  gap: 20px;
}

.breadcrumb {
  font-size: 14px;
}

.breadcrumb a {
  color: #ffcc00;
  text-decoration: none;
  margin-right: 5px;
}

.breadcrumb .breadcrumb-arrow {
  margin: 0 5px;
  color: #ddd;
}

.breadcrumb a.active {
  color: #fff;
}

.bell-icon {
  background: none;
  border: none;
  color: white;
  font-size: 20px;
  cursor: pointer;
}

.profile-icon img {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  cursor: pointer;
}

/* Dropdown Menu */
#dropdownMenu {
  display: none;
  position: absolute;
  top: 60px;
  right: 20px;
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 5px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  z-index: 1001;
}

#dropdownMenu ul {
  list-style: none;
  margin: 0;
  padding: 10px 0;
}

#dropdownMenu ul li {
  padding: 10px 20px;
}

#dropdownMenu ul li a {
  text-decoration: none;
  color: #333;
  font-size: 14px;
  display: flex;
  align-items: center;
  gap: 10px;
}

#dropdownMenu ul li a:hover {
  background-color: #f5f5f5;
}

/* Main Content */
.main-content {
  padding: 20px;
}

main .header {
  margin-bottom: 20px;
}

main .header h1 {
  font-size: 28px;
  color: #003366;
}

.inventory-controls {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
  margin-left: 210px;
}

.search-bar {
  position: relative;
  display: flex;
  align-items: center;
}

.search-bar input {
  padding: 10px;
  padding-right: 40px;
  border: 1px solid #ddd;
  border-radius: 5px;
  width: 100%;
  max-width: 300px;
  outline: none;
}

.search-bar i {
  position: absolute;
  right: 10px;
  font-size: 20px;
  color: #888;
  cursor: pointer;
}

/* Sports Container */
.sports-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 20px;
}

/* Add Sport Button */
.add-sport {
  position: fixed;
  bottom: 20px;
  right: 20px;
  background-color: #003366;
  color: white;
  border: none;
  border-radius: 50%;
  width: 50px;
  height: 50px;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 24px;
  cursor: pointer;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
}

.add-sport:hover {
  background-color: #0055aa;
}

/* Modal */
.modal {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  justify-content: center;
  align-items: center;
  z-index: 1002;
}

.modal-content {
  background-color: #fff;
  width: 100%;
  max-width: 500px;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  position: relative;
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.modal-header h2 {
  font-size: 20px;
  margin: 0;
  color: #003366;
}

.modal-header .close {
  background: none;
  border: none;
  font-size: 24px;
  cursor: pointer;
}

.form-group {
  margin-bottom: 20px;
}

.form-group label {
  display: block;
  font-weight: bold;
  margin-bottom: 5px;
}

.form-group input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 5px;
  outline: none;
}

.submit-btn {
  background-color: #003366;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  font-size: 16px;
  cursor: pointer;
}

.submit-btn:hover {
  background-color: #0055aa;
}

/* Sport Card */
.sport-card {
  background-color: #f9f9f9;
  border-radius: 10px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  overflow: hidden;
  transition: transform 0.3s, box-shadow 0.3s;
  cursor: pointer;
  text-align: center;
  margin-left: 210px;
}

.sport-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
}

.sport-card img {
  width: 100%;
  height: 150px;
  object-fit: cover;
  border-bottom: 2px solid #003366;
}

.sport-card .sport-content {
  padding: 10px;
}

.sport-card .sport-content h3 {
  font-size: 16px;
  color: #003366;
  margin: 0;
}

/* Ensure the anchor tag does not have default link styles */
.sport-link {
    display: block;
    text-decoration: none;
}

.sport-link:hover {
    opacity: 0.8;
}

/* Responsive Design */
@media (max-width: 768px) {
  .search-bar input {
      max-width: 100%;
  }

  .sports-container {
      grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
  }

  .modal-content {
      padding: 15px;
  }

  .submit-btn {
      width: 100%;
  }
}

    </style>
</head>
<body>
<?php include 'nav.view.php';?>
    <div class="main-content">
        <main>
            <div class="header"></div>

            <div class="inventory-controls">
                <div class="search-bar">
                    <input type="text" id="searchInput" placeholder="Search sports...">
                    <i class="uil uil-search"></i>
                </div>
            </div>
            
            <div class="sports-container" id="sportsContainer">
                <!-- Sports cards will be added here -->
            </div>
             
            <button class="add-sport" onclick="openModal()" id="addSportBtn">
                <i class="uil uil-plus"></i>
            </button>
        </main>

        <div class="modal" id="addSportModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 id="modalTitle">Add Sport</h2>
                    <button class="close">&times;</button>
                </div>
                <form id="addSportForm">
                    <div class="form-group">
                        <label for="sportName">Sport Name</label>
                        <input type="text" id="sportName" required>
                    </div>
                    <div class="form-group">
                        <label for="imageUrl">Image URL</label>
                        <input type="url" id="imageUrl" required>
                    </div>
                    <button type="submit" class="submit-btn">Add Sport</button>
                </form>
            </div>
        </div>
    </div>


    <script>
        // Selecting the elements
const sportsContainer = document.getElementById('sportsContainer');
const searchInput = document.getElementById('searchInput');
const addSportModal = document.getElementById('addSportModal');
const addSportForm = document.getElementById('addSportForm');
const closeModal = addSportModal.querySelector('.close');
const addSportBtn = document.getElementById('addSportBtn');

// Sample sports data (You can replace it with your actual sports data or load it dynamically)
let sports = [
    { name: 'Football', imageUrl: '../../../public/assets/images/amar/hockey.jpg', link: 'swimming' },
    { name: 'Basketball', imageUrl: '../../../public/assets/images/amar/hockey.jpg', link: 'swimming' },
    { name: 'Tennis', imageUrl: '../../../public/assets/images/amar/hockey.jpg', link: 'swimming' },
    { name: 'Baseball', imageUrl: '../../../public/assets/images/amar/hockey.jpg', link: 'swimming' },
    { name: 'Baseball', imageUrl: '../../../public/assets/images/amar/hockey.jpg', link: 'swimming' },
    { name: 'Baseball', imageUrl: '../../../public/assets/images/amar/hockey.jpg', link: 'swimming' },
    { name: 'Baseball', imageUrl: '../../../public/assets/images/amar/hockey.jpg', link: 'swimming' },
    { name: 'Baseball', imageUrl: '../../../public/assets/images/amar/hockey.jpg', link: 'swimming' },





];

// Function to render sports cards
function renderSports(sportsArray) {
    sportsContainer.innerHTML = ''; // Clear the container before re-rendering

    sportsArray.forEach(sport => {
        const sportCard = document.createElement('div');
        sportCard.classList.add('sport-card');

        sportCard.innerHTML = `
            <a href="${sport.link}" class="sport-link">
                <img src="${sport.imageUrl}" alt="${sport.name}">
                <div class="sport-content">
                    <h3>${sport.name}</h3>
                </div>
            </a>
        `;

        sportsContainer.appendChild(sportCard);
    });
}

// Search functionality
searchInput.addEventListener('input', function() {
    const searchText = searchInput.value.toLowerCase();
    const filteredSports = sports.filter(sport => sport.name.toLowerCase().includes(searchText));
    renderSports(filteredSports);
});

// Open modal to add sport
addSportBtn.addEventListener('click', function() {
    addSportModal.style.display = 'flex';
});

// Close the modal
closeModal.addEventListener('click', function() {
    addSportModal.style.display = 'none';
});

// Close modal if clicked outside of the modal content
window.addEventListener('click', function(event) {
    if (event.target === addSportModal) {
        addSportModal.style.display = 'none';
    }
});

// Handle the form submission to add a new sport
addSportForm.addEventListener('submit', function(event) {
    event.preventDefault();

    const sportName = document.getElementById('sportName').value;
    const imageUrl = document.getElementById('imageUrl').value;

    if (sportName && imageUrl) {
        sports.push({ name: sportName, imageUrl: imageUrl, link: `#${sportName.toLowerCase()}` });
        renderSports(sports);
        addSportModal.style.display = 'none';
        addSportForm.reset(); // Reset the form
    }
});

// Initial rendering of sports
renderSports(sports);

        </script>
</body>
</html>
