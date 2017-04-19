<?php
//path is applications/views/news/create.php
?>

<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); //if there are anomolies, CI will handle them. A sort of form validation. ?>

<?php echo form_open('news/create'); ?>

    <label for="title">Title</label>
    <input type="input" name="title" /><br />

    <label for="text">Text</label>
    <textarea name="text"></textarea><br />

    <input type="submit" name="submit" value="Create news item" />

</form>