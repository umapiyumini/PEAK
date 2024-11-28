<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/amar/football.css">

    <title>FootBall</title>
    
</head>
<body>
      
	<main>
   <div class="bottom-nav">
	   <div class="sport">Foot Ball</div>
		  <nav>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Roster</a></li>
                        <li><a href="#">Players</a></li>
                        <li><a href="#">Coaches</a></li>
                        <li><a href="#">Schedule</a></li>
                        <li><a href="#">Record book</a></li>
						<li><a href="#">News</a></li>
                    </ul>
                </nav>
		  </div>
		
		<div class="content-container">
            <section class="main-content">
            <img src="<?=ROOT?>/assets/images/amar/football_team.jpg" alt="football_team">

                <h1>Team 2024</h1>
				<article class="captains">
			<div class="tile2">
            <img src="<?=ROOT?>/assets/images/amar/football_mencaptain.png" alt="cap-men">

				<p>Men's Captain</p>
				</div>
				<div class="tile2">
                <img src="<?=ROOT?>/assets/images/amar/football_womenscaptain.png" alt="cap-women">
                <p>Women's Captain</p>
				</div>
				<div class="tile2">
                <img src="<?=ROOT?>/assets/images/amar/football_mensvicecaptain.png" alt="vc-men">

					<p>Men's ViceCaptain</p>
				</div>
				<div class="tile2">
                <img src="<?=ROOT?>/assets/images/amar/football_womensvicecaptain.png" alt="vc-women">

					<p>Women's viceCaptain</p>
				</div>
			</article>
            </section>
			

             <aside class="latest-news">
             
            <h2>Latest News</h2>
            <div class="news-form">
                <input type="text" id="newsTopic" placeholder="News Topic">
                <textarea id="newsContent" placeholder="News Content"></textarea>
                <button onclick="addOrUpdateNews()">Add News</button>
            </div>
            <div id="newsContainer"></div>


            </aside>
        </div>
</main>
	<script src="navbar.js"></script>
    <script>
        // news.js

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


    </script>
</body>
</html>
