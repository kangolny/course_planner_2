<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Student Menu Page</title>
    <link rel="stylesheet" href="student_menu.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  </head>
  
  <body>
    <div class="container">
      <h2 style="font-family: 'Times New Roman';">Student Degree</h2>
      <div class="menu-box">
        <img class="guidelines-logo14-1" src="https://relations.ncat.edu/branding/images/guidelines-logo14.png" alt="NCAT Bulldog">
        <div>
          <?php
          require("student_degree_menu.php");
          ?>

          <div class="add">
            <button type="submit"><span class="fas fa-plus"></span>    Add</button>
</div>
        </div>
      </div>
    </div>
    <script src="script.js"></script>
  </body>
</html>