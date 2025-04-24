
    document.addEventListener('DOMContentLoaded', function () {
        const addBtn = document.querySelector('.add-btn');
        const modal = document.getElementById('interfacultyViewModal');

        addBtn.addEventListener('click', function () {
            modal.style.display = "block";
        });
    });

    function closeModal(id) {
        document.getElementById(id).style.display = "none";
    }

