<?php
$firstname = '';
$lastname = '';
$email = '';
$pdo = require 'Database.php';
if (isset($_POST['submit'])) {
  $ok = true;

  if (!isset($_POST['firstname']) || $_POST['firstname'] === '') {
    $ok = false;
  } else {
    $firstname = $_POST['firstname'];
  };
  if (!isset($_POST['lastname']) || $_POST['lastname'] === '') {
    $ok = false;
  } else {
    $lastname = $_POST['lastname'];
  };
  if (!isset($_POST['email']) || $_POST['email'] === '') {
    $ok = false;
  } else {
    $email = $_POST['email'];
  };
  if ($ok) {
    $error = false;
    $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $statement = $pdo->prepare("SELECT userID FROM users WHERE email=:email");
    $statement->bindValue(':email', $email);
    $statement->execute();
    $userExists = $statement->fetch(PDO::FETCH_ASSOC);

    if ($userExists) {
      echo 'user already exists';
    } else {
      $statement = $pdo->prepare("INSERT INTO users (firstname, lastname,email, hashes)
          VALUES (:firstname,:lastname,:email, :hashes)");
      $statement->bindValue(':email', $email);
      $statement->bindValue(':firstname', $firstname);
      $statement->bindValue(':lastname', $lastname);
      $statement->bindValue(':hashes', $hash);
      $statement->execute();
      echo 'User added, you can login';
    }
  } else {
    echo 'Something is wrong in your form';
  }
}



?>

<form method="post">
  <label for="firstname" required>Firstname</label>
  <input type="text" name="firstname" value="<?php echo $firstname; ?>"><br>
  <label for="lastname">Lastname</label>
  <input type="text" name="lastname" value="<?php echo $lastname; ?>"><br>
  <label for="Email">Email:</label>
  <input type="email" name="email" value="<?php echo $email; ?>"><br>
  <label for="password">Password:</label>
  <input type="password" name="password"><br>
  <input type="submit" name='submit' value="Register">
  <a href="index.php">Login</a>
</form>