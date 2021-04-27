<?php
require 'auth.inc.php';
require 'Database.php';
$statement = $pdo->prepare("SELECT * FROM courses WHERE AddedBy = :user");
$statement->bindValue(':user', $_SESSION['userID']);
$statement->execute();
$courses  = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<style>
  table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }

  td,
  th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
  }
</style>
<h1>Welcome, <?php echo $_SESSION['name'] ?></h1>
<a href="Create.php">Add new course</a>
<form action="logout.php" method="post">
  <input type="submit" name="logout" value="Log out">
</form>
<table>
  <tr>
    <th scope="col">#</th>
    <th scope="col">Title</th>
    <th scope="col">Description</th>
    <th scope="col">Modules</th>
    <th scope="col">Action</th>

  </tr>


  <?php foreach ($courses as $i => $course) : ?>
    <tr>
      <th scope="row"><?php echo $i + 1 ?></th>
      <td><?php echo $course['Title'] ?></td>
      <td><?php echo $course['Description'] ?></td>
      <td><?php echo $course['Modules'] ?></td>
      <td>
        <a href="update.php?id=<?php echo $course['courseID'] ?>">Edit</a>
        <form action="delete.php" method="post" style="display: inline-block;">
          <input type="hidden" name="id" value="<?php echo $course['courseID'] ?>">
          <input type="submit" value="delete">
        </form>
      </td>
    </tr>
  <?php endforeach; ?>

</table>