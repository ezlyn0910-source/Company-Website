<?php
require_once __DIR__ . '/../../includes/auth.php';
requireAuth();

$page_title = "News Management - NR Intellitech";

// Include database
include __DIR__ . '/../../config/database.php';
$database = new Database();
$db = $database->getConnection();

// Check if database connection is successful
if ($db === null) {
    die("Database connection failed. Please check your database configuration.");
}

// Fetch all articles
$query = "SELECT * FROM news_articles ORDER BY date DESC";
$stmt = $db->prepare($query);
$stmt->execute();
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

        .news-management {
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--sagegreen);
        }

        .page-header h1 {
            color: var(--bone);
            font-size: 2.5rem;
            font-weight: 300;
            margin: 0;
            text-shadow: var(--glow-green);
        }

        .admin-actions .btn-primary {
            background: linear-gradient(135deg, var(--sagegreen) 0%, var(--shadowgreen) 100%);
            color: var(--bone);
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
            box-shadow: var(--box-shadow);
            border: 1px solid rgba(202, 215, 177, 0.2);
        }

        .admin-actions .btn-primary:hover {
            background: linear-gradient(135deg, var(--shadowgreen) 0%, var(--sagegreen) 100%);
            box-shadow: var(--box-shadow-hover);
            transform: translateY(-2px);
            border-color: var(--softyellow);
        }

        .news-table {
            width: 100%;
            background: var(--card-bg);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--box-shadow);
            border: 1px solid var(--sagegreen);
            backdrop-filter: blur(10px);
        }

        .news-table thead {
            background: linear-gradient(135deg, var(--pinetree) 0%, var(--shadowgreen) 100%);
            border-bottom: 2px solid var(--accent-gold);
        }

        .news-table th {
            color: var(--bone);
            padding: 1.2rem 1rem;
            font-weight: 600;
            text-align: left;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .news-table tbody tr {
            transition: var(--transition);
            border-bottom: 1px solid rgba(92, 107, 90, 0.3);
        }

        .news-table tbody tr:last-child {
            border-bottom: none;
        }

        .news-table tbody tr:hover {
            background: rgba(60, 90, 69, 0.3);
            transform: translateX(4px);
        }

        .news-table td {
            padding: 1.2rem 1rem;
            color: var(--text-light);
            border: none;
        }

        .news-table td:first-child {
            font-weight: 600;
            color: var(--bone);
        }

        .status-badge {
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-badge.published {
            background: rgba(60, 90, 69, 0.3);
            color: #4CAF50;
            border: 1px solid #4CAF50;
        }

        .status-badge.draft {
            background: rgba(218, 161, 18, 0.2);
            color: var(--softyellow);
            border: 1px solid var(--softyellow);
        }

        .status-badge.pending {
            background: rgba(201, 166, 61, 0.2);
            color: var(--accent-gold);
            border: 1px solid var(--accent-gold);
        }

        .actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            transition: var(--transition);
            border: 1px solid transparent;
        }

        .btn-edit {
            background: rgba(92, 107, 90, 0.3);
            color: var(--bone);
            border-color: var(--morningblue);
        }

        .btn-edit:hover {
            background: var(--morningblue);
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(92, 107, 90, 0.4);
        }

        .btn-delete {
            background: rgba(139, 0, 0, 0.2);
            color: #ff6b6b;
            border-color: #ff6b6b;
        }

        .btn-delete:hover {
            background: rgba(139, 0, 0, 0.4);
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(139, 0, 0, 0.3);
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: var(--card-bg);
            border-radius: 12px;
            border: 2px dashed var(--dustyblue);
            color: var(--text-muted);
        }

        .empty-state p {
            margin: 0.5rem 0;
            font-size: 1.1rem;
        }

        .category-tag {
            padding: 0rem 0rem;
            border-radius: 4px;
            font-size: 0.85rem;
            color: var(--bone);
        }

        .featured-badge {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            background: rgba(218, 161, 18, 0.2);
            color: var(--accent-gold);
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: 600;
            border: 1px solid var(--accent-gold);
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
            .news-management {
                padding: 1rem;
            }
            
            .page-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
            
            .page-header h1 {
                font-size: 2rem;
            }
            
            .news-table {
                font-size: 0.9rem;
            }
            
            .news-table th,
            .news-table td {
                padding: 0.8rem 0.5rem;
            }
            
            .actions {
                flex-direction: column;
                gap: 0.3rem;
            }
            
            .btn {
                padding: 0.4rem 0.8rem;
                font-size: 0.8rem;
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
                <a href="/admin/logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </nav>
    </header>

    <div class="admin-container">
        <aside class="sidebar">
            <ul class="sidebar-menu">
                <li><a href="/admin/index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="/admin/news" class="active"><i class="fas fa-newspaper"></i> News Management</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <div class="news-management">
                <div class="page-header">
                    <h1>News Management</h1>
                    <div class="admin-actions">
                        <a href="/admin/news/create.php" class="btn-primary">Create New Article</a>
                    </div>
                </div>

                <div>
                    <p>Notes: Please Choose ONLY THREE News for Featured News</p>
                    <br>
                </div>
                
                <?php if (empty($articles)): ?>
                    <div class="empty-state">
                        <p>No articles found or database connection issue.</p>
                        <p>Please check your database configuration.</p>
                    </div>
                <?php else: ?>
                    <table class="news-table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Featured</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($articles as $article): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($article['title']); ?></td>
                                <td><span class="category-tag"><?php echo ucfirst(str_replace('-', ' ', $article['category'])); ?></span></td>
                                <td><?php echo date('M j, Y', strtotime($article['date'])); ?></td>
                                <td>
                                    <span class="status-badge <?php echo $article['status']; ?>">
                                        <?php echo ucfirst($article['status']); ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($article['is_featured']): ?>
                                        <span class="featured-badge">Featured</span>
                                    <?php else: ?>
                                        <span style="color: var(--text-muted);">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="actions">
                                    <a href="/admin/news/edit.php?id=<?php echo $article['id']; ?>" class="btn btn-edit">Edit</a>
                                    <a href="/admin/news/delete.php?id=<?php echo $article['id']; ?>" 
                                       class="btn btn-delete" 
                                       onclick="return confirm('Are you sure you want to delete this article?')">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <script>
        // Simple animation on page load
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('.news-table tbody tr');
            rows.forEach((row, index) => {
                row.style.opacity = '0';
                row.style.transform = 'translateX(20px)';
                
                setTimeout(() => {
                    row.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    row.style.opacity = '1';
                    row.style.transform = 'translateX(0)';
                }, index * 100);
            });
        });
    </script>
</body>
</html>