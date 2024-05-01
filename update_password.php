<?php
session_start();
require_once 'db_connect.php';

// Check if user is logged in and has a valid role
if (!isset($_SESSION['userID']) || !isset($_SESSION['userRole'])) {
    header('Location: /login.php'); // Redirect to login page if not valid
    exit();
}

$userID = $_SESSION['userID'];
$userRole = $_SESSION['userRole'];

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['newPassword'])) {
    $newPassword = $_POST['newPassword'];
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Determine the correct table based on user role
    if ($userRole === 'admin' || $userRole === 'faculty') {
        $updateSql = "UPDATE users SET userPass = ? WHERE userID = ?";
        $newUserSql = "UPDATE users SET newUser = 0 WHERE userID = ?";
    } else if ($userRole === 'student') {
        $updateSql = "UPDATE students SET password = ? WHERE studentID = ?";
        $newUserSql = "UPDATE students SET newUser = 0 WHERE studentID = ?";
    }

    // Prepare and execute the password update
    $stmt = mysqli_prepare($con, $updateSql);
    mysqli_stmt_bind_param($stmt, "si", $hashedPassword, $userID);
    if (mysqli_stmt_execute($stmt)) {
        // Prepare and execute the newUser update
        $stmtNewUser = mysqli_prepare($con, $newUserSql);
        mysqli_stmt_bind_param($stmtNewUser, "i", $userID);
        mysqli_stmt_execute($stmtNewUser);
        mysqli_stmt_close($stmtNewUser);

        // Clear all session variables
        $_SESSION = array();

        // Destroy the session
        session_destroy();

        // Success message with redirect
        $message = "Password updated successfully. Redirecting to login in 3 seconds...";
        echo "<script type='text/javascript'>setTimeout(function() { window.location.href = 'login.php'; }, 3000);</script>";

    } else {
        echo "Error updating password: " . mysqli_error($con);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($con);
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Password</title>
</head>
<body>
    <h1>Update Your Password</h1>
    <form method="POST" action="update_password.php">
        <label for="newPassword">New Password:</label>
        <input type="password" id="newPassword" name="newPassword" required>
        <button type="submit">Update Password</button>
    </form>
</body>
</html>
<?php
}
?>