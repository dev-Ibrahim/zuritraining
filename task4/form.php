<?php if (!empty($errors)) : ?>
    <div style="background-color: #ffcccc;">
        <?php foreach ($errors as $error) {
            echo "$error<br>";
        } ?>
    </div>
<?php endif; ?>

<form method="post">
    <label for="title">Title</label>
    <input type="text" name="title" value="<?php echo $title ?>"><br>
    <label for="description">Description</label><br>
    <textarea name="description" cols="30" rows="10"><?php echo $description ?></textarea><br>
    <label for="modules">Number of modules</label>
    <input type="number" name="modules" value="<?php echo $modules ?>"><br>
    <button type="submit">submit</button>
</form>