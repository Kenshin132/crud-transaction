<?php
$databaseHost = 'localhost';
$databaseName = 'progskills';
$databaseUsername = 'root';
$databasePassword = ''; // Replace 'your_password' with your actual MySQL root password

// Open a new connection to the MySQL server
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

// Check if the connection was successful
if ($mysqli === false) {
    die("Connection failed: " . mysqli_connect_error());
}
?>