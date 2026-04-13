<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

require_once __DIR__ . '/../includes/auth.php';
requireAuth();

$page_title = "Admin Dashboard - NR Intellitech";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --pinetree: #1a2412;          /* Darker pine tree */
            --dustyblue: #5c6b5a;         /* Muted dusty blue */
            --shadowgreen: #1e3525;       /* Deeper shadow green */

            --sagegreen: #3c5a45;         /* Darker sage green */
            --accent-gold: #DAA112;       /* Keeping gold accent */
            --dark-green: #091a0f;        /* Darker green */
            --morningblue: #6b7c72;       /* Darker morning blue */
            --bone: #cad7b1;              /* Dark bone color */
            --softyellow: #c9a63d;        /* Muted soft yellow */
            --white: #FFFFFF;
            --black: #000000;
            --primary-blue: #0A2540;

            --card-bg: rgba(30, 35, 30, 0.7);
            --section-bg: #111811;
            --text-light: rgba(255, 255, 255, 0.85);
            --text-muted: rgba(255, 255, 255, 0.6);

            --glow-green: 0 0 15px rgba(83, 125, 93, 0.3);
            --softyellow-border: 1px solid var(--softyellow);
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.231);
            --box-shadow-hover: 0 10px 15px rgba(0, 0, 0, 0.25);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--sagegreen) 0%, var(--shadowgreen) 100%);
            min-height: 100vh;
            color: var(--bone);
        }

        .admin-header {
            background: var(--shadowgreen);
            padding: 15px 30px;
            border-bottom: 1px solid var(--accent-gold);
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .admin-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1400px;
            margin: 0 auto;
        }

        .admin-nav h1 {
            color: var(--white);
            font-size: 1.8rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .admin-nav h1 i {
            color: var(--accent-gold);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
            color: var(--bone);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--accent-gold);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: var(--shadowgreen);
        }

        .logout-btn {
            padding: 8px 16px;
            background: #f10018ff;
            color: white;
            text-decoration: none;
            border-radius: 20px;
            font-size: 16px;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .logout-btn:hover {
            background: #c00014;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .admin-container {
            max-width: 1400px;
            margin: 30px auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 250px 1fr;
            gap: 25px;
        }

        .sidebar {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 20px;
            box-shadow: var(--box-shadow);
            height: fit-content;
            backdrop-filter: blur(10px);
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            margin-bottom: 5px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            color: var(--bone);
            text-decoration: none;
            border-radius: 8px;
            transition: var(--transition);
        }

        .sidebar-menu a:hover, .sidebar-menu a.active {
            background: rgba(218, 161, 18, 0.1);
            color: var(--accent-gold);
            border-left: 3px solid var(--accent-gold);
        }

        .sidebar-menu a i {
            width: 20px;
            text-align: center;
        }

        .main-content {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .welcome-message {
            background: var(--card-bg);
            padding: 25px;
            border-radius: 12px;
            box-shadow: var(--box-shadow);
            backdrop-filter: blur(10px);
            border-left: 4px solid var(--accent-gold);
        }

        .welcome-message h2 {
            color: var(--white);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .welcome-message h2 i {
            color: var(--accent-gold);
        }

        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

    
        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .card {
            background: var(--card-bg);
            padding: 25px;
            border-radius: 12px;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--box-shadow-hover);
            border-color: rgba(218, 161, 18, 0.3);
        }

        .card h3 {
            color: var(--white);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card h3 i {
            color: var(--accent-gold);
        }

        .card p {
            color: var(--text-muted);
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .card-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: var(--accent-gold);
            color: var(--shadowgreen);
            text-decoration: none;
            border-radius: 6px;
            transition: var(--transition);
            font-weight: 600;
        }

        .card-btn:hover {
            background: #e6b310;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .activity-list {
            list-style: none;
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(218, 161, 18, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent-gold);
        }

        .activity-content {
            flex: 1;
        }

        .activity-content p {
            margin-bottom: 5px;
            color: var(--bone);
        }

        .activity-time {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        @media (max-width: 1024px) {
            .admin-container {
                grid-template-columns: 1fr;
            }
            
            .sidebar {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .stats-cards, .dashboard-cards {
                grid-template-columns: 1fr;
            }
            
            .admin-nav {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <header class="admin-header">
        <nav class="admin-nav">
            <h1><i class="fas fa-cogs"></i> NR Intellitech Admin</h1>
            <div class="user-info">
                <div class="user-avatar"><?php echo substr(htmlspecialchars($_SESSION['admin_username'] ?? 'A'), 0, 1); ?></div>
                <span>Welcome, <?php echo htmlspecialchars($_SESSION['admin_username'] ?? 'Admin'); ?></span>
                <a href="logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </nav>
    </header>

    <div class="admin-container">
        <aside class="sidebar">
            <ul class="sidebar-menu">
                <li><a href="/admin/index.php" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="/admin/news"><i class="fas fa-newspaper"></i> News Management</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <div class="welcome-message">
                <h2><i class="fas fa-home"></i> Dashboard Overview</h2>
                <p>Welcome to the NR Intellitech admin panel. Manage your website content, users, and analytics from this centralized dashboard.</p>
            </div>

            <div class="dashboard-cards">
                <div class="card">
                    <h3><i class="fas fa-newspaper"></i> News Management</h3>
                    <p>Create, edit, and manage news articles and insights. Publish new content and moderate existing posts.</p>
                    <a href="/admin/news" class="card-btn">Manage News <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Simple animation on page load
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.card, .stat-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</body>
</html>