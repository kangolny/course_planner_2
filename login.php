<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    
  </head>
  <body>

    <div class="container">
      <div class="login-box">
        <img class="guidelines-logo14-1" src="https://relations.ncat.edu/branding/images/guidelines-logo14.png" alt="NCAT Bulldog">
        <form action="uANDp.php" method="post">
          <i class="fas fa-user"></i>
          <div class="user-box">
            <input type="email" name="username" id="username" required="" />
           <label>Username</label>
          </div>
          
         
          <div class="user-box">
             <i class="fas fa-lock"></i>
            <input type="password" name="password" id="password" required="" />
            <label>Password</label>
            <span class="password-toggle-icon"><i class="fas fa-eye"></i></span>
          </div>
          <div align="center"><span class"user-box"><a href="#">Forgotten Your Password?</a></span></div>
          <div align="center"><input type="submit" class="btnLogin" value="Login"></div>
          <!-- Trying to get error to show up on unsuccessful login -->
          <?php if(isset($_GET['error'])) {?>
          <p style="
          background-color: pink; 
          color: red; 
          text-align: center; 
          padding: 10px;
          width: 95%;
          border-radius: 5px;
          margin: 20px auto;">
        <?php echo $_GET['error']; ?></p>
        <?php } ?>
        
          <div align="center"><span><a href="signUp.php">New User?</a></span></div>
        </form>
      </div>
    </div>
    <script>
      const passwordField = document.getElementById("password");
const togglePassword = document.querySelector(".password-toggle-icon i");

togglePassword.addEventListener("click", function () {
  if (passwordField.type === "password") {
    passwordField.type = "text";
    togglePassword.classList.remove("fa-eye");
    togglePassword.classList.add("fa-eye-slash");
  } else {
    passwordField.type = "password";
    togglePassword.classList.remove("fa-eye-slash");
    togglePassword.classList.add("fa-eye");
  }
});
    </script>
  </body>
</html>