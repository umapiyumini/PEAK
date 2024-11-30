document.addEventListener("DOMContentLoaded", () => {
    const playedTournaments = [
      { id: 1, name: "Inter-University Tournament", date: "2024-09-15", location: "Colombo", status: "Played" },
      { id: 2, name: "Feshers Tournament", date: "2024-08-20", location: "Colombo", status: "Played" },
    ];
  
    const upcomingEvents = [
      { id: 3, name: "National Hockey Championship", date: "2024-12-05", location: "Galle", status: "Upcoming" },
      { id: 4, name: "Inter Faculty Tournament", date: "2024-11-30", location: "Jaffna", status: "Upcoming" },
    ];
  
    const tournamentList = document.getElementById("tournament-list");
    const eventList = document.getElementById("event-list");
    const addModal = document.getElementById("add-modal");
    const updateModal = document.getElementById("update-modal");
  
    let currentTab = null;
    let currentUpdateItem = null;
  
    // Tabs switching
    document.querySelectorAll(".tab-button").forEach((button) => {
      button.addEventListener("click", () => {
        document.querySelectorAll(".tab-button").forEach((btn) => btn.classList.remove("active"));
        document.querySelectorAll(".tab-content").forEach((tab) => tab.classList.remove("active"));
        button.classList.add("active");
        document.getElementById(button.dataset.tab).classList.add("active");
      });
    });
  
    // Show Add Modal
    window.showAddModal = (tab) => {
      currentTab = tab;
      addModal.classList.remove("hidden");
    };
  
    // Show Update Modal
    window.showUpdateModal = (item) => {
      currentUpdateItem = item;
      document.getElementById("update-name").value = item.name;
      document.getElementById("update-date").value = item.date;
      document.getElementById("update-location").value = item.location;
      updateModal.classList.remove("hidden");
    };
  
    // Close Modals
    window.closeModal = () => {
      addModal.classList.add("hidden");
      updateModal.classList.add("hidden");
    };
  
    // Add Event
    document.getElementById("add-form").addEventListener("submit", (e) => {
      e.preventDefault();
      const name = document.getElementById("name").value;
      const date = document.getElementById("date").value;
      const location = document.getElementById("location").value;
  
      const newItem = { id: Date.now(), name, date, location, status: currentTab === "played" ? "Played" : "Upcoming" };
      if (currentTab === "played") playedTournaments.push(newItem);
      if (currentTab === "upcoming") upcomingEvents.push(newItem);
  
      renderCards();
      closeModal();
    });
  
    // Update Event
    document.getElementById("update-form").addEventListener("submit", (e) => {
      e.preventDefault();
      currentUpdateItem.name = document.getElementById("update-name").value;
      currentUpdateItem.date = document.getElementById("update-date").value;
      currentUpdateItem.location = document.getElementById("update-location").value;
  
      renderCards();
      closeModal();
    });
  
    // Delete Event
    window.deleteItem = (itemId, isPlayed) => {
      const list = isPlayed ? playedTournaments : upcomingEvents;
      const index = list.findIndex((item) => item.id === itemId);
      if (index !== -1) list.splice(index, 1);
  
      renderCards();
    };
  
    // Render Cards
    const renderCards = () => {
      tournamentList.innerHTML = "";
      playedTournaments.forEach((item) => addCard(item, tournamentList, true));
  
      eventList.innerHTML = "";
      upcomingEvents.forEach((item) => addCard(item, eventList, false));
    };
  
    const addCard = (item, container, isPlayed) => {
      const card = document.createElement("div");
      card.classList.add("card");
      card.innerHTML = `
        <h2>${item.name}</h2>
        <p>${item.date}</p>
        <p>${item.location}</p>
        <button class="edit-btn">Edit</button>
        <button onclick="deleteItem(${item.id}, ${isPlayed})">Delete</button>
      `;
      
      // Fix the Edit button click handler
      card.querySelector(".edit-btn").addEventListener("click", () => {
        showUpdateModal(item);  // Pass the item directly to the update modal
      });
  
      container.appendChild(card);
    };
  
    // Initial Render
    renderCards();
  });
  