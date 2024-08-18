<!-- DATABASE HANDLER -->
 <?php

$host = 'localhost';
$dbname = 'hotel';
$dbusername = 'root';
$dbpassword = "";

// CONNECT WITH DATABASE
try {
    // Connection object for our database.
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
 