<?php
$page_title = "Insight - NR Intellitech";
$extra_css = '
<link rel="stylesheet" href="/public/css/homepage.css">
<link rel="stylesheet" href="/public/css/insight.css">
';

// Include database connection
include 'config/database.php';
$database = new Database();
$db = $database->getConnection();

// Fetch featured articles (is_featured = TRUE and status = published)
$featured_articles = [];
try {
    $featured_query = "SELECT * FROM news_articles WHERE is_featured = TRUE AND status = 'published' ORDER BY date DESC LIMIT 3";
    $featured_stmt = $db->prepare($featured_query);
    $featured_stmt->execute();
    $featured_articles = $featured_stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // If database fails, use fallback data
    $featured_articles = [];
}

// Fetch all published articles for the main grid
$all_articles = [];
$category_counts = [];
try {
    $all_query = "SELECT * FROM news_articles WHERE status = 'published' ORDER BY date DESC";
    $all_stmt = $db->prepare($all_query);
    $all_stmt->execute();
    $all_articles = $all_stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Count articles by category
    $count_query = "SELECT category, COUNT(*) as count FROM news_articles WHERE status = 'published' GROUP BY category";
    $count_stmt = $db->prepare($count_query);
    $count_stmt->execute();
    $category_counts_result = $count_stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($category_counts_result as $row) {
        $category_counts[$row['category']] = $row['count'];
    }
} catch (PDOException $e) {
    // If database fails, use fallback data
    $all_articles = [];
    $category_counts = [];
}

include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="insight-hero full-bleed">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1>Insights & News</h1>
        <p class="subtitle">Stay updated with the latest trends, innovations, and company announcements</p>
        <div class="scroll-indicator">
            <span>Explore our insights</span>
            <div class="arrow"></div>
        </div>
    </div>
</section>

<!-- Featured News Section -->
<section class="featured-news section-padding full-bleed">
    <div class="container">
        <header class="section-header">
            <span class="section-eyebrow">Latest Updates</span>
            <h2 class="section-title">Featured Insights</h2>
            <p class="section-note">Discover our most recent thought leadership articles, press releases, and industry analyses.</p>
        </header>
        
        <div class="featured-news-grid">
            <?php if (!empty($featured_articles)): ?>
                <?php foreach ($featured_articles as $article): ?>
                <article class="enhanced-news-card">
                    <div class="news-image">
                        <img src="<?php echo htmlspecialchars($article['image_url']); ?>" alt="<?php echo htmlspecialchars($article['title']); ?>">
                        <div class="enhanced-image-overlay"></div>
                    </div>
                    <div class="enhanced-news-content">
                        <div class="enhanced-news-meta">
                            <span class="enhanced-news-date"><?php echo date('F j, Y', strtotime($article['date'])); ?></span>
                        </div>
                        <h3><?php echo htmlspecialchars($article['title']); ?></h3>
                        <p class="enhanced-news-excerpt"><?php echo htmlspecialchars($article['excerpt']); ?></p>
                        <div class="enhanced-card-footer">
                            <span class="enhanced-news-category"><?php echo ucfirst(str_replace('-', ' ', $article['category'])); ?></span>
                        </div>
                    </div>
                </article>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Fallback featured articles if database is empty -->
                <article class="enhanced-news-card">
                    <div class="news-image">
                        <img src="/public/images/news/featured1.png" alt="Service">
                        <div class="enhanced-image-overlay"></div>
                    </div>
                    <div class="enhanced-news-content">
                        <div class="enhanced-news-meta">
                            <span class="enhanced-news-date">November 15, 2023</span>
                        </div>
                        <h3>How Digital Transformation is Reshaping Enterprise IT</h3>
                        <p class="enhanced-news-excerpt">Explore the key trends driving digital transformation and how businesses can adapt to stay competitive in the evolving technological landscape.</p>
                        <div class="enhanced-card-footer">
                            <span class="enhanced-news-category">Industry Analysis</span>
                        </div>
                    </div>
                </article>
                
                <article class="enhanced-news-card">
                    <div class="news-image">
                        <img src="/public/images/news/featured2.png" alt="Product">
                        <div class="enhanced-image-overlay"></div>
                    </div>
                    <div class="enhanced-news-content">
                        <div class="enhanced-news-meta">
                            <span class="enhanced-news-date">November 10, 2023</span>
                        </div>
                        <h3>Introducing Our New Secure Data Management Platform</h3>
                        <p class="enhanced-news-excerpt">We're excited to announce our latest innovation in secure data management, designed to help enterprises protect their most valuable assets.</p>
                        <div class="enhanced-card-footer">
                            <span class="enhanced-news-category">Product News</span>
                        </div>
                    </div>
                </article>
                
                <article class="enhanced-news-card">
                    <div class="news-image">
                        <img src="/public/images/news/featured3.png" alt="Cybersecurity">
                        <div class="enhanced-image-overlay"></div>
                    </div>
                    <div class="enhanced-news-content">
                        <div class="enhanced-news-meta">
                            <span class="enhanced-news-date">November 5, 2023</span>
                        </div>
                        <h3>Advanced Threat Detection for Modern Enterprises</h3>
                        <p class="enhanced-news-excerpt">Learn about our new AI-powered threat detection system that helps businesses stay ahead of emerging cybersecurity threats.</p>
                        <div class="enhanced-card-footer">
                            <span class="enhanced-news-category">Cybersecurity</span>
                        </div>
                    </div>
                </article>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- All News Section -->
<section class="all-news section-padding bg-dark full-bleed">
    <div class="container">
        <header class="section-header">
            <span class="section-eyebrow">Our Publications</span>
            <h2 class="section-title">All Insights</h2>
            <p class="section-note">Browse our complete collection of articles, press releases, and industry commentary.</p>
        </header>
        
        <!-- Category Filter -->
        <div class="enhanced-news-filter">
            <button class="enhanced-filter-btn active" data-filter="all">
                All Articles <span class="filter-count"><?php echo count($all_articles); ?></span>
            </button>
            <?php
            // Define all possible categories with their display names
            $categories = [
                'data-destruction' => 'Data Destruction',
                'cybersecurity' => 'Cybersecurity',
                'it-assets' => 'IT Assets Handling',
                'compliance' => 'Compliance',
                'e-commerce' => 'E-commerce',
                'industry-analysis' => 'Industry Analysis',
                'product-news' => 'Product News',
                'company-news' => 'Company News'
            ];
            
            foreach ($categories as $slug => $name) {
                $count = $category_counts[$slug] ?? 0;
                if ($count > 0) {
                    echo '<button class="enhanced-filter-btn" data-filter="' . $slug . '">';
                    echo $name . ' <span class="filter-count">' . $count . '</span>';
                    echo '</button>';
                }
            }
            ?>
        </div>
        
        <!-- View Toggle -->
        <div class="view-toggle">
            <button class="view-toggle-btn active" data-view="grid" aria-label="Grid view">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                    <path d="M0 0h6v6H0V0zm0 10h6v6H0v-6zm10 0h6v6h-6v-6zm0-10h6v6h-6V0z"/>
                </svg>
            </button>
            <button class="view-toggle-btn" data-view="list" aria-label="List view">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                    <path d="M0 1h16v2H0V1zm0 4h16v2H0V5zm0 4h16v2H0V9zm0 4h16v2H0v-2z"/>
                </svg>
            </button>
        </div>
        
        <div class="news-grid">
            <?php if (!empty($all_articles)): ?>
                <?php foreach ($all_articles as $article): ?>
                <article class="enhanced-news-card" data-category="<?php echo $article['category']; ?>">
                    <div class="news-image">
                        <img src="<?php echo htmlspecialchars($article['image_url']); ?>" alt="<?php echo htmlspecialchars($article['title']); ?>">
                        <div class="enhanced-image-overlay"></div>
                    </div>
                    <div class="enhanced-news-content">
                        <div class="enhanced-news-meta">
                            <span class="enhanced-news-date"><?php echo date('F j, Y', strtotime($article['date'])); ?></span>
                        </div>
                        <h3><?php echo htmlspecialchars($article['title']); ?></h3>
                        <p class="enhanced-news-excerpt"><?php echo htmlspecialchars($article['excerpt']); ?></p>
                        <div class="enhanced-card-footer">
                            <span class="enhanced-news-category"><?php echo ucfirst(str_replace('-', ' ', $article['category'])); ?></span>
                            <div class="enhanced-card-actions">
                                <?php if (!empty($article['external_link'])): ?>
                                    <a href="<?php echo htmlspecialchars($article['external_link']); ?>" class="enhanced-read-more" target="_blank">Read more</a>
                                <?php else: ?>
                                    <span class="enhanced-read-more no-link">Read more</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </article>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Fallback articles if database is empty -->
                <?php
                $fallback_articles = [
                    [
                        'title' => 'Data Destruction Services Industry Forecast to 2030',
                        'category' => 'data-destruction',
                        'date' => 'May 28, 2025',
                        'excerpt' => 'A report on how data wiping, encryption, hardware destruction & related services are evolving',
                        'image' => '/public/images/data-destruction1.png',
                        'link' => 'https://finance.yahoo.com/news/data-destruction-services-industry-forecast-160700132.html?utm_source=chatgpt.com'
                    ],
                    [
                        'title' => 'Auditors Uncover Lax FBI Hard Drive Disposal Practices',
                        'category' => 'data-destruction',
                        'date' => 'October 25, 2023',
                        'excerpt' => 'Auditors found that the FBI had problems in how hard drives awaiting destruction were handled, including being stored in open boxes and delays in destruction.',
                        'image' => '/public/images/data-destruction2.png',
                        'link' => 'https://www.bankinfosecurity.com/auditors-uncover-lax-fbi-hard-drive-disposal-practices-a-26135?utm_source=chatgpt.com'
                    ],
                    // ... include other fallback articles as needed
                ];
                
                foreach ($fallback_articles as $item) {
                    echo '
                    <article class="enhanced-news-card" data-category="' . $item['category'] . '">
                        <div class="news-image">
                            <img src="' . $item['image'] . '" alt="' . htmlspecialchars($item['title']) . '">
                            <div class="enhanced-image-overlay"></div>
                        </div>
                        <div class="enhanced-news-content">
                            <div class="enhanced-news-meta">
                                <span class="enhanced-news-date">' . $item['date'] . '</span>
                            </div>
                            <h3>' . $item['title'] . '</h3>
                            <p class="enhanced-news-excerpt">' . $item['excerpt'] . '</p>
                            <div class="enhanced-card-footer">
                                <span class="enhanced-news-category">' . ucfirst(str_replace('-', ' ', $item['category'])) . '</span>
                                <div class="enhanced-card-actions">
                                    <a href="' . $item['link'] . '" class="enhanced-read-more">Read more</a>
                                </div>
                            </div>
                        </div>
                    </article>';
                }
                ?>
            <?php endif; ?>
        </div>
        
        <?php if (empty($all_articles) && empty($fallback_articles)): ?>
            <div class="no-articles-message">
                <p>No articles available at the moment. Please check back later.</p>
            </div>
        <?php endif; ?>
    </div>
</section>


<?php
$extra_js = '
<script src="/public/js/insight.js"></script>
';
include 'includes/footer.php';
?>