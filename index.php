<?php
// Main router file
$request = $_SERVER['REQUEST_URI'];
$base_path = '/nr_website_php'; // Change this to your project folder name

// Remove base path from request
$request = str_replace($base_path, '', $request);
$request = parse_url($request, PHP_URL_PATH);

// Define routes
$routes = [
    '/' => 'pages/homepage.php',
    '/home' => 'pages/homepage.php',
    '/index' => 'pages/homepage.php',
    '/index.php' => 'pages/homepage.php',
    '/contact' => 'pages/contact.php',
    '/services' => 'pages/services.php',
    '/journey' => 'pages/journey.php',
    '/news' => 'pages/insight.php',
    // ADMIN ROUTES
    '/admin' => 'admin/index.php',
    '/admin/login' => 'admin/login.php',
    '/admin/logout' => 'admin/logout.php',
    '/admin/news' => 'admin/news/index.php',
    '/admin/news/create' => 'admin/news/create.php',
    '/admin/news/edit' => 'admin/news/edit.php',
    '/admin/news/delete' => 'admin/news/delete.php',
];

// Remove trailing slash
$request = rtrim($request, '/');

// Default to homepage if empty
if ($request === '') {
    $request = '/';
}

// Check if route exists
if (isset($routes[$request])) {
    $page_file = $routes[$request];
    
    // Check if the file exists
    if (file_exists($page_file)) {
        // Set page-specific variables before including
        switch ($request) {
            case '/contact':
                $page_title = "Contact - NR Intellitech";
                $extra_css = '<link rel="stylesheet" href="/public/css/contact.css">';
                break;
            case '/services':
                $page_title = "Our Services - NR Intellitech";
                $extra_css = '<link rel="stylesheet" href="/public/css/homepage.css"><link rel="stylesheet" href="/public/css/services.css">';
                break;
            case '/journey':
                $page_title = "Journey - NR Intellitech";
                $extra_css = '
                <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
                <link rel="stylesheet" href="/public/css/homepage.css">
                <link rel="stylesheet" href="/public/css/journey.css">';
                break;
            case '/news':
                $page_title = "Insights - NR Intellitech";
                $extra_css = '<link rel="stylesheet" href="/public/css/news.css">';
                break;
            default:
                $page_title = "Home - NR Intellitech";
                $extra_css = '
                <link rel="stylesheet" href="/public/css/homepage.css">
                <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollTrigger.min.js"></script>';
        }
        
        include $page_file;
    } else {
        // Page not found
        header("HTTP/1.0 404 Not Found");
        include 'pages/404.php';
    }
} else {
    // Route not found
    header("HTTP/1.0 404 Not Found");
    include 'pages/404.php';
}
?>