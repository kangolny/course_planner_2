<?php
session_start();
require_once 'db_connect.php';

$username = $_POST["username"];  // Assuming the form field for username is named 'username'
$password = $_POST["password"];  // Assuming the form field for password is named 'password'

// Sanitize input
$username = mysqli_real_escape_string($con, $username);
$password = mysqli_real_escape_string($con, $password);

// First, try to find the user in the 'users' table
$sql = "SELECT userID, userPass, userRole, email, newUser FROM users WHERE email = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $userID, $hashedPassword, $userRole, $email, $newUser);
$userFound = mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

if (!$userFound) {
    // If not found in 'users', check 'students' table
    $sql = "SELECT studentID, password, email, newUser FROM students WHERE email = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $userID, $hashedPassword, $email, $newUser);
    $userFound = mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Set userRole to 'student' if found in the students table
    if ($userFound) {
        $userRole = 'student';
    }
}

if ($userFound) {
    // Verify the password
    if (password_verify($password, $hashedPassword)) {
        // Password is correct
        $_SESSION['userRole'] = $userRole;
        $_SESSION['email'] = $email;
        $_SESSION['userID'] = $userID;

        if ($newUser == 1) {
            // Redirect to update_password.php without passing userID in the URL
            header("Location: update_password.php");
            exit();
        }

        // Redirect based on role
        if ($userRole === 'admin' || $userRole === 'faculty') {
            header('Location: admin.php');
            exit();
        } else if ($userRole === 'student') {
            header('Location: student_title.php');
            exit();
        }
    } else {
        echo "Password incorrect.";
    }
} else {
    echo "User not found.";
}

mysqli_close($con);