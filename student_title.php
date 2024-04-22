<?php session_start(); ?>
<?php

// Include the database connection file
require_once 'db_connect.php';


if (isset($_GET['value'])) {
    $major = $_GET['value'];
} else {
    $errorMsg = "No user data provided in the URL.\n"; // Error message with a newline for readability in the log file
    file_put_contents('error_log.txt', $errorMsg, FILE_APPEND); // Append the error message to 'error_log.txt'
    exit; // Stop further execution if the required parameter is not found
}

// Check if 'userID' is set in the session
if (isset($_SESSION['userID'])) {
    $userId = $_SESSION['userID'];
} else {
    echo "User is not logged in.";
    exit; // Stop further execution if the user is not logged in
}

// Prepare SQL query to fetch student details
$sql = "SELECT S.fname, S.lname, P.degreeLevel, P.degreeType, M.majorName, 
               SUM(CASE WHEN T.currStatus = 'Done' THEN 1 ELSE 0 END) AS done
        FROM Students S
        JOIN Enrollments E ON S.studentID = E.studentID
        JOIN Programs P ON E.programID = P.programID
        JOIN Majors M ON P.majorID = M.majorID
        JOIN Transcripts T ON M.majorID = T.majorID
        WHERE S.studentID = ? AND M.majorID = ?;";

// Prepare and execute the SQL statement
$stmt = mysqli_prepare($con, $sql);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ii", $userId, $major);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if there are results
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $done = $row["done"];
            $num_of_rows = mysqli_num_rows($result); // Assuming you want to count rows here
            $percent_complete = round($done / $num_of_rows * 100);

            echo "<h2>" . htmlspecialchars($row["fname"]) . " " . htmlspecialchars($row["lname"]) . "</h2>";
            echo "<div class='progress'>";
            echo "<div class='progress-bar bg-warning' role='progressbar' style='width: " . $percent_complete . "%' aria-valuenow='" . $percent_complete . "' aria-valuemin='0' aria-valuemax='100'></div>";
            echo "</div>";
            echo "<div class='percent'>" . $percent_complete . "% complete</div>";
            echo "<div class='degree-title'>" . htmlspecialchars($row["degreeLevel"]) . " of " . htmlspecialchars($row["degreeType"]) . " - " . htmlspecialchars($row["majorName"]) . "</div>";
        }
    } else {
        echo "0 results";
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Failed to prepare the query.";
}

// Close the database connection
mysqli_close($con);