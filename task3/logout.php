<?php
session_start();
if(isset($_POST['logout'])){
    if(isset($_SESSION['name'])){
        unset($_SESSION['name']);
    }
    if(isset($_SESSION['is_loggedin'])){
        unset($_SESSION['is_loggedin']);
    }  
}
print nl2br("User logged out\n");
?>
You can login again: <a href="index.php">Log in</a>
