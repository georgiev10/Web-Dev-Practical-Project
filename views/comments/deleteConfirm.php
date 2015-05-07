<h1>Delete Comment</h1>

<?php
foreach($_SESSION['comments'] as $comment) {
    if ($comment[0] == $this->comment_id) {
        $comment_id = $comment[0];
        $content = $comment[1];
        $commentPublishDate = $comment[2];
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

<p><?= htmlspecialchars($content) ?></p>

Comment by <?= htmlspecialchars($commentQwner) ?> at <?= htmlspecialchars($commentPublishDate) ?>


<?php
if($this->isAdmin) :?>
    <a href="/comments/delete/<?=$this->post_id?>/<?=$comment_id?>"><button>Delete</button></a>
<?php endif ?>

<a href="/post/index/<?=$this->post_id?>"><button>Cancel</button></a>