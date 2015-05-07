<?php
$post_id = $this->post[0][0];
$title = $this->post[0][1];
$content = $this->post[0][2];
$postOwner = $this->post[0][5];
$date = $this->post[0][3];
$visits = $this->post[0][4];
?>

<h1><?= htmlspecialchars($this->title) ?></h1>

<h3><?= htmlspecialchars($title) ?></h3>
Posted by <?= htmlspecialchars($postOwner) ?> at <?= htmlspecialchars($date) ?>
<p><?= htmlspecialchars($content) ?></p>
visits: <?= htmlspecialchars($visits) ?>
<br/>
Tags:
<?php foreach($this->tags as $tag) :?>
   <a href=""><?=htmlspecialchars($tag[0]) ?></a>
<?php endforeach ?>
<br/>
<a href="/comments/create/<?=$post_id?>"><button>Add comments</button></a>
<?php
if(isset($_SESSION['username'])){
    $loggedUsername = $_SESSION['username'];
}else{
    $loggedUsername='';
}
if($loggedUsername == $postOwner || $this->isAdmin) :?>
    <a href="/post/edit/<?=$post_id?>/<?=$postOwner?>"><button>Edit</button></a>
<?php endif ?>

<?php
if($this->isAdmin) :?>
    <a href="/post/deleteConfirm"><button>Delete</button></a>
<?php endif ?>
<br/>

Comments:
<?php foreach($this->comments as $comment) :?>
    <?php
        $comment_id = $comment[0];
        $content = $comment[1];
        $commentPublishDate = $comment[2];
        $commentQwnerRegisteredUser = $comment[5];
        $commentQwnerVisitorName = $comment[3];
        $commentQwnerVisitorEmail = $comment[4];
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
    <br/>
    <?php
    $isOwner = false;
    if(isset($_SESSION['username'])&& $commentQwnerRegisteredUser == $_SESSION['username'] ){
        $isOwner = true;
    }
    if($isOwner || $this->isAdmin) :?>
    <a href="/comments/edit/<?=$post_id?>/<?=$comment_id?>/<?=$commentQwnerRegisteredUser?>"><button>Edit</button></a>
    <?php endif ?>
    <?php
    if($this->isAdmin) :?>
        <a href="/comments/deleteConfirm/<?=$post_id?>/<?=$comment_id?>"><button>Delete</button></a>
    <?php endif ?>
    </div>
<?php endforeach ?>












