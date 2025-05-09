function viewCard(carddetails) {
    let modal = document.getElementById("actionModal");

    modal.style.display = "block";

    document.getElementById("court").innerHTML = carddetails.dataset.courtname;
    document.getElementById("location").innerHTML = carddetails.dataset.location;
    document.getElementById("reservationID").innerHTML = carddetails.dataset.id;
    document.getElementById("date").innerHTML = carddetails.dataset.date;
    document.getElementById("time").innerHTML = carddetails.dataset.time;
    document.getElementById("duration").innerHTML = carddetails.dataset.duration;
    document.getElementById("company").innerHTML = carddetails.dataset.userdescription;
    document.getElementById("contactPerson").innerHTML = carddetails.dataset.name;
    document.getElementById("phone").innerHTML = carddetails.dataset.contact_number;
    document.getElementById("email").innerHTML = carddetails.dataset.email;
    document.getElementById("participants").innerHTML = carddetails.dataset.numberof_participants;
    document.getElementById("requirements").innerHTML = carddetails.dataset.extradetails;
    document.getElementById("proof").href = document.getElementById("proof").href + (carddetails.dataset.userproof || carddetails.dataset.payment_proof);


    if (carddetails.dataset.has_conflict === "1") {
        document.getElementById('conflictWarning').style.display = 'block';
        document.getElementById("acceptbtn").disabled = true;
        document.getElementById("acceptbtn").style.opacity = "0.5";
    } else {
        document.getElementById('conflictWarning').style.display = 'none';
        document.getElementById("acceptbtn").disabled = false;
        document.getElementById("acceptbtn").style.opacity = "1";
    }
    

    if(carddetails.dataset.cardtype == "topay") {
        document.getElementById("acceptbtn").style.display = 'none';
    } else {
        document.getElementById("acceptbtn").style.display = 'block';
        document.getElementById("acceptbtn").innerHTML = carddetails.dataset.cardtype == "new" || carddetails.dataset.cardtype == "awaiting" ? "Accept" : "Confirm";
    }

}

function closeModal() {
    let modal = document.getElementById("actionModal");
    modal.style.display = "none";
}

window.onclick = function (event) {
    let modal = document.getElementById("actionModal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

function acceptRequest(){
    window.location.href = "requests/accept/" + document.getElementById("reservationID").innerHTML;
}

function rejectRequest(){
    window.location.href = "requests/reject/" + document.getElementById("reservationID").innerHTML;
}

function acceptRequestIndoor(){
    window.location.href = "indoor_requests/accept/" + document.getElementById("reservationID").innerHTML;
}

function rejectRequestIndoor(){
    window.location.href = "indoor_requests/reject/" + document.getElementById("reservationID").innerHTML;
}