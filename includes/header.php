<!DOCTYPE html>

<?php 
// Get current page from URL
$current_uri = $_SERVER['REQUEST_URI'];
$current_page = 'homepage'; // default

if (strpos($current_uri, '/journey') !== false) {
    $current_page = 'journey';
} elseif (strpos($current_uri, '/services') !== false) {
    $current_page = 'services';
} elseif (strpos($current_uri, '/news') !== false) {
    $current_page = 'news';
} elseif (strpos($current_uri, '/contact') !== false) {
    $current_page = 'contact';
}

$page_title = isset($page_title) ? $page_title : 'NR Intellitect';
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="icon" type="image/png" href="/public/images/nrlogo.png }}">
    <link rel="stylesheet" href="/public/css/base.css">
    <?php if (isset($extra_css)) { echo $extra_css; } ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <header id="main-header" class="header">
        <div class="header-container">
            <div class="logo-container">
                <img src="/public/images/nrlogo.png" class="company-logo">
                <a href="index.php">
                    <span class="company-name">
                        <span class="logo-text-secondary">NR Intellitech Sdn Bhd</span>
                    </span>
                </a>
            </div>

            <button class="mobile-menu-toggle" aria-label="Toggle navigation" aria-expanded="false">
                <span class="menu-bar"></span>
                <span class="menu-bar"></span>
                <span class="menu-bar"></span>
                <span class="sr-only">Menu</span>
            </button>

            <nav class="main-nav" aria-label="Main navigation">
                <ul>
                    <li><a href="/" class="nav-link <?php echo $current_page == 'homepage' ? 'active' : ''; ?>">
                        <span class="nav-link-content">Home</span></a></li>
                    <li><a href="/journey" class="nav-link <?php echo $current_page == 'journey' ? 'active' : ''; ?>">
                        <span class="nav-link-content">Our Journey</span></a></li>
                    <li><a href="/services" class="nav-link <?php echo $current_page == 'services' ? 'active' : ''; ?>">
                        <span class="nav-link-content">Services</span></a></li>
                    <li><a href="/news" class="nav-link <?php echo $current_page == 'news' ? 'active' : ''; ?>">
                        <span class="nav-link-content">Insights</span></a></li>
                    <li><a href="/contact" class="nav-cta">
                        <span class="cta-content">
                            <i class="fas fa-paper-plane contact-icon"></i>
                            <span>Contact Us</span>
                        </span>
                    </a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <main class="container">