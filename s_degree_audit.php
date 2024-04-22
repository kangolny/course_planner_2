<?php
require_once 'db_connect.php';
$major = $_GET['value'];

$sql = "SELECT
C.courseSubject,
C.courseNum,
C.title,
C.semesterAvail,
T.yearTaken,
T.grade,
T.creditsEarned,
T.currStatus
FROM Transcripts T
JOIN Courses C ON T.courseID = C.courseID
WHERE T.studentID = '$_SESSION[userID]' and T.majorID = $major;";

 
// ".$_GET["id"]." '";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows ($result) > 0) {
	// output data of each row
	while($row = mysqli_fetch_assoc($result)) {
    $currStatus = $row["currStatus"];

    switch ($currStatus) {
      case "Done":
        $style = "btn btn-success";
        break;
      case "WIP":
        $style = "btn btn-warning";
        break;
      case "Review":
          $style = "btn btn-dark";
          break;
      case "Withdrawn":
        $style = "btn btn-danger";
        break;
      default;
        break;

      }

        echo "<tr  class='text-center align-middle'>
        <td><u>". $row["courseSubject"] . '-' .$row["courseNum"]."</u></td>
        <td>". $row["title"] ."</td>
        <td>". $row["semesterAvail"] ."</td>
        <td>". $row["yearTaken"] ."</td>
        <td>". $row["grade"] ."</td>
        <td>". $row["creditsEarned"] ."</td>
        <td><button type='button' class='$style'>". $currStatus ."</button></td>
      </tr>";
    }
} else {
	echo "0 results";
}
