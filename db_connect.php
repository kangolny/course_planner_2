<?php

// Database connection settings
$host = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$database = getenv('DB_NAME');
$port = 3306; // Default MySQL port number

// Initialize connection
$con = mysqli_init();
// mysqli_ssl_set($con, NULL, NULL, "C:/Users/thomas.flock/Downloads/DigiCertGlobalRootCA.crt.pem", NULL, NULL);
// Ensure that the MYSQLI_CLIENT_SSL flag is not used if SSL is not required
if (!mysqli_real_connect($con, 'ncat-cpserver.mysql.database.azure.com', 'Ncadmin', 'Aggiepride123!', 'ncat-cp', $port)) {
    die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
}

return $con;