<?php
require_once __DIR__ . '/../../includes/auth.php';
requireAuth();

// Include database
include __DIR__ . '/../../config/database.php';
$database = new Database();
$db = $database->getConnection();

// Get article ID from URL
$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php?error=Article ID is required");
    exit;
}

// Check if article exists
$article = null;
try {
    $query = "SELECT * FROM news_articles WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$id]);
    $article = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    header("Location: index.php?error=Database error");
    exit;
}

if (!$article) {
    header("Location: index.php?error=Article not found");
    exit;
}

// Handle deletion confirmation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirm'])) {
        try {
            $query = "DELETE FROM news_articles WHERE id = ?";
            $stmt = $db->prepare($query);
            $stmt->execute([$id]);
            
            header("Location: index.php?success=Article deleted successfully");
            exit;
        } catch (PDOException $e) {
            header("Location: index.php?error=Database error: " . $e->getMessage());
            exit;
        }
    } else {
        // User cancelled deletion
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Article - NR Intellitech</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --pinetree: #1a2412;
            --dustyblue: #5c6b5a;
            --shadowgreen: #1e3525;
            --sagegreen: #3c5a45;
            --accent-gold: #DAA112;
            --morningblue: #6b7c72;
            --bone: #cad7b1;
            --softyellow: #c9a63d;
            --white: #FFFFFF;
            --card-bg: rgba(30, 35, 30, 0.7);
            --text-light: rgba(255, 255, 255, 0.85);
            --text-muted: rgba(255, 255, 255, 0.6);
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.231);
            --box-shadow-hover: 0 10px 15px rgba(0, 0, 0, 0.25);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--sagegreen) 0%, var(--shadowgreen) 100%);
            min-height: 100vh;
            color: var(--bone);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .delete-container {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 40px;
            box-shadow: var(--box-shadow);
            backdrop-filter: blur(10px);
            max-width: 500px;
            width: 100%;
            text-align: center;
        }

        .warning-icon {
            font-size: 4rem;
            color: #ff6b6b;
            margin-bottom: 1rem;
        }

        h1 {
            color: var(--bone);
            margin-bottom: 1rem;
            font-size: 2rem;
        }

        .article-info {
            background: rgba(139, 0, 0, 0.1);
            border: 1px solid #ff6b6b;
            border-radius: 8px;
            padding: 1.5rem;
            margin: 1.5rem 0;
            text-align: left;
        }

        .article-title {
            font-weight: 600;
            color: var(--bone);
            margin-bottom: 0.5rem;
        }

        .article-meta {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin: 0 0.5rem;
        }

        .btn-danger {
            background: #ff6b6b;
            color: white;
        }

        .btn-danger:hover {
            background: #ff5252;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: rgba(92, 107, 90, 0.3);
            color: var(--bone);
            border: 1px solid var(--morningblue);
        }

        .btn-secondary:hover {
            background: var(--morningblue);
        }

        .form-actions {
            margin-top: 2rem;
        }

        @media (max-width: 768px) {
            .delete-container {
                padding: 20px;
            }
            
            .form-actions {
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }
            
            .btn {
                margin: 0;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="delete-container">
        <div class="warning-icon">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        
        <h1>Delete Article</h1>
        
        <p>Are you sure you want to delete this article? This action cannot be undone.</p>
        
        <div class="article-info">
            <div class="article-title"><?php echo htmlspecialchars($article['title']); ?></div>
            <div class="article-meta">
                Category: <?php echo ucfirst(str_replace('-', ' ', $article['category'])); ?> | 
                Status: <?php echo ucfirst($article['status']); ?> | 
                Created: <?php echo date('M j, Y', strtotime($article['created_at'])); ?>
            </div>
        </div>

        <form method="POST" class="delete-form">
            <div class="form-actions">
                <a href="index.php" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                </a>
                <button type="submit" name="confirm" value="1" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Delete Article
                </button>
            </div>
        </form>
    </div>
</body>
</html>