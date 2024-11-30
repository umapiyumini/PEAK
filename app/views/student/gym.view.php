<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Calendar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 0;
            background-color: #f4f4f4;
            overflow: hidden; /* Prevent double scroll bars */
        }

        .calendar-container {
            max-width: 100%;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: auto;
            margin-left: 220px;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            max-width: 400px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        #student-id {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        #confirm-booking {
            padding: 10px 20px;
            border: none;
            background-color: #5a2e8a;
            color: white;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            width: 80%;
            margin: 10px 0;
        }

        #confirm-booking:hover {
            background-color: #7a4bb8;
        }

        h1 {
            margin-left: 550px;
            color: #333;
        }

        .week-selector {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px 0;
        }

        .week-selector button {
            padding: 10px 20px;
            margin: 0 10px;
            border: none;
            background-color: #5a2e8a;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .week-selector button:hover {
            background-color: #7a4bb8;
        }

        .week-selector span {
            font-size: 1.2rem;
            color: #333;
        }

        #calendar {
            width: 100%;
            overflow-x: auto;
        }

        #calendar table {
            width: 100%;
            height: 250px;
            table-layout: fixed;
            border-collapse: collapse;
        }

        #calendar th,
        #calendar td {
            border: 1px solid #ddd;
            text-align: center;
            vertical-align: middle;
            padding: 10px;
        }

        #calendar th {
            background-color: #5a2e8a;
            color: white;
            font-size: 1rem;
            font-weight: bold;
        }

        #calendar td {
            font-size: 0.9rem;
            background-color: #fff;
            transition: background-color 0.3s ease;
        }

        #calendar td.booked-slot {
            cursor: pointer;
            background-color: #d7cae6;
        }

        #calendar td.booked-slot:hover {
            background-color: #cab7df;
        }

        #calendar td.booked-slot.booked-full {
            background-color: #ffe0b2;
        }

        @media screen and (max-width: 768px) {
            .calendar-container {
                width: 100%;
                padding: 10px;
            }

            .modal-content {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <?php 
        include 'nav.view.php';
    ?>
    <div class="calendar-container">
        <div class="week-selector">
            <button id="prev-week">&lt; Previous Week</button>
            <span id="week-display"></span>
            <button id="next-week">Next Week &gt;</button>
        </div>
        <div id="calendar"></div>
    </div>

    <div id="modal" class="modal">
        <div class="modal-content">
            <span id="close-modal" class="close">&times;</span>
            <h2>Request for a Gym</h2>
            <p id="modal-content"></p>
        </div>
    </div>

    <script>
        const calendar = document.getElementById("calendar");
        const weekDisplay = document.getElementById("week-display");
        const prevWeekBtn = document.getElementById("prev-week");
        const nextWeekBtn = document.getElementById("next-week");
        const modal = document.getElementById("modal");
        const closeModal = document.getElementById("close-modal");

        const timeSlots = [
            "6:00 AM - 8:00 AM",
            "8:00 AM - 10:00 AM",
            "10:00 AM - 12:00 PM",
            "12:00 PM - 2:00 PM",
            "2:00 PM - 4:00 PM",
            "4:00 PM - 6:00 PM",
        ];

        const generateBookings = () =>
            timeSlots.map(() => ({
                booked: Math.floor(Math.random() * 21),
            }));

        let weeklyBookings = Array.from({ length: 7 }, generateBookings);
        let currentDate = new Date();

        function getStartOfWeek(date) {
            const start = new Date(date);
            start.setDate(date.getDate() - date.getDay());
            return start;
        }

        function formatDate(date) {
            return `${date.getDate()}-${date.getMonth() + 1}-${date.getFullYear()}`;
        }

        function renderCalendar() {
            calendar.innerHTML = "";

            const startOfWeek = getStartOfWeek(currentDate);
            weekDisplay.innerText = `Week of ${formatDate(startOfWeek)}`;

            let table = `<table><thead><tr><th>Time Slots</th>`;
            for (let i = 0; i < 7; i++) {
                const date = new Date(startOfWeek);
                date.setDate(startOfWeek.getDate() + i);
                table += `<th>${formatDate(date)}</th>`;
            }
            table += `</tr></thead><tbody>`;

            for (let i = 0; i < timeSlots.length; i++) {
                table += `<tr><td class="time-slot">${timeSlots[i]}</td>`;
                for (let j = 0; j < 7; j++) {
                    const booking = weeklyBookings[j][i];
                    table += `
                        <td class="booked-slot ${booking.booked >= 20 ? "booked-full" : ""}" 
                            onclick="showBookingModal(weeklyBookings[${j}][${i}], '${timeSlots[i]}')">
                            ${booking.booked} / 20
                        </td>`;
                }
                table += `</tr>`;
            }
            table += `</tbody></table>`;
            calendar.innerHTML = table;
        }

        function showBookingModal(slot, time) {
            const modalContent = document.getElementById("modal-content");
            modalContent.innerHTML = `
                <strong>Time Slot:</strong> ${time}<br>
                <label for="student-id">Student Registration ID:</label><br>
                <input type="text" id="student-id" name="student-id" placeholder="Enter your Registration ID" required>
                <button id="confirm-booking">Confirm Booking</button>
            `;

            document.getElementById("confirm-booking").addEventListener("click", function () {
                const studentId = document.getElementById("student-id").value.trim();
                if (studentId) {
                    alert(`Booking confirmed for Student ID: ${studentId} at ${time}`);
                    modal.style.display = "none";
                    renderCalendar();
                } else {
                    alert("Please enter a valid Student Registration ID.");
                }
            });

            modal.style.display = "block";
        }

        closeModal.addEventListener("click", () => {
            modal.style.display = "none";
        });

        prevWeekBtn.addEventListener("click", () => {
            currentDate.setDate(currentDate.getDate() - 7);
            weeklyBookings = Array.from({
                length: 7
        }, generateBookings);
        renderCalendar();
    });

    nextWeekBtn.addEventListener("click", () => {
        currentDate.setDate(currentDate.getDate() + 7);
        weeklyBookings = Array.from({
            length: 7
        }, generateBookings);
        renderCalendar();
    });

    // Close the modal when clicking outside of it
    window.addEventListener("click", (event) => {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });

    // Render the initial calendar
    renderCalendar();
</script>
</body>
</html>
