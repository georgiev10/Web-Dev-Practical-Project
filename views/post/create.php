<div class='col-md-8'>
    <div class="wrapper">
        <div class="title">
            <h4>Leave your post</h4>
        </div>
        <div class="formBox">
            <form method="post">
                <label for="title">Title</label>
                <br/>
                <input type="text" name="title" value="<?= isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '';?>" >
                <?php echo $this->getValidationError('title'); ?>
                <br/>
                <label for="content">Content</label>
                <br/>
                <textarea name="content" COLS=40 ROWS=6 ><?php
                    echo $var = isset($_POST['content']) ? htmlspecialchars($_POST['content']) : ''; ?></textarea>
                <br/>
                <label for="tags">Tags</label>
                <br/>
                <input type="text" name="tags" value="<?= isset($_POST['tags']) ? htmlspecialchars($_POST['tags']) : '';?>" >
                <br/>
                <input type="submit" value="Publish your post">
            </form>
        </div>
    </div>
</div>


