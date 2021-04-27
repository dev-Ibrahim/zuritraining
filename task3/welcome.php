<?php
require 'auth.inc.php';
?>
<h1>Welcome, <?php echo $_SESSION['name']?></h1>

<form action="logout.php" method="post">
<input type="submit" name="logout" value="Log out">
</form>