<div class="container">

    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error) {
                echo "$error<br>";
            } ?>
        </div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label class="form-label" for="title">Title</label>
            <input class="form-control" type="text" name="title" value="<?php echo $title ?>">
        </div>
        <div class="mb-3">
            <label class="form-label" for="description">Description</label><br>
            <textarea class="form-control" name="description" cols="20" rows="6"><?php echo $description ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label" for="modules">Number of modules</label>
            <input class="form-control" style="width:20%;" type="number" name="modules" value="<?php echo $modules ?>">
        </div>

        <button class="btn btn-primary" type="submit">submit</button>
    </form>
    <a href="welcome.php" class="btn btn-secondary">Back to courses</a>
</div>