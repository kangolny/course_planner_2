<?php
session_start();  // Start the session

if (!isset($_SESSION['userRole']) || $_SESSION['userRole'] !== 'admin') {
    // Redirect non-admin users to a different page or show an error
    header('Location: /login.php'); // Redirect to login page
    exit();
}

// Assuming userRole and email are stored in session
$userRole = isset($_SESSION['userRole']) ? $_SESSION['userRole'] : 'No role found';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : 'No email found';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User</title>
    <link rel="stylesheet" href="adminfiles.css">
</head>
<body>
    <div class="form-container">
        <h1>New User</h1>
        <form action="submit_user.php" method="POST">
            <div class="input-group">
                <label for="firstName">First name:</label>
                <input type="text" id="firstName" name="firstName" required>
            </div>
            <div class="input-group">
                <label for="lastName">Last name:</label>
                <input type="text" id="lastName" name="lastName" required>
            </div>
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="mobile">Mobile:</label>
                <input type="text" id="mobile" name="mobile" placeholder="Country Code - Mobile" required>
            </div>
            <div class="input-group">
                <label>User Role:</label>
                <div class="radio-group">
                    <input type="radio" id="student" name="userRole" value="Student" required>
                    <label for="student">Student</label>
                    <input type="radio" id="faculty" name="userRole" value="Faculty" required>
                    <label for="faculty">Faculty</label>
                    <input type="radio" id="admin" name="userRole" value="System Administrator" required>
                    <label for="admin">System Administrator</label>
                </div>
            </div>
            <div class="input-group">
                <input type="checkbox" id="notify" name="notify">
                <label for="notify">Notify when user has logged in for the first time</label>
            </div>
            <div class="form-actions">
                <button type="button" onclick="window.location.href='manage_users.php'">Cancel</button>
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>