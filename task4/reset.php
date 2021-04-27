<?php

$pdo = require 'Database.php';
$message='';
$ok=true;

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
        $message =  'Password Reset successfully, Login with new password';
    } else {
        $message = 'User does not exists';
        $ok=false;
    }
}

?>
<?php
include 'header.php';
?>



<div class="container">
<h1>Reset Password</h1>
<?php if ($message!='') : ?>
  <?php if (!$ok) : ?>
    <div class="alert alert-danger">
      <?php echo $message; ?>
    </div>
  <?php else:?>
    <div class="alert alert-success">
      <?php echo $message; ?>
    </div>
  <?php endif; ?>
  <?php endif; ?>
<form method="post" class="row g-3">
    <div class="col-auto">
        <label for="email" class='visually-hidden'>Email:</label>
        <input class="form-control" type="email" name="email" placeholder="Email">
    </div>
    <div class="col-auto">
    <label for="new-password" class="visually-hidden">new password</label>
    <input class="form-control" type="password" name="password" placeholder="Password">
    </div>
    <div class="col-auto">
    
    <input type="submit" name="reset" value="Reset password" class="btn btn-primary mb-3"> <a href="index.php" class="link-primary">Log in</a>
    </div>
</form>
</div>