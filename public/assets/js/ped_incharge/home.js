
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

        function editModal(data) {
          document.getElementById('noticeid').value = data.dataset.noticeid;
          document.getElementById('title').value = data.dataset.title;
          document.getElementById('content').value = data.dataset.content;
          document.getElementById('publishdate').value = data.dataset.publishdate;
          document.getElementById('publishtime').value = data.dataset.publishtime;
          document.getElementById('visibility').value = data.dataset.visibility;

          document.getElementById('editModal').style.display = 'block';
        }

        function closeModal(id) {
          document.getElementById(id).style.display = 'none';
        }

        function deleteNotice(index) {
            if (confirm('Are you sure you want to delete this notice?')) {
              window.location.href = `home/deleteNotice/${index}`;
            }
        }

        window.onclick = function(event) {
          if (event.target.classList.contains('modal')) {
            event.target.style.display = 'none';
          }
        }

        renderNotices();





