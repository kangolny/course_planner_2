<?php
session_start();  // Start the session at the beginning of the script

require_once 'db_connect.php';

$username = $_POST["username"];  // Assuming the form field for username is named 'username'
$password = $_POST["password"];  // Assuming the form field for password is named 'password'

// Sanitize input
$username = mysqli_real_escape_string($con, $username);
$password = mysqli_real_escape_string($con, $password);

// Prepare SQL statement to fetch the user, hashed password, and role
$sql = "SELECT userPass, userRole, email FROM users WHERE email = ?";  // Adjust the field and table names as necessary

$stmt = mysqli_prepare($con, $sql);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $hashedPassword, $userRole, $email);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Verify the password
    if (password_verify($password, $hashedPassword)) {
        // Password is correct
        // Store userRole and email in session
        $_SESSION['userRole'] = $userRole;
        $_SESSION['email'] = $email;

        // Redirect based on role
        if ($userRole === 'admin') {
            header('Location: /gary/admin.php'); // Adjust the path as needed
            exit();
        } else {
            header('Location: /gary/studeent_title.php'); // Adjust the path as needed
            exit();
        }
    } else {
        // Password is not correct
        echo "Password incorrect.";
    }
} else {
    echo "Error preparing statement: " . mysqli_error($con);
}

mysqli_close($con);
?>