<h3>Create New Comment</h3>

<form method="post">
    Leave your comment
    <br/>
    <textarea name="comment" COLS=40 ROWS=6 ><?php echo $var = isset($_POST['comment']) ? htmlspecialchars($_POST['comment']) : ''; ?></textarea>
    <br/>

    <?php if(!$this->isLoggedIn) :?>
        Name:  <input type="text" name="visitor-name"
                      value="<?=htmlspecialchars($this->getFieldValue("visitor-name"));?>">
        <?php echo $this->getValidationError('visitor-name'); ?>
        <br/>
        Email: <input type="text" name="visitor-email">
        <br/>
    <?php endif ?>

    <input type="submit" value="Publish your comment">
</form>


