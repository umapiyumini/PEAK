// DOM Elements
const modal = document.getElementById("facilityModal");
const modalTitle = document.getElementById("modalTitle");
const facilityForm = document.getElementById("reservationForm");

const closeBtn = document.querySelector("#facilityModal .close");
const addFacilityBtn = document.getElementById("addFacilityBtn");
const editCourtidInput = document.getElementById("editCourtid");

// Show Add Facility Modal
addFacilityBtn.onclick = function() {
    modal.style.display = "block";
    modalTitle.textContent = "Add Facility";
    facilityForm.reset();
    editCourtidInput.value = "";
};

// Open Edit Modal and populate with selected court data
function fetchFacility(courtid) {
    fetch("/PEAK/public/ped_incharge/ped_facilities/getFacility", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: new URLSearchParams({ courtid })
    })
    .then(response => response.json())
    .then(data => {
        if (data && !data.error) {
            openEditModal(data);
        } else {
            alert("Facility not found.");
        }
    })
    .catch(() => alert("Error fetching facility details."));
}

function openEditModal(court) {
    modal.style.display = "block";
    modalTitle.textContent = "Edit Facility";
    editCourtidInput.value = court.courtid || "";
    document.getElementById("facilityName").value = court.name || "";
    document.getElementById("facilityDescription").value = court.description || "";
    document.getElementById("facilitylocation").value = court.location || "";
    document.getElementById("facilitysection").value = court.section || "";
    document.getElementById("currentImage").src = court.image || "";

    // Show current image if you want
    if (document.getElementById("currentImage")) {
        document.getElementById("currentImage").src = court.image || "";
    }
}


function deleteFacility(courtid) {
    if (!confirm("Are you sure you want to delete this facility?")) return;

    fetch("/PEAK/public/ped_incharge/ped_facilities/delete", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: new URLSearchParams({ courtid })
    })
    .then(response => response.text())
    .then(result => {
        if (result.trim() === "success") {
            // Option 1: Reload the page
            window.location.reload();

            // Option 2: Remove the card from the DOM (uncomment if you want instant update)
            // document.querySelector(`.facility-card[data-id='${courtid}']`).remove();
        } else {
            alert("Error deleting facility: " + result);
        }
    })
    .catch(() => alert("Error deleting facility."));
}

// Close Modal (button or clicking outside)
closeBtn.onclick = closeModal;
window.onclick = function(event) {
    if (event.target === modal) closeModal();
};
function closeModal() {
    modal.style.display = "none";
}

// Handle Add/Edit Facility Form Submission
facilityForm.onsubmit = function(e) {
    e.preventDefault();
    const formData = new FormData(facilityForm);
    const courtid = editCourtidInput.value;
    let url, successMsg;

    if (courtid) {
        formData.append("courtid", courtid);
        url = "/PEAK/public/ped_incharge/ped_facilities/update";

        successMsg = "Facility updated!";
    } else {
         url = "/PEAK/public/ped_incharge/ped_facilities/add";

        successMsg = "Facility added!";
    }

    fetch(url, {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        if (result.trim() === "success") {
            window.location.href = "/PEAK/public/ped_incharge/ped_facilities";
        } else {
            alert("Error saving facility: " + result);
        }
    })
    .catch(() => alert("Error saving facility."));
};






// Example usage for editing:
// fetchFacility(123); // Call this when you want to edit facility with courtid 123
