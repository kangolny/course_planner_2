<?php
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Include the database connection file
    require_once 'db_connect.php';

    // Assuming $con is your connection variable in db_connect.php
    // Get user input from the form

    $password = mysqli_real_escape_string($con, $_POST['password']);
    $email = mysqli_real_escape_string($con, $_POST['email']);

    // Password hashing for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and bind
    $stmt = mysqli_prepare($con, "INSERT INTO users (userPass, email) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, "ss", $hashedPassword, $email);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        echo "<p>New record created successfully</p>";
    } else {
        echo "<p>Error: " . mysqli_stmt_error($stmt) . "</p>";
    }

    // Close statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($con);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
</head>
<body>
    <h2>Sign Up</h2>
    <form action="signUp.php" method="POST">
    <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>



        <button type="submit" name="submit">Sign Up</button>
    </form>
</body>
</html>