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

$rows_per_page = 5;
$page = "";

if (isset($_GET["page"])) {
  $page = $_GET["page"];

} else {
  $page = 1;
}

echo "The page number is".$page.".";

$start_from = ($page -1) * $rows_per_page;


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
WHERE T.studentID = '$_SESSION[userID]' and T.majorID = $major
LIMIT $start_from, $rows_per_page;";

 
$result = mysqli_query($conn, $sql);
$total_records = mysqli_num_rows($result);
$total_pages = ceil($total_records / $rows_per_page);
$start_loop = $page;
$difference = $total_pages - $page;

if($difference <= $rows_per_page) {
  $start_loop = $total_pages - $rows_per_page;

}

$end_loop = $start_loop + $rows_per_page - 1;

if($page >= 1) {
  echo"
<div class='col'>
  <div class='hint-text'>".$start_loop."-".$end_loop." of ".$total_records."</div>
</div>
<div class='col'>
  <nav aria-label='Page navigation'>
    <ul class='pagination'>
      <li class='page-item'>
        <a class='page-link' href='pagination.php?value=".$major."&page=1' aria-label='First'>
          <span aria-hidden='true'><b>l</b><i class='fa fa-chevron-left'></i></span>
          <span class='sr-only'>First</span>
        </a>
      </li>
      <li class='page-item'>
        <a class='page-link' href='pagination.php?page=".($page-1)."' arial-label='Previous'>
        <span aria-hidden='true'><i class='fa fa-chevron-left'></i></span>
        <span class='sr-only'>Previous</span>
        </a>
        </li>";
 

}

for ($i = $start_loop; $i <= $end_loop; $i++) {
  echo "<li class='page-item'>
    <a class='page-link' href='pagination.php?page=".$i."'>".$i."</a>
    </li>
  ";
}

  if ($page <= $end_loop)
  {
    echo"
    <li class='page-item'>
      <a class='page-link' href='pagination.php?page=".($page + 1)."' aria-label='Next'>
        <span aria-hidden='true'><i class='fa fa-chevron-right'></i></span>
        <span class='sr-only'>Next</span>
      </a>
    </li>
    <li class='page-item'>
      <a class='page-link' href='pagination.php?page=".$total_pages."' aria-label='Last'>
        <span aria-hidden='true'><i class='fa fa-chevron-right'></i><b>l</b></span>
        <span class='sr-only'>Last</span>
      </a>
    </li>
  </ul>
</nav>
</div>";
  }



//mysqli_close($conn);
//?>