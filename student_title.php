<?php
session_start();

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "degree_audit_db";
$servername = getenv("DB_SERVERNAME");
$username = getenv("DB_USERNAME");
$password = getenv("DB_PASSWORD");
$dbname = getenv("DB_NAME");

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$major = $_GET['value'];

$sql = "SELECT S.fname, S.lname, P.degreeLevel, P.degreeType, M.majorName, sum(case when T.currStatus = 'Done' then 1  else 0 end) as done
FROM Students S
JOIN Enrollments E ON S.studentID = E.studentID
JOIN Programs P ON E.programID = P.programID
JOIN Majors M on P.majorID = M.majorID
JOIN Transcripts T on M.majorID = T.majorID
WHERE S.studentID = '$_SESSION[userID]' AND M.majorID = $major;";

$row_query = "SELECT *
FROM Transcripts T
JOIN Courses C ON T.courseID = C.courseID
WHERE T.studentID = '$_SESSION[userID]' and T.majorID = $major;";
 
// ".$_GET["id"]." '";
$result = mysqli_query($conn, $sql);
$row_result = mysqli_query($conn, $row_query);

$num_of_rows = mysqli_num_rows($row_result);

if (mysqli_num_rows ($result) > 0) {
	// output data of each row
	while($row = mysqli_fetch_assoc($result)) {

$done = $row["done"];
$percent_complete = round($done / $num_of_rows * 100);

        echo "
        <h2>" . $row["fname"] . " " . $row["lname"] . "</h2>

        </div>
        <div class='col'>
          <div class='progress'>
          <div class='progress-bar bg-warning' role='progressbar' style='width: ".$percent_complete."%' aria-valuenow='".$percent_complete."' aria-valuemin='0' aria-valuemax='100'></div>
          </div>
          <div class='percent'>".$percent_complete."%</div>  
          </div>
      </div>
      <div class='row'>
        <div class='col-8'>
          <div class='degree-title'>" . $row["degreeLevel"] . " of " . $row["degreeType"] . " - " . $row["majorName"] . "</div>
        </div>
        <div class='col-4'></div>
        ";
	}
} else {
	echo "0 results";
}


//mysqli_close($conn);
//?>