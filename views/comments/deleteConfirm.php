<?php
foreach($_SESSION['comments'] as $comment) {
    if ($comment[0] == $this->comment_id) {
        $comment_id = $comment[0];
        $content = $comment[1];
        $commentPublishDate = date_create($comment[2]);
        $commentQwnerRegisteredUser = $comment[5];
        $commentQwnerVisitorName = $comment[3];
        $commentQwnerVisitorEmail = $comment[4];
    }
}
if($commentQwnerRegisteredUser){
    $commentQwner = $commentQwnerRegisteredUser;
}else{
    if($commentQwnerVisitorEmail){
        $commentQwner = $commentQwnerVisitorName . ' ' . $commentQwnerVisitorEmail;
    }else{
        $commentQwner = $commentQwnerVisitorName;
    }
}
?>

<div class='col-md-8'>
    <div class="wrapper">
        <div class="title">
            <h4>Delete Comment</h4>
        </div>
        <div class="boxPost">
            <p><?= htmlspecialchars($content) ?></p>
            <div class="small-text">
                <span>Comment by <?= htmlspecialchars($commentQwner) ?> at
                    <?php echo date_format($commentPublishDate, 'g:ia \o\n l jS F Y')?>
                </span>
            </div>
            <div class="right">
                <?php
                if($this->isAdmin) :?>
                    <a href="/comments/delete/<?=$this->post_id?>/<?=$comment_id?>"><button>Delete</button></a>
                <?php endif ?>
                <a href="/post/index/<?=$this->post_id?>"><button>Cancel</button></a>
            </div>
            <br/>
        </div>
    </div>
</div>