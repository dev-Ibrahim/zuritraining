<?php
$firstname ='';
$lastname ='';
$email = '';
require 'users.inc.php';


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
    if($ok){
        $error =false;
        $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $new_user = array('firstname'=> $firstname, 'lastname'=> $lastname, 'email'=>$email, 'hash'=>$hash);

        if(count($users)>0){
          foreach($users as $user){
              if($user['email']===$new_user['email']){
                  $error = true;
                  echo 'User already exists';
                  break;
              }
            }
        }
        if(!$error){
            $file = 'db.txt'; 
            $current = file_get_contents($file);
            $current .=serialize($new_user) . PHP_EOL;
            file_put_contents($file, $current);
            echo 'User added';
        }
           
    }else{
        echo 'Something is wrong in your form';
    }
}



?>

<form method="post">
<label for="firstname" required>Firstname</label>
<input type="text" name="firstname"><br>
<label for="lastname">Lastname</label>
<input type="text" name="lastname"><br>
<label for="Email">Email:</label>
<input type="email" name="email"><br>
<label for="password">Password:</label>
<input type="password" name="password"><br>
<input type="submit" name='submit' value="Register">
<a href="index.php">Login</a>
</form>