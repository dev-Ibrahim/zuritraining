<?php

$title = $_POST['title'];
$description = $_POST['description'];

if(!$title){
    $errors[]='Title is required';
}

if(!$description){
    $errors[]='description is required';
}

?>