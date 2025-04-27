function showSection(sectionId) {
    document.querySelectorAll('.form-section').forEach(section => {
        section.classList.remove('active');
    });
    
    document.getElementById(sectionId).classList.add('active');
    
    document.querySelectorAll('.tab').forEach(tab => {
        tab.classList.remove('active');
    });
    
    document.querySelector(`.tab[onclick="showSection('${sectionId}')"]`).classList.add('active');
}

function openModalCert(data) {
    document.getElementById('cert-requestId').innerHTML = data.dataset.id;
    document.getElementById('cert-studentName').innerHTML = data.dataset.name;
    document.getElementById('cert-studentId').innerHTML = data.dataset.userid;
    document.getElementById('cert-type').innerHTML = data.dataset.tournament;
    document.getElementById('cert-year').innerHTML = data.dataset.year;
    document.getElementById('cert-sport').innerHTML = data.dataset.sport_name;
    document.getElementById('cert-requiredDate').innerHTML = data.dataset.date;
        
        
    document.getElementById('certificatesModal').style.display = 'block';
}

function openModalMed(data) {
    document.getElementById('med-requestId').innerHTML = data.dataset.id;
    document.getElementById('med-studentName').innerHTML = data.dataset.name;
    document.getElementById('med-studentId').innerHTML = data.dataset.userid;
    document.getElementById('med-ReasonForMedical').innerHTML = data.dataset.reason;
        
        
    document.getElementById('medicalModal').style.display = 'block';
}

function openModalTrans(data) {
    document.getElementById('trans-requestId').innerHTML = data.dataset.id;
    document.getElementById('trans-sport').innerHTML = data.dataset.sport;
    document.getElementById('trans-date').innerHTML = data.dataset.date;
    document.getElementById('trans-location').innerHTML = data.dataset.location;
    document.getElementById('trans-time').innerHTML = data.dataset.time;
    document.getElementById('trans-reason').innerHTML = data.dataset.reason;
        
        
    document.getElementById('transportModal').style.display = 'block';
}


function closeModal(modalid) {
    document.getElementById(modalid).style.display = 'none';
}

window.addEventListener('click', (event) => {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = 'none';
    }
});


function handleAction(type, action, id) {
    reqid = document.getElementById(id).innerHTML;
    window.location.href = `otherforms/handleAction/${type}/${action}/${reqid}`;
}

function markCertificateReady(id){
    reqid = document.getElementById(id).innerHTML;
    window.location.href = `otherforms/markCertificateReady/${reqid}`;
}

   //error message disappear
   setTimeout(() => {
    const fadeOut = (id) => {
        const el = document.getElementById(id);
        if (el) {
            el.style.opacity = "0";
            el.style.transform = "translateY(-10px)";
            setTimeout(() => el.remove(), 500);
        }
    };

    fadeOut('error-message');
    fadeOut('success-message');
}, 3000);


