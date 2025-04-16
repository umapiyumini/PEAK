document.addEventListener('DOMContentLoaded', function () {
    // Form date validation
    document.getElementById('form').addEventListener('submit', function (e) {
        const startDate = document.getElementById('startdate').value;
        const endDate = document.getElementById('end_date').value;

        if (new Date(endDate) < new Date(startDate)) {
            e.preventDefault();
            alert('End date cannot be before start date.');
        }
    });
});
