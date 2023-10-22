<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "degree_audit_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
if (isset($_GET["transcriptID"]))
{
$sql = "INSERT INTO Transcripts(transcriptID, studentID, courseID, grade, creditsEarned)
VALUES ('".$_GET["transcriptID"]."', '".$_GET["studentID"]."', '".$_GET["courseID"]."','".$_GET["grade"]."', '".$_GET["creditsEarned"]."');";

if (mysqli_query($conn, $sql)) {
	echo "New student record created successfully";
}
}
mysqli_close($conn);
?>