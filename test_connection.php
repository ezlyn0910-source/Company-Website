<?php
// test_connection.php
include 'config/database.php';

$database = new Database();
$db = $database->getConnection();

if ($db) {
    echo "✅ Successfully connected to database with new user!";
    
    // Test if we can query
    $stmt = $db->query("SELECT DATABASE() as db_name");
    $result = $stmt->fetch();
    echo "<br>Connected to database: " . $result['db_name'];
} else {
    echo "❌ Connection failed";
}
?>