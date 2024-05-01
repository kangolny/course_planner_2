<?php
session_start();  // Start the session
require_once 'db_connect.php';
if (!isset($_SESSION['userRole']) || $_SESSION['userRole'] !== 'admin') {
    // Redirect non-admin users to a different page or show an error
    header('Location: login.php'); // Redirect to login page
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $userRole = $_POST['userRole'];
    $password = $_POST['password']; // Assuming password is also sent via POST
        // Hash the password before storing it in the database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    if ($userRole == 'student') {
        // Prepare SQL for students table
        $sql = "INSERT INTO students (fname, lname, email, telephone, studentType, password) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $sql);
        $studentType = $_POST['studentType']; // Assuming studentType is also sent via POST
        mysqli_stmt_bind_param($stmt, "ssssss", $firstName, $lastName, $email, $mobile, $studentType, $hashedPassword);
    } else if ($userRole == 'admin') {
        // Prepare SQL for users table
        $sql = "INSERT INTO users (userRole, userPass, email) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $userRole, $hashedPassword, $email);
    }

    if ($stmt) {
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        echo "User added successfully.";
    } else {
        echo "Error: " . mysqli_error($con);
    }


    mysqli_close($con);
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
    <?php include 'logout.php'; ?>
    <div class="form-container">
        <h1>New User</h1>
        <form action="admin.php" method="POST">
            <div class="input-group">
                <label for="firstName">First name:</label>
                <input type="text" id="firstName" name="firstName" required>
            </div>
            <div class="input-group">
                <label for="lastName">Last name:</label>
                <input type="text" id="lastName" name="lastName" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
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
                    <p><input type="radio" id="student" name="userRole" value="student" required
                            onchange="toggleStudentType()">
                        <label for="student">Student</label>
                    </p>

                    <p><input type="radio" id="faculty" name="userRole" value="faculty" required
                            onchange="toggleStudentType()">
                        <label for="faculty">Faculty</label>
                    </p>
                    <p><input type="radio" id="admin" name="userRole" value="admin" required
                            onchange="toggleStudentType()">
                        <label for="admin">System Administrator</label>
                    </p>
                </div>
            </div>
            <div class="input-group" id="studentTypeGroup" style="display: none;">
                <label for="studentType">Student Type:</label>
                <input type="text" id="studentType" name="studentType">
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
    <script>
        function toggleStudentType() {
            var studentRadio = document.getElementById('student');
            var studentTypeGroup = document.getElementById('studentTypeGroup');
            studentTypeGroup.style.display = studentRadio.checked ? 'block' : 'none';
        }
    </script>
</body>

</html>