<?php
// Database configuration
$host = 'localhost';      // Your host (usually localhost)
$dbname = 'job_application_system';  // Your database name
$username = 'root';       // Database username
$password = '';           // Database password (leave empty for XAMPP default)

try {
    // Create a PDO instance to connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable error handling
} catch (PDOException $e) {
    // Catch and display any errors
    die("Connection failed: " . $e->getMessage());
}
?>
