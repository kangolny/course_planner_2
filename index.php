<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>NCAT Scheduling Homepage</title>
  <link rel="stylesheet" href="index.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
  <!-- <div class="user">
    <i class="fa fa-user-large fa-3x"></i>
  </div> -->
  <div class="container">
    <h1>Welcome to the NCAT Dashboard homepage</h1>
    <div class="row first_row">
      <div class="col">

    </div>
    <div class="row second_row">
      <div class="col">
        <span class="position-relative search"><i class="fas fa-search"></i></span>
        <input class="search-box form-control w-100" placeholder="Search..."></input>
      </div>
      <div class="col">
        <span class="btn btn-outline-warning"><b>Filters</b> <i class="fa fa-caret-down"></i></span>
      </div>
      <div class="col">
      </div>
      <div class="col">
        <button type="button" class="btn btn-outline-warning" id="download"><i class="fa fa-arrow-down"></i> <b><a style="text-decoration: none; color: #FDB927;" onMouseOver="this.style.color='#004684'" onMouseOut="this.style.color='#FDB927'" href="downloadpdf.php?file=audit_transcript">Download</a></b></button>
      </div>
    </div>
    <div class="row third_row">
      <div class="col"></div>
    </div>
    <div class="row fourth_row">
      <div class="col">
        <table class="table table-striped table-bordered">
          <thead>
            <tr class="heads">
              <!-- Had trouble trying to find the right tag to get to the th so I hard-coded the styles into each one -->
              <th scope="col" style="background-color: #004684; color: #FDB927;">Course</th>
              <th scope="col" style="background-color: #004684; color: #FDB927;">Description</th>
              <th scope="col" style="background-color: #004684; color: #FDB927;">Semester</th>
              <th scope="col" style="background-color: #004684; color: #FDB927;">Year</th>
              <th scope="col" style="background-color: #004684; color: #FDB927;">Grade</th>
              <th scope="col" style="background-color: #004684; color: #FDB927;">Credits</th>
              <th scope="col" style="background-color: #004684; color: #FDB927;">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            require('s_degree_audit.php');
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row fifth_row">
      <div class="col">
      </div>
      <div class="col">
  <div class="show-entries">
    <span>Rows per page</span>
    <select>
      <option value="5" selected>5</option>
      <option value="10">10</option>
      <option value="15">15</option>
      <option value="20">20</option>
    </select>
  </div>
</div>
      <!-- Pagination php file goes here (WARNING) Currently under construction -->
      <!--<?php require('pagination.php'); ?> -->

    </div>
    <div class="row sixth_row">
    </div>
  </div> <!-- End Container -->

  <script src="script.js"></script>
</body>

</html>
