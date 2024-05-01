<?php

if (isset($_POST['logout'])) {
    // Clear all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to the login page
    header("Location: login.php");
    exit;
}
?>

<style>
    .header {
        position: fixed;
        top: 0;
        width: 100%;
        background: white; /* Dark background for visibility */
        color: white;
        text-align: right;
        padding: 10px 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.5);
        z-index: 1000;
    }
    .header form {
        margin: 0; /* Remove default form margin */
    }
    .header button {
        background: #f44;
        color: white;
        border: none;
        padding: 8px 16px;
        cursor: pointer;
        border-radius: 4px;
    }
    .header button:hover {
        background: #c33;
    }
    body {
        padding-top: 50px; /* Add padding to ensure body content does not hide behind the fixed header */
    }
    .guidelines-logo14-1 {
        float: left;
    }
</style>

<div class="header">
<img class="guidelines-logo14-1" src="./images/logout_image.jpg" alt="NCAT Bulldog" height="50">
    <!-- Logout Button -->
    <form method="POST" action="logout.php">
        <button type="submit" name="logout">Logout</button>
    </form>
</div>