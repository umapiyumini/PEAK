document.addEventListener('DOMContentLoaded', () => {
  initializeEventListeners();
});

function openModal(tournamentdata) {
  let tournamentModal = document.getElementById("tournamentModal");
  tournamentModal.style.display = "block";

  document.getElementById("tournamentId").value = tournamentdata.dataset.tournamentid || '';
  document.getElementById("name").value = tournamentdata.dataset.tournamentname || '';
  document.getElementById("sportInput").value = tournamentdata.dataset.sport || '';
  document.getElementById("date").value = tournamentdata.dataset.date || '';
  document.getElementById("place").value = tournamentdata.dataset.place || '';
  document.getElementById("men_women").value = tournamentdata.dataset.category || '';
  document.getElementById("venue").value = tournamentdata.dataset.venue || '';
  document.getElementById("participants").value = tournamentdata.dataset.participantcount || '';
}

function deleteTournament(interrecordid) {
  if (confirm("Are you sure you want to delete this tournament?")) {
    window.location.href = "<?=ROOT?>/ped_incharge/interuni_tournaments/deleteTournament/" + interrecordid;
  }
}

function viewTournament(tournamentdata) {
  let viewTournamentModal = document.getElementById("viewTournamentModal");
  viewTournamentModal.style.display = "block";

  document.getElementById("viewName").value = tournamentdata.dataset.tournamentname || '';
  document.getElementById("viewSport").value = tournamentdata.dataset.sport || '';
  document.getElementById("viewDate").value = tournamentdata.dataset.date || '';
  document.getElementById("viewPlace").value = tournamentdata.dataset.place || '';
  document.getElementById("viewMenWomen").value = tournamentdata.dataset.category || '';
  document.getElementById("viewVenue").value = tournamentdata.dataset.venue || '';
}

function closeModal(modalId) {
  const modal = document.getElementById(modalId);
  modal.style.display = "none";
}

function initializeEventListeners() {
  window.onclick = (event) => {
    if(event.target.classList.contains('modal')) {
      event.target.style.display = "none";
    }
  }
}