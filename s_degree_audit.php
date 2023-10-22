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

$sql = "SELECT
C.courseSubject,
C.courseNum,
C.title,
C.semesterAvail,
# year
T.grade,
T.creditsEarned
FROM Transcripts T
JOIN Courses C ON T.courseID = C.courseID
WHERE T.studentID = 1002;"; //hard-coded iD for test purposes. will replace after login authentication is made.
 
// ".$_GET["id"]." '";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows ($result) > 0) {
	// output data of each row
	while($row = mysqli_fetch_assoc($result)) {
		echo "" . $row["courseSubject"]. "\t" . $row["courseNum"]."\t".$row["title"]. "\t" . $row["semesterAvail"]. "\t" . $row["grade"]. "\t" . $row["creditsEarned"]."<br>";
	}
} else {
	echo "0 results";
}


//mysqli_close($conn);
//?>