<?php
require_once 'db_connect.php';

$username = $_POST["DB_USER"];
$password = $_POST["DB_PASSWORD"];

// No mysqli injection allowed
$username = stripcslashes($username);
$password = stripcslashes($password);
$username = mysqli_real_escape_string($con, $username);
$password = mysqli_real_escape_string($con, $password);



$sql = "SELECT
U.userID,
U.userRole,
U.userPass,
S.studentID,
S.email
FROM Users U
JOIN Students S ON U.userID = S.studentID
WHERE S.email = '$username' and U.userPass = '$password';";

$result = mysqli_query($con, $sql);
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