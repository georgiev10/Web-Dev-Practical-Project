<?php
$post_id = $_SESSION['post'][0][0];
$title = $_SESSION['post'][0][1];
$content = $_SESSION['post'][0][2];
?>
<div class='col-md-8'>
    <div class="wrapper">
        <div class="title">
        <h4>Edit post</h4>
        </div>
        <div class="formBox">
            <form method="post">
                <label for="title">Title</label>
                <br/>
                <input type="text" name="title" value="<?= htmlspecialchars($title) ?>" >
                <?php echo $this->getValidationError('title'); ?>
                <br/>
                <label for="content">Content</label>
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
                <label for="tags">Tags</label>
                <br/>
                <input type="text" name="tags" value="<?= htmlspecialchars($tags);?>" >
                <br/>
                <input type="submit" value="Edit post">
                <a href="/post/index/<?=$post_id?>">Cancel</a>
            </form>
        </div>
    </div>
</div>






