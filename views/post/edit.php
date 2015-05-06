<h3>Edit post</h3>

<form method="post">
    Title
    <br/>
    <input type="text" name="title" value="<?= htmlspecialchars($_SESSION['post'][0][1]) ?>" >
    <?php echo $this->getValidationError('title'); ?>
    <br/>
    Content
    <br/>
    <textarea name="content" COLS=40 ROWS=6 ><?php
        echo htmlspecialchars($_SESSION['post'][0][2]) ?></textarea>
    <br/>

<?php
$tags = '';
foreach($_SESSION['tags'] as $tag) {
    $tags = $tags . $tag[0] . ' ';
}
?>
    Tags
    <br/>
    <input type="tags" name="tags" value="<?= htmlspecialchars($tags);?>" >
    <br/>
    <input type="submit" value="Edit post">
</form>






