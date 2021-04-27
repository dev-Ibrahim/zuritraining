<?php

$pdo = require 'Database.php';

if (isset($_POST['reset'])) {
    $statement = $pdo->prepare("SELECT * FROM users WHERE email=:email");
    $statement->bindValue(':email', $_POST['email']);
    $statement->execute();
    $userExists = $statement->fetch(PDO::FETCH_ASSOC);

    if ($userExists) {
        $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $statement = $pdo->prepare("UPDATE users SET hashes = :hashes WHERE email=:email");
        $statement->bindValue(':email', $_POST['email']);
        $statement->bindValue(':hashes', $hash);
        $statement->execute();
        echo 'Password Reset successfully, Login with new password';
    } else {
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