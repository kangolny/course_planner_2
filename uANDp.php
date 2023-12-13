<?php
session_start();
$err_message = "";

$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "degree_audit_db";


// Create connection
$conn = mysqli_connect($servername, $db_username, $db_password, $dbname);
// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$username = $_POST["username"];
$password = $_POST["password"];

// No mysqli injection allowed
$username = stripcslashes($username);
$password = stripcslashes($password);
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);



$sql = "SELECT
U.userID,
U.userRole,
U.userPass,
S.studentID,
S.email
FROM Users U
JOIN Students S ON U.userID = S.studentID
WHERE S.email = '$username' and U.userPass = '$password';";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$count = mysqli_num_rows($result);

if ($count == 1) {
	//session_register("username");
	$_SESSION['userID'] = $row["userID"];
	$_SESSION['fname'] = $row['fname'];
	$_SESSION['lname'] = $row['lname'];
	
	header("location: student_menu.php");

} else {
	$error = "Your username and/or password is invalid.";
	header("location: login.php?error=$error");
	exit($error);
}
?>