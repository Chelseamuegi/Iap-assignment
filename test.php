<?php
echo "<h1>Database Connection Test</h1>";

// Database credentials
$servername = "localhost";
$username   = "root";        // your MariaDB username
$password   = "newpassword123";            // your MariaDB password (empty if none)
$dbname     = "iap_assignment";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("<p style='color: red;'>❌ Connection failed: " . $conn->connect_error . "</p>");
}

echo "<p style='color: green;'>✅ Connected successfully to database: " . $dbname . "</p>";

$conn->close();
?>
