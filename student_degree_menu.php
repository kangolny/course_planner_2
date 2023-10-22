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

$sql = "SELECT S.fname, S.lname, M.majorName
FROM Students S
JOIN Enrollments E ON S.studentID = E.studentID
JOIN Programs P ON E.programID = P.programID
JOIN Majors M ON P.majorID = M.majorID
WHERE S.studentID = 1002;"; //hard-coded iD for test purposes. will replace after login authentication is made.
 
// ".$_GET["id"]." '";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows ($result) > 0) {
	// output data of each row
	while($row = mysqli_fetch_assoc($result)) {
		echo "" . $row["fname"]. "\t" . $row["lname"]."\t".$row["majorName"]."<br>";
	}
} else {
	echo "0 results";
}


//mysqli_close($conn);
//?>