<?php
$firstname = '';
$lastname = '';
$email = '';
$message = '';
$ok = true;
$pdo = require 'Database.php';
if (isset($_POST['submit'])) {
  

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
    $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $statement = $pdo->prepare("SELECT userID FROM users WHERE email=:email");
    $statement->bindValue(':email', $email);
    $statement->execute();
    $userExists = $statement->fetch(PDO::FETCH_ASSOC);

    if ($userExists) {
      $message = 'user already exists';
      $ok=false;
    } else {
      $statement = $pdo->prepare("INSERT INTO users (firstname, lastname,email, hashes)
          VALUES (:firstname,:lastname,:email, :hashes)");
      $statement->bindValue(':email', $email);
      $statement->bindValue(':firstname', $firstname);
      $statement->bindValue(':lastname', $lastname);
      $statement->bindValue(':hashes', $hash);
      $statement->execute();
      $message =  'User added, you can login';
    }
  } else {
    $message = 'Something is wrong in your form';
  }
}



?>
<?php
include 'header.php';
?>
<div class="container form-card">
<h1>Register new account</h1>

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
  <form method="post">
    <div class="mb-3">
      <label class="form-label" for="firstname" required>Firstname</label>
      <input class="form-control" type="text" name="firstname" value="<?php echo $firstname; ?>">
    </div>
    <div class="mb3">
      <label class="form-label" for="lastname">Lastname</label>
      <input class="form-control" type="text" name="lastname" value="<?php echo $lastname; ?>">
    </div>
    <div class="mb-3">
      <label class="form-label" for="Email">Email:</label>
      <input class="form-control" type="email" name="email" value="<?php echo $email; ?>">
    </div>
    <div class="mb-3">
      <label class="form-label" for="password">Password:</label>
      <input class="form-control" type="password" name="password">
    </div>
    <input class="btn btn-primary mb-3" type="submit" name='submit' value="Register">
    <a href="index.php">Login</a>

</div>



</form>