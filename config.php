<?php
// Database connection details
$db_host = 'localhost';
$db_name = 'user_db_mindTalk';
$db_user = 'root';
$db_password = '';

// Create a PDO connection to the database
try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}
?>
