<?php
session_start();

if(!isset($_SESSION['is_loggedin']) || $_SESSION['is_loggedin']!=1){
    header('Location: index.php');
}

?>