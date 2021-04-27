<?php
$title = '';
$description = '';
$modules = '';
$errors = [];


require "auth.inc.php";
require "Database.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'form_validator.php';
    if (empty($errors)) {
        $statement = $pdo->prepare("INSERT INTO courses (Title, Description, Modules, AddedBy)
                    VALUES (:Title, :Description, :Modules, :AddedBy)");
        $statement->bindValue(':Title', $title);
        $statement->bindValue(':Description', $description);
        $statement->bindValue(':Modules', $modules);
        $statement->bindValue(':AddedBy', $_SESSION['userID']);
        $statement->execute();
        header('location:welcome.php');
    }
}

?>

<h1>Add course</h1>

<?php require 'form.php' ?>

<a href="welcome.php">Back to courses</a>