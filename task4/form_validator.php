<?php

$title = $_POST['title'];
$description = $_POST['description'];
$modules = $_POST['modules'];

if(!$title){
    $errors[]='Title is required';
}

if(!$description){
    $errors[]='description is required';
}
