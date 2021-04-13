<?php
require 'users.inc.php';
session_start();
$message = '';
$exist_user  = null;
if(isset($_POST['email']) && $_POST['password']){
    if(count($users)>0){
        foreach($users as $user){
            if($user['email']===$_POST['email']){
                $exist_user = $user;
                break;
            }
        }
    }
if($exist_user!=null){
    $hash = $exist_user['hash'];
    if(password_verify($_POST['password'], $hash)){
        $_SESSION['is_loggedin'] =1; 
        $_SESSION['name'] = $exist_user['firstname'];
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
<a href="create.php">Create account</a>
</form>