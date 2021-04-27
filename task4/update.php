<?php
require 'auth.inc.php';
require 'Database.php';
$id = $_GET['id'] ?? null;
if(!$id){
    header('location:welcome.php');
}
$statement = $pdo->prepare("SELECT * FROM courses WHERE courseID = :id");
$statement->bindValue(':id', $id);
$statement->execute();
$course = $statement->fetch(PDO::FETCH_ASSOC);

if($_SESSION['userID']!=$course['AddedBy']){
    header('location:welcome.php');
}

$title = $course['Title'];
$description=$course['Description'];
$modules=$course['Modules'];
$errors=[];
if($_SERVER["REQUEST_METHOD"]==='POST'){
    require 'form_validator.php';
    if(empty($errors)){
        $statement=$pdo->prepare("UPDATE courses SET Title = :title, Description = :description, Modules= :modules WHERE courseID = :id");
        $statement->bindValue(':title', $title);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':modules', $modules);
        $statement->execute();
        header('location:welcome.php');
    }
}


?>
<h1>Update Course: <?php echo $title?></h1>

<?php 
require 'form.php';
?>
<a href="welcome.php">Back to courses</a>
