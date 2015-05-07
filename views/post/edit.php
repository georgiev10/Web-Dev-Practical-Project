<?php
$post_id = $_SESSION['post'][0][0];
$title = $_SESSION['post'][0][1];
$content = $_SESSION['post'][0][2];
?>

<h3>Edit post</h3>
<form method="post">
    Title
    <br/>
    <input type="text" name="title" value="<?= htmlspecialchars($title) ?>" >
    <?php echo $this->getValidationError('title'); ?>
    <br/>
    Content
    <br/>
    <textarea name="content" COLS=40 ROWS=6 ><?php
        echo htmlspecialchars($content) ?></textarea>
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
    <a href="/post/index/<?=$post_id?>">Cancel</a>
</form>
<a href="/post/index/<?=$post_id?>"><button>Cancel</button></a>






