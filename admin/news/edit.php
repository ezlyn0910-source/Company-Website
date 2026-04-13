<?php
require_once __DIR__ . '/../../includes/auth.php';
requireAuth();

$page_title = "Edit Article - NR Intellitech";

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

// Fetch article data
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

// Fetch categories
$categories = [];
$category_query = "SELECT * FROM news_categories ORDER BY name";
$category_stmt = $db->prepare($category_query);
$category_stmt->execute();
$categories = $category_stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $excerpt = $_POST['excerpt'] ?? '';
    $category = $_POST['category'] ?? '';
    $author = $_POST['author'] ?? 'Admin';
    $status = $_POST['status'] ?? 'draft';
    $is_featured = isset($_POST['is_featured']) ? 1 : 0;
    $image_url = $_POST['image_url'] ?? '';
    $external_link = $_POST['external_link'] ?? '';
    $date = $_POST['date'] ?? date('Y-m-d H:i:s');

    // Validate required fields
    $errors = [];
    if (empty($title)) $errors[] = "Title is required";
    if (empty($content)) $errors[] = "Content is required";
    if (empty($category)) $errors[] = "Category is required";

    // Validate image URL format (but don't require it to be a full URL)
    if (!empty($image_url) && !preg_match('/^https?:\/\//', $image_url) && !preg_match('/^\//', $image_url)) {
        // If it's not a full URL and not a path starting with /, prepend slash
        $image_url = '/' . ltrim($image_url, '/');
    }

    if (empty($errors)) {
        try {
            $query = "UPDATE news_articles SET 
                     title = ?, content = ?, excerpt = ?, category = ?, date = ?, 
                     author = ?, status = ?, is_featured = ?, image_url = ?, external_link = ?
                     WHERE id = ?";
            
            $stmt = $db->prepare($query);
            $stmt->execute([
                $title, $content, $excerpt, $category, $date, $author, $status, 
                $is_featured, $image_url, $external_link, $id
            ]);

            header("Location: index.php?success=Article updated successfully");
            exit;
        } catch (PDOException $e) {
            $errors[] = "Database error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Same CSS as before - keeping it concise */
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

        .main-content {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 30px;
            box-shadow: var(--box-shadow);
            backdrop-filter: blur(10px);
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
            font-size: 2rem;
            font-weight: 300;
            margin: 0;
        }

        .back-btn {
            background: rgba(92, 107, 90, 0.3);
            color: var(--bone);
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-decoration: none;
            border: 1px solid var(--morningblue);
            transition: var(--transition);
        }

        .back-btn:hover {
            background: var(--morningblue);
            transform: translateY(-1px);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--bone);
            font-weight: 600;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid var(--dustyblue);
            border-radius: 4px;
            color: var(--bone);
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--accent-gold);
            box-shadow: 0 0 0 2px rgba(218, 161, 18, 0.2);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .checkbox-group input {
            width: auto;
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
        }

        .btn-primary {
            background: var(--accent-gold);
            color: var(--shadowgreen);
        }

        .btn-primary:hover {
            background: #e6b310;
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
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid var(--dustyblue);
        }

        .alert {
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1rem;
        }

        .alert-error {
            background: rgba(139, 0, 0, 0.2);
            border: 1px solid #ff6b6b;
            color: #ff6b6b;
        }

        .form-note {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-top: 0.25rem;
            display: block;
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
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .form-actions {
                flex-direction: column;
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
                <li><a href="/admin/news"><i class="fas fa-newspaper"></i> News Management</a></li>
                <li><a href="/admin/news/create"><i class="fas fa-plus"></i> Create Article</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <div class="page-header">
                <h1>Edit Article</h1>
                <a href="index.php" class="back-btn"><i class="fas fa-arrow-left"></i> Back to Articles</a>
            </div>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-error">
                    <strong>Error:</strong>
                    <?php foreach ($errors as $error): ?>
                        <div><?php echo htmlspecialchars($error); ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="article-form">
                <div class="form-group">
                    <label for="title">Title *</label>
                    <input type="text" id="title" name="title" class="form-control" 
                           value="<?php echo htmlspecialchars($article['title']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="content">Content *</label>
                    <textarea id="content" name="content" class="form-control" rows="10" required><?php echo htmlspecialchars($article['content']); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="excerpt">Excerpt</label>
                    <textarea id="excerpt" name="excerpt" class="form-control" rows="3"><?php echo htmlspecialchars($article['excerpt']); ?></textarea>
                    <small class="form-note">Brief summary of the article (optional)</small>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="category">Category *</label>
                        <select id="category" name="category" class="form-control" required>
                            <option value="">Select Category</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?php echo $cat['slug']; ?>" 
                                    <?php echo $article['category'] === $cat['slug'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($cat['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="date">Publish Date</label>
                        <input type="datetime-local" id="date" name="date" class="form-control" 
                               value="<?php echo date('Y-m-d\TH:i', strtotime($article['date'])); ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" id="author" name="author" class="form-control" 
                               value="<?php echo htmlspecialchars($article['author']); ?>">
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="form-control">
                            <option value="draft" <?php echo $article['status'] === 'draft' ? 'selected' : ''; ?>>Draft</option>
                            <option value="published" <?php echo $article['status'] === 'published' ? 'selected' : ''; ?>>Published</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="image_url">Image URL</label>
                        <input type="text" id="image_url" name="image_url" class="form-control" 
                               value="<?php echo htmlspecialchars($article['image_url']); ?>"
                               placeholder="/public/images/example.jpg">
                        <small class="form-note">Enter relative path (e.g., /public/images/photo.jpg) or full URL</small>
                    </div>

                    <div class="form-group">
                        <label for="external_link">External Link</label>
                        <input type="url" id="external_link" name="external_link" class="form-control" 
                               value="<?php echo htmlspecialchars($article['external_link']); ?>"
                               placeholder="https://example.com/article">
                        <small class="form-note">Full URL including https:// (optional)</small>
                    </div>
                </div>

                <div class="form-group">
                    <div class="checkbox-group">
                        <input type="checkbox" id="is_featured" name="is_featured" value="1" 
                               <?php echo $article['is_featured'] ? 'checked' : ''; ?>>
                        <label for="is_featured">Feature this article</label>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="index.php" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Article
                    </button>
                </div>
            </form>
        </main>
    </div>

    <script>
        // Auto-generate excerpt from content if empty
        document.getElementById('content').addEventListener('blur', function() {
            const excerptField = document.getElementById('excerpt');
            if (!excerptField.value && this.value) {
                // Take first 150 characters as excerpt
                excerptField.value = this.value.substring(0, 150) + '...';
            }
        });

        // Auto-format image URL if it doesn't start with / or http
        document.getElementById('image_url').addEventListener('blur', function() {
            const value = this.value.trim();
            if (value && !value.startsWith('/') && !value.startsWith('http')) {
                this.value = '/' + value;
            }
        });
    </script>
</body>
</html>