<?php
// Only start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Simple admin credentials (you can move this to config later)
$admin_username = 'admin';
$admin_password = 'nr_intellitech_2024'; // Change this to a strong password

/**
 * Check if admin is logged in
 */
function isAdminLoggedIn() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

/**
 * Require authentication - redirect to login if not logged in
 */
function requireAuth() {
    if (!isAdminLoggedIn()) {
        // Use relative path for local development
        header('Location: login.php');
        exit;
    }
}

/**
 * Attempt to login with credentials
 */
function attemptLogin($username, $password) {
    global $admin_username, $admin_password;
    
    // Simple authentication (you can enhance this with database later)
    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        $_SESSION['login_time'] = time();
        return true;
    }
    
    return false;
}

function logout() {
    $_SESSION = array();
    session_destroy();
    header('Location: login.php?logout=success');
    exit;
}

?>