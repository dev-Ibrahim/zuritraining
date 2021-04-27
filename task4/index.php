<?php
$pdo = require 'Database.php';
session_start();
$message = '';
$userExists = null;
$ok = true;
if (isset($_POST['email']) && $_POST['password']) {
    $statement = $pdo->prepare("SELECT * FROM users WHERE email=:email");
    $statement->bindValue(':email', $_POST['email']);
    $statement->execute();
    $userExists = $statement->fetch(PDO::FETCH_ASSOC);

    if ($userExists != null) {
        $hash = $userExists['hashes'];
        if (password_verify($_POST['password'], $hash)) {
            $_SESSION['is_loggedin'] = 1;
            $_SESSION['name'] = $userExists['firstname'];
            $_SESSION['userID'] = $userExists['userID'];

            header('Location: welcome.php');
        } else {
            $message = 'login failed';
            $ok = false;
        }
    } else {
        $message = 'login failed';
        $ok = false;
    }
}

?>
<?php
include 'header.php';
?>

<div class="container">
<h2>Log in to view your courses</h2>
    <?php if (!$ok) : ?>
        <div class="alert alert-danger">
            <?php echo $message;?>
        </div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" type="email" name="email" placeholder="name@example.com" required>
        </div>
        <div class="mb3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" name="password">
        </div>

        <a href='reset.php' class="link-primary">Reset Password</a><br>
        <input type="submit" class="btn btn-primary" value="Login">
        <a href="register.php" class="link-primary">Create account</a>
    </form>
</div>