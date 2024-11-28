<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events Dashboard</title>
    <style>
        /* style.css */

body {
    display: flex;
    margin: 0;
    font-family: Arial, sans-serif;
    color: #333;
}

.sidebar {
    width: 20%;
    background-color: #f5f7fa;
    padding: 20px;
    box-sizing: border-box;
}

.sidebar ul {
    list-style: none;
    padding: 0;
}

.sidebar ul li {
    padding: 10px;
    color: #555;
}

.sidebar ul li.active {
    background-color: #d1e8ff;
    border-radius: 5px;
    font-weight: bold;
    color: #333;
}

.sidebar .new-event {
    background-color: #0062ff;
    color: #fff;
    border: none;
    padding: 10px;
    border-radius: 5px;
    width: 100%;
    cursor: pointer;
    margin-top: 20px;
}

.sidebar .season-links {
    margin-top: 20px;
}

.sidebar .season-links p {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    color: #555;
    cursor: pointer;
}

.main {
    width: 100%;
    padding: 20px;
    box-sizing: border-box;
    margin-left: 220px;
    margin top: 20px;
}


.new-event-btn {
    background-color: #4B0082;
    color: #333;
    border: none;
    padding: 8px 16px;
    border-radius: 20px;
    cursor: pointer;
    margin: 10px;
}
.new-event-btn:hover {
    background-color:   #9370DB ;
}

.new-event-btn a {
    text-decoration: none;
    color: white;
}


.search-bar {
    margin-top: 20px;
}

.search-bar input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 10px;
    box-sizing: border-box;
}

.tabs {
    display: flex;
    gap: 10px;
    margin-top: 20px;
}

.tabs button {
    background-color: #f0f4f8;
    border: none;
    padding: 8px 12px;
    border-radius: 10px;
    cursor: pointer;
    color: #555;
}

.tabs .active {
    border-bottom: 2px solid #0062ff;
    font-weight: bold;
    color: #333;
}

.event-list {
    margin-top: 20px;
}

.event-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px;
    border-bottom: 1px solid #e0e0e0;
}

.event-item h2 {
    margin: 0;
    font-size: 1.1em;
    color: #333;
}

.event-item p {
    margin: 5px 0;
    color: #777;
    font-size: 0.9em;
}

.event-item .arrow {
    color: #aaa;
    font-size: 1.5em;
}


    </style>
</head>
<body>
<?php include 'nav.view.php';?>
    
    
    <div class="main">
        <div class="header">
            <h1>Events</h1>
            <button class="new-event-btn"><a href="newevent.php">New event</a></button>
        </div>

        <div class="search-bar">
            <input type="text" placeholder="Search events by name">
        </div>

        

        <div class="event-list">
            <div class="event-item">
                <h2>Colors Night 2023</h2>
                <p>3/5 teams RSVP'd</p>
                <p>April 27, 2023, 7:00 pm - 10:00 pm</p>
            </div>
            <div class="event-item">
                <h2>Spring tournament</h2>
                <p>4/5 teams RSVP'd</p>
                <p>May 6, 2023, 8:00 am - 5:00 pm</p>
      </div>
            <div class="event-item">
                <h2>End of year banquet</h2>
                <p>3/5 teams RSVP'd</p>
                <p>June 2, 2023, 5:00 pm - 11:00 pm</p>
            </div>
        </div>
    </div>
</body>
</html>
