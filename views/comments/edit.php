<h1>Edit Comment</h1>

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

<form method="post">
    Content
    <br/>
    <textarea name="content" COLS=40 ROWS=6 ><?php
        echo htmlspecialchars($content)?></textarea>
    <br/>
    Comment by <?= htmlspecialchars($commentQwner) ?> at <?= htmlspecialchars($commentPublishDate) ?>
    <br/>
    <input type="submit" value="Edit comment">
    <a href="/post/index/<?=$this->post_id?>">Cancel</a>
</form>

<a href="/post/index/<?=$this->post_id?>"><button>Cancel</button></a>







