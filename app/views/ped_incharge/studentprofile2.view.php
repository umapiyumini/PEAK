<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile - Physical Education Management System</title>
    <style>
        :root {
            --primary-color: #1e3a8a;
            --secondary-color: #3b82f6;
            --accent-color: #f59e0b;
            --light-gray: #f3f4f6;
            --dark-gray: #4b5563;
            --success-color: #10b981;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f9fafb;
            color: #1f2937;
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        header {
            background-color: var(--primary-color);
            color: white;
            padding: 16px 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 24px;
            font-weight: bold;
        }
        
        .nav-menu a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-weight: 500;
        }
        
        .nav-menu a:hover {
            text-decoration: underline;
        }
        
        .profile-container {
            display: flex;
            flex-wrap: wrap;
            gap: 24px;
            margin-top: 32px;
        }
        
        .profile-sidebar {
            flex: 1;
            min-width: 280px;
            max-width: 320px;
        }
        
        .profile-content {
            flex: 3;
            min-width: 300px;
        }
        
        .profile-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 24px;
        }
        
        .profile-photo {
            position: relative;
            background-color: var(--light-gray);
            height: 200px;
            display: flex;
            justify-content: center;
            padding: 16px;
        }
        
        .profile-photo img {
            height: 100%;
            width: auto;
            object-fit: cover;
            border-radius: 4px;
        }
        
        .profile-details {
            padding: 20px;
        }
        
        .student-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 8px;
            color: var(--primary-color);
        }
        
        .student-id {
            color: var(--dark-gray);
            font-size: 14px;
            margin-bottom: 16px;
        }
        
        .detail-item {
            margin-bottom: 12px;
            display: flex;
        }
        
        .detail-label {
            font-weight: 500;
            width: 120px;
            color: var(--dark-gray);
        }
        
        .detail-value {
            flex: 1;
        }
        
        .card-header {
            background-color: var(--light-gray);
            padding: 12px 20px;
            font-weight: 600;
            color: var(--primary-color);
            border-bottom: 1px solid #e5e7eb;
        }
        
        .card-body {
            padding: 20px;
        }
        
        .sport-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .sport-item:last-child {
            border-bottom: none;
        }
        
        .sport-name {
            font-weight: 500;
        }
        
        .sport-position {
            color: var(--dark-gray);
        }
        
        .sport-level {
            background-color: var(--secondary-color);
            color: white;
            padding: 2px 10px;
            border-radius: 12px;
            font-size: 12px;
        }
        
        .tournament-item {
            margin-bottom: 16px;
            padding-bottom: 16px;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .tournament-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .tournament-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        
        .tournament-name {
            font-weight: 600;
        }
        
        .tournament-date {
            color: var(--dark-gray);
            font-size: 14px;
        }
        
        .tournament-result {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            font-weight: 500;
            font-size: 14px;
            margin-top: 4px;
        }
        
        .result-win {
            background-color: #d1fae5;
            color: #065f46;
        }
        
        .result-second {
            background-color: #e0f2fe;
            color: #0369a1;
        }
        
        .result-participant {
            background-color: #f3f4f6;
            color: #4b5563;
        }
        
        .awards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 16px;
        }
        
        .award-item {
            background-color: var(--light-gray);
            border-radius: 8px;
            padding: 16px;
            text-align: center;
            transition: transform 0.2s;
        }
        
        .award-item:hover {
            transform: translateY(-5px);
        }
        
        .award-icon {
            font-size: 32px;
            margin-bottom: 8px;
        }
        
        .college-color {
            color: var(--accent-color);
        }
        
        .university-color {
            color: var(--primary-color);
        }
        
        .national-color {
            color: var(--success-color);
        }
        
        .award-name {
            font-weight: 500;
            margin-bottom: 4px;
        }
        
        .award-year {
            color: var(--dark-gray);
            font-size: 14px;
        }
        
        .breadcrumb {
            display: flex;
            margin-bottom: 16px;
            font-size: 14px;
        }
        
        .breadcrumb a {
            color: var(--secondary-color);
            text-decoration: none;
        }
        
        .breadcrumb span {
            margin: 0 8px;
            color: var(--dark-gray);
        }
        
        .action-button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.2s;
        }
        
        .action-button:hover {
            background-color: #152b67;
        }
        
        .secondary-button {
            background-color: white;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
            padding: 9px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.2s;
            margin-right: 12px;
        }
        
        .secondary-button:hover {
            background-color: #f8fafc;
        }
        
        .action-bar {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }
        
        @media (max-width: 768px) {
            .profile-container {
                flex-direction: column;
            }
            
            .profile-sidebar {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <?php include 'sidebar.view.php'; ?>
    
    <main class="container">
        
        <div class="profile-container">
            <div class="profile-sidebar">
                <div class="profile-card">
                    <div class="profile-photo">
                        <img src="/api/placeholder/200/200" alt="Student Photo">
                    </div>
                    <div class="profile-details">
                    <?php if (!empty($studentDetails)) : ?>
                        <h1 class="student-name"><?=$studentDetails[0]->name?></h1>
                        <div class="regno"><?=$studentDetails[0]->registrationnumber?></div>
                        
                        <div class="detail-item">
                            <div class="detail-label">Faculty:</div>
                            <div class="detail-value"><?=$studentDetails[0]->faculty?></div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Department:</div>
                            <div class="detail-value"><?=$studentDetails[0]->department?></div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">NIC:</div>
                            <div class="detail-value"><?=$studentDetails[0]->nic ?></div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Registered Date:</div>
                            <div class="detail-value"><?=$studentDetails[0]->id_start?></div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">ID Expiry Date:</div>
                            <div class="detail-value"><?=$studentDetails[0]->id_end?></div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Gender:</div>
                            <div class="detail-value"><?=$studentDetails[0]->gender?></div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">Date of Birth:</div>
                            <div class="detail-value"><?=$studentDetails[0]->date_of_birth ?></div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">Contact:</div>
                            <div class="detail-value"><?=$studentDetails[0]->contact_number?></div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">Email:</div>
                            <div class="detail-value"><?=$studentDetails[0]->email ?></div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">Address:</div>
                            <div class="detail-value"><?=$studentDetails[0]->address ?></div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="profile-card">
                    <div class="card-header">
                        Active Sports
                    </div>
                    <div class="card-body">
                        <div class="sport-item">
                            <div>
                                <div class="sport-name"></div>
                                <div class="sport-position"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="profile-content">
                <div class="profile-card">
                    <div class="card-header">
                        Tournament History
                    </div>
                    <div class="card-body">    
                        <div class="tournament-item">
                            <div class="tournament-header">
                                <div class="tournament-name"></div>
                                <div class="tournament-date"></div>
                            </div>
                            <div>
                                <div class="tournament-result result-win"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="profile-card">
                    <div class="card-header">
                        Color Awards & Achievements
                    </div>
                    <div class="card-body">
                        <div class="awards-grid">
                            <div class="award-item">
                                <div class="award-name"></div>
                                <div class="award-year"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="action-bar">
                    <button class="secondary-button">Export Profile</button>
                    <button class="action-button">Edit Profile</button>
                </div>
            </div>
        </div>
    </main>
</body>
</html>