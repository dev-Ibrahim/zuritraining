<?php
$pdo = require 'Database.php';
session_start();
$message = '';
$userExists = null;
if(isset($_POST['email']) && $_POST['password']){
    $statement = $pdo->prepare("SELECT * FROM users WHERE email=:email");
    $statement->bindValue(':email',$_POST['email']);
    $statement->execute();
    $userExists = $statement->fetch(PDO::FETCH_ASSOC);

    if($userExists!=null){
        $hash = $userExists['hashes'];
        if(password_verify($_POST['password'], $hash)){
            $_SESSION['is_loggedin'] =1; 
            $_SESSION['name'] = $userExists['firstname'];
            $_SESSION['userID'] = $userExists['userID'];

            header('Location: welcome.php');
        }else{
            $message = 'login failed';
        }
    }else{
        $message = 'login failed';
    }
echo $message;
}

?>

<form method="post">
<label for="Email">Email:</label>
<input type="email" name="email" required><br>
<label for="password">Password:</label>
<input type="password" name="password"><br>
<a href='reset.php'>Reset Password</a><br>
<input type="submit" value="Login">
<a href="register.php">Create account</a>
</form>