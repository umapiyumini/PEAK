let news = [];
let editingNewsIndex = null;

function addOrUpdateNews() {
    const topic = document.getElementById('newsTopic').value.trim();
    const content = document.getElementById('newsContent').value.trim();
    
    if (topic === "" || content === "") {
        alert("Please fill in both the topic and content fields.");
        return;
    }

    const newsItem = {
        topic: topic,
        content: content,
        date: new Date().toLocaleDateString()
    };

    if (editingNewsIndex !== null) {
        // Update existing news
        news[editingNewsIndex] = newsItem;
        document.querySelector('.news-form button').textContent = 'Add News';
        editingNewsIndex = null;
    } else {
        // Add new news
        news.push(newsItem);
    }

    document.getElementById('newsTopic').value = '';
    document.getElementById('newsContent').value = '';
    renderNews();
}

function deleteNews(index) {
    news.splice(index, 1);
    renderNews();
}

function editNews(index) {
    const newsItem = news[index];
    document.getElementById('newsTopic').value = newsItem.topic;
    document.getElementById('newsContent').value = newsItem.content;
    document.querySelector('.news-form button').textContent = 'Update News';
    editingNewsIndex = index;
}

function renderNews() {
    const container = document.getElementById('newsContainer');
    container.innerHTML = '';
    news.forEach((newsItem, index) => {
        const newsElement = document.createElement('div');
        newsElement.className = 'news-item';
        newsElement.innerHTML = `
            <h3>${newsItem.topic}</h3>
            <p>${newsItem.content}</p>
            <p class="news-date" >Posted on: ${newsItem.date}</p>
            <div class="news-actions">
                <button onclick="editNews(${index})">Edit</button>
                <button onclick="deleteNews(${index})">Delete</button>
            </div>
        `;
        container.appendChild(newsElement);
    });
}

renderNews();

