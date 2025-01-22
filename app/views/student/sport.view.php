<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/amar/sport.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <style>
        /* General Reset */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Arial', sans-serif;
}

body {
  background-color: #f4f6f7;
  color: #2c3e50;
  line-height: 1.6;
  font-size: 16px;
}

/* Full Layout */
.full {
  display: flex;
  height: 100vh;
  overflow: hidden;
}

/* Left Sidebar (Navigation) */
.left {
  width: 250px;
  background-color: #ffffff;
  padding: 20px;
  color: white;
  position: fixed;
  top: 0;
  left: 0;
  height: 100%;
}



/* Right Content */
.right {
  margin-left: 250px;
  flex-grow: 1;
  padding: 40px;
  overflow-y: auto;
  background-color: #fff;
  transition: margin-left 0.3s ease;
}

.right .main-content {
  padding: 20px;
}

/* Inventory Controls */
.inventory-controls {
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
}

.search-bar {
  display: flex;
  align-items: center;
  background-color: #ecf0f1;
  border-radius: 5px;
  padding: 5px 15px;
  width: 250px;
}

.search-bar input {
  border: none;
  outline: none;
  background: transparent;
  font-size: 1rem;
  color: #34495e;
  width: 100%;
  padding: 5px 10px;
}

.search-bar i {
  color: #34495e;
  font-size: 1.25rem;
  margin-left: 10px;
}

/* Sports Cards Container */
.sports-container {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 30px;
  margin-top: 20px;
}

/* Single Sport Card */
.sport-card {
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  overflow: hidden;
}

.sport-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
}

.sport-link {
  text-decoration: none;
  display: block;
  color: #2c3e50;
}

.sport-card img {
  width: 70%;
  height: 200px;
  object-fit: cover;
}

.sport-content {
  padding: 15px;
  text-align: center;
}

.sport-content h3 {
  font-size: 1.5rem;
  color: #2c3e50;
  margin-top: 10px;
  font-weight: bold;
}

/* Modal for Adding Sport */
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
}

.modal-content {
  background-color: #fff;
  padding: 30px;
  border-radius: 8px;
  width: 400px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.modal-header h2 {
  font-size: 1.75rem;
  color: #2c3e50;
}

.modal .close {
  font-size: 1.5rem;
  color: #2c3e50;
  cursor: pointer;
}

.form-group {
  margin-bottom: 15px;
}

.form-group label {
  font-size: 1rem;
  color: #34495e;
  margin-bottom: 5px;
}

.form-group input {
  width: 100%;
  padding: 10px;
  font-size: 1rem;
  border: 1px solid #ccc;
  border-radius: 5px;
  outline: none;
}

.form-group input:focus {
  border-color: #1abc9c;
}

.submit-btn {
  background-color: #1abc9c;
  color: #fff;
  padding: 12px 20px;
  font-size: 1.1rem;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.submit-btn:hover {
  background-color: #16a085;
}

/* Add Sport Button */
.add-sport {
  background-color: #1abc9c;
  color: #fff;
  padding: 12px 20px;
  font-size: 1.5rem;
  border: none;
  border-radius: 50%;
  position: fixed;
  bottom: 20px;
  right: 20px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.add-sport:hover {
  background-color: #16a085;
}

.add-sport i {
  font-size: 1.5rem;
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
  .full {
      flex-direction: column;
  }

  .left {
      width: 100%;
      position: relative;
      height: auto;
  }

  .right {
      margin-left: 0;
  }

  .sports-container {
      grid-template-columns: 1fr;
  }

  .add-sport {
      bottom: 10px;
      right: 10px;
  }
}

    </style>

</head>
<body>
  <div class="full">
    <div class="left">
    <?php include 'nav.view.php';?>
    </div>
    <div class="right">
    <div class="main-content">
        <main>
            <div class="header"></div>

            <div class="inventory-controls">
              <h2>Sport Blog</h2>
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
    { name: 'Hockey', imageUrl: 'http://localhost/PEAK/public/assets/images/amar/hockey.jpg', link: 'swimming' },
    { name: 'VolleyBall', imageUrl: 'http://localhost/PEAK/public/assets/images/amar/volleyball.jpg', link: 'swimming' },
    { name: 'Football', imageUrl: 'http://localhost/PEAK/public/assets/images/amar/football.jpeg', link: 'swimming' },
    { name: 'Swimming', imageUrl: 'http://localhost/PEAK/public/assets/images/amar/swimming.jpg', link: 'swimming' },
   




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
