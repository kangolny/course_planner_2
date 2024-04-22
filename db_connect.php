<?php




// Database connection settings
$host = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$database = getenv('DB_NAME');
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