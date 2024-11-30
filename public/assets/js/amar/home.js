const monthYear = document.getElementById('month-year');
const datesElement = document.getElementById('dates');
const prev = document.getElementById('prev');
const next = document.getElementById('next');

const months = [
  'January', 'February', 'March', 'April', 'May', 'June', 'July', 
  'August', 'September', 'October', 'November', 'December'
];

let currentDate = new Date();

// Function to update previous and next month labels dynamically
function updateMonthLabels() {
  const currentMonth = currentDate.getMonth();
  
  // Calculate previous and next month indexes
  const prevMonthIndex = (currentMonth - 1 + 12) % 12;
  const nextMonthIndex = (currentMonth + 1) % 12;

  // Update the text for previous and next months with arrow icons and no year
   prev.innerHTML = `<i class="uil uil-arrow-left"></i> ${months[prevMonthIndex]}`;
  next.innerHTML = `${months[nextMonthIndex]} <i class="uil uil-arrow-right"></i>`;
}

// Function to render the calendar
function renderCalendar() {
  // Get year, month, and first day of the month
  const year = currentDate.getFullYear();
  const month = currentDate.getMonth();
  const firstDay = new Date(year, month, 1).getDay() - 1;  // Adjust for Monday start

  // Update the header for the current month and year
  monthYear.textContent = `${months[month]} ${year}`;

  // Clear any existing dates
  datesElement.innerHTML = '';

  // Get number of days in the current month
  const daysInMonth = new Date(year, month + 1, 0).getDate();

  // Fill in previous month's blank spaces
  for (let i = 0; i < (firstDay < 0 ? 6 : firstDay); i++) {
    datesElement.innerHTML += `<div class="date"></div>`;
  }

  // Fill in dates of the current month
  for (let i = 1; i <= daysInMonth; i++) {
    const dateClass = i === currentDate.getDate() && 
                      month === new Date().getMonth() && 
                      year === new Date().getFullYear() ? 'active' : '';
    datesElement.innerHTML += `<div class="date ${dateClass}">${i}</div>`;
  }

  // Update the previous and next month labels
  updateMonthLabels();
}

// Event listeners for previous and next month navigation
prev.addEventListener('click', () => {
  currentDate.setMonth(currentDate.getMonth() - 1);
  renderCalendar();
});

next.addEventListener('click', () => {
  currentDate.setMonth(currentDate.getMonth() + 1);
  renderCalendar();
});

// Initialize the calendar on page load
renderCalendar();

//notice board
 let notices = [];
        let editingIndex = null;

        function addOrUpdateNotice() {
            const title = document.getElementById('noticeTitle').value;
            const content = document.getElementById('noticeContent').value;
            if (title && content) {
                const notice = {
                    title,
                    content,
                    date: new Date().toLocaleString()
                };
                if (editingIndex !== null) {
                    notices[editingIndex] = notice;
                    editingIndex = null;
                } else {
                    notices.push(notice);
                }
                document.getElementById('noticeTitle').value = '';
                document.getElementById('noticeContent').value = '';
                document.querySelector('.notice-form button').textContent = 'Add Notice';
                renderNotices();
            }
        }

        function deleteNotice(index) {
            notices.splice(index, 1);
            renderNotices();
        }

        function editNotice(index) {
            const notice = notices[index];
            document.getElementById('noticeTitle').value = notice.title;
            document.getElementById('noticeContent').value = notice.content;
            document.querySelector('.notice-form button').textContent = 'Update Notice';
            editingIndex = index;
        }

        function renderNotices() {
            const container = document.getElementById('noticesContainer');
            container.innerHTML = '';
            notices.forEach((notice, index) => {
                const noticeElement = document.createElement('div');
                noticeElement.className = 'notice';
                noticeElement.innerHTML = `
                    <h2>${notice.title}</h2>
                    <p>${notice.content}</p>
                    <p class="notice-date">Posted on: ${notice.date}</p>
                    <div class="notice-actions">
                        <button onclick="editNotice(${index})">Edit</button>
                        <button onclick="deleteNotice(${index})">Delete</button>
                    </div>
                `;
                container.appendChild(noticeElement);
            });
        }

        renderNotices();