<?php
require 'auth.inc.php';
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
}
require 'header.php';
?>
<div class="container">
<p class="lead">
    User logged out
</p>
You can login again: <a class="btn btn-primary"href="index.php">Log in</a>
</div>