<h3>Leave your post</h3>

<form method="post">
    Title
    <br/>
    <input type="text" name="title" value="<?=htmlspecialchars($this->getFieldValue("title"));?>" >
    <?php echo $this->getValidationError('title'); ?>
    <br/>
    Content
    <br/>
    <textarea name="content" COLS=40 ROWS=6 ><?php
        echo $var = isset($_POST['content']) ? htmlspecialchars($_POST['content']) : ''; ?></textarea>
    <br/>
    <input type="submit" value="Publish your post">
</form>


