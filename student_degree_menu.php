<?php
session_start();

$servername = "localhost";
$servername = process.env.SERVERNAME;
$username = "root";
$password = "";
$dbname = "degree_audit_db";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

// NOTES - possible change this to where s (students) joins with t (transcripts) which joins with m (major)
$sql = "SELECT S.fname, S.lname, M.majorName, M.majorID
FROM Students S
JOIN Enrollments E ON S.studentID = E.studentID 
JOIN Programs P ON E.programID = P.programID
JOIN Majors M ON P.majorID = M.majorID
WHERE S.studentID = '$_SESSION[userID]';";
 
// ".$_GET["id"]." '";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows ($result) > 0) {

	// output data of each row
	while($row = mysqli_fetch_assoc($result)) {
		echo"
        <form action='index.php' method='post'>
		<div class='degree-box'>
		<button formaction='index.php?value=$row[majorID]' type='submit' id=$row[majorID]>". $row["majorName"] ."</button>
	  </div>
      </form>
		";

	}


} else {
	echo "0 results";
}


//mysqli_close($conn);
//?>
