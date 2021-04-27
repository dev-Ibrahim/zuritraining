<?php
require 'Database.php';
require 'auth.inc.php';

$id = $_POST['id'] ?? null;
if(!$id){
    header('location:welcome.php');
}
$statement = $pdo->prepare('DELETE FROM courses WHERE courseID=:id AND AddedBy =:userID');
$statement->bindValue(':id', $id);
$statement->bindValue(':userID', $_SESSION['userID']);
$statement->execute();
header('location:welcome.php');
 
?>