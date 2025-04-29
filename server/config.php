<?php
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'impact_xchange';

$dbcon = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($dbcon->connect_error) {
    die("Connection error" . $dbcon->connect_error);
} else {
    // echo "<p>Database connection successful</p>";
}

?>