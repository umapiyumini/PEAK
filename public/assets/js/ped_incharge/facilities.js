const modal = document.getElementById("facilityModal");
const modalTitle = document.getElementById("modalTitle");
const facilityForm = document.getElementById("facilityForm");
const closeBtn = document.querySelector(".close");

// Open Edit Modal and populate with selected court data
function openEditModal(court) {
    modal.style.display = "block";
    modalTitle.textContent = "Edit Facility";
    document.getElementById("editCourtid").value = court.courtid;
    document.getElementById("facilityName").value = court.name;
    document.getElementById("facilityDescription").value = court.description;
    document.getElementById("facilityImage").value = court.image;
}

// Close modal when clicking the close button or outside the modal
closeBtn.onclick = () => {
    modal.style.display = "none";
};
window.onclick = (e) => {
    if (e.target === modal) {
        modal.style.display = "none";
    }
};

// Fetch facility details for editing by courtid
function fetchFacility(courtid) {
    const formData = new URLSearchParams();
    formData.append("courtid", courtid);

    fetch("/ped_facilities/getFacility", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: formData.toString()
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);  // Check what data is returned
        if (data && !data.error) {
            openEditModal(data); // Open modal and pass the data
        } else {
            alert("Facility not found.");
        }
    });
}

// Handle form submission (update court)
facilityForm.onsubmit = async (e) => {
    e.preventDefault();

    const courtid = document.getElementById("editCourtid").value;
    const name = document.getElementById("facilityName").value;
    const description = document.getElementById("facilityDescription").value;
    const image = document.getElementById("facilityImage").value;

    const formData = new URLSearchParams();
    formData.append("courtid", courtid);
    formData.append("name", name);
    formData.append("description", description);
    formData.append("image", image);

    const response = await fetch("/ped_facilities/update", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: formData.toString()
    });

    const result = await response.text();
    if (result === "success") {
        alert("Facility updated!");
        location.reload();  // Reload the page to reflect the changes
    } else {
        alert("Failed to update facility.");
    }
};
