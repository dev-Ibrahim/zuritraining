<?php
require 'users.inc.php';
$exists = false;
$temp = [];
$reset_user = [];

if(isset($_POST['reset'])){
    foreach($users as $user){
        if($user['email']===$_POST['email']){
            $exists = true;
            $reset_user = $user;
            continue;
        }
        array_push($temp, $user);
    }
    if($exists){
        $reset_user['hash'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $current =serialize($reset_user) . PHP_EOL;
        file_put_contents($file, $current);
        foreach($temp as $user){
            $current = file_get_contents($file);
            $current .=serialize($reset_user) . PHP_EOL;
            file_put_contents($file, $current);
        }
        echo 'Password Reset successfully, Login with new password';
    }else{
        echo 'User does not exists';
    }
}

?>

<form action="" method="post">
<label for="email">Email:</label>
<input type="email" name="email">
<label for="new-password">new password</label>
<input type="password" name="password"><br>
<input type="submit" name="reset" value="Reset password"> <a href="index.php">Log in</a>
</form>