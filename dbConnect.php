<?php
require_once __DIR__ . '/vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Database connection settings
$host = $_ENV['DB_HOST'];
$username = $_ENV['DB_USER'];
$password = $_ENV['DB_PASSWORD'];
$database = $_ENV['DB_NAME'];
$port = 3306; // Default MySQL port number

// Initialize connection
$con = mysqli_init();
if (!$con) {
    die('MySQL initialization failed');
}

// Attempt to connect to the database
if (!mysqli_real_connect($con, $host, $username, $password, $database, $port, NULL, MYSQLI_CLIENT_SSL)) {
    die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
}

return $con;
?>