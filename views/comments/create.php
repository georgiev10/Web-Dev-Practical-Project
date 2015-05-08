<div class='col-md-8'>
    <div class="wrapper">
        <div class="title">
            <h4>Create New Comment</h4>
        </div>
        <div class="formBox">
            <form method="post">
                <label for="content">Leave your comment</label>
                <br/>
                <textarea name="content" COLS=40 ROWS=6 ><?php
                    echo $var = isset($_POST['content']) ? htmlspecialchars($_POST['content']) : ''; ?></textarea>
                <br/>
                <?php if(!$this->isLoggedIn) :?>
                    <label for=""visitor-name">Name</label>
                    <input type="text" name="visitor-name"
                                  value="<?=htmlspecialchars($this->getFieldValue("visitor-name"));?>">
                    <?php echo $this->getValidationError('visitor-name'); ?>
                    <br/>
                    <label for="visitor-email">Email</label>
                    <input type="text" name="visitor-email">
                    <br/>
                <?php endif ?>
                <input type="submit" value="Publish your comment">
                <a href="/post/index/<?=$this->post_id?>">Cancel</a>
            </form>
        </div>
    </div>
</div>


