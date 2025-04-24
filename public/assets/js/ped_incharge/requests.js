function viewCard(carddetails) {
    let modal = document.getElementById("actionModal");

    modal.style.display = "block";

    document.getElementById("court").innerHTML = carddetails.dataset.courtname;
    document.getElementById("location").innerHTML = carddetails.dataset.location;
    document.getElementById("reservationID").innerHTML = carddetails.dataset.id;
    document.getElementById("date").innerHTML = carddetails.dataset.date;
    document.getElementById("time").innerHTML = carddetails.dataset.time;
    document.getElementById("company").innerHTML = carddetails.dataset.userdescription;
    document.getElementById("contactPerson").innerHTML = carddetails.dataset.name;
    document.getElementById("phone").innerHTML = carddetails.dataset.contact_number;
    document.getElementById("email").innerHTML = carddetails.dataset.email;
    document.getElementById("participants").innerHTML = carddetails.dataset.numberof_participants;
    document.getElementById("requirements").innerHTML = carddetails.dataset.extradetails;
    document.getElementById("proof").href = document.getElementById("proof").href + (carddetails.dataset.userproof || carddetails.dataset.payment_proof);

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