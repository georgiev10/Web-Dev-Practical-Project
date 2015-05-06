<h1><?= htmlspecialchars($this->title) ?></h1>

<?php //var_dump($this->post)?>

<h3><?= htmlspecialchars($this->post[0][1]) ?></h3>

Posted by <?= htmlspecialchars($this->post[0][5]) ?> at <?= htmlspecialchars($this->post[0][3]) ?>

<p><?= htmlspecialchars($this->post[0][2]) ?></p>

visits: <?= htmlspecialchars($this->post[0][4]) ?>

<br/>
Tags:
<?php foreach($this->tags as $tag) :?>
   <a href=""><?=htmlspecialchars($tag[0]) ?></a>
<?php endforeach ?>
<br/>
<a href="/comments/create/<?=$this->post[0][0]?>"><button>Add comments</button></a>
<?php
if(isset($_SESSION['username'])){
    $loggedUsername = $_SESSION['username'];
}else{
    $loggedUsername='';
}
$postOwner = $this->post[0][5];
if($loggedUsername == $postOwner || $this->isAdmin) :?>
    <a href="/post/edit/<?=$this->post[0][0]?>/<?=$postOwner?>"><button>Edit</button></a>
<?php endif ?>

<?php
if($this->isAdmin) :?>
    <a href="/post/deleteConfirm"><button>Delete</button></a>
<?php endif ?>
<br/>
Comments:

<?php foreach($this->comments as $comment) :?>

    <?php var_dump($comment)?>

    <p><?= htmlspecialchars($comment[1]) ?></p>
    Comment by <?= htmlspecialchars($this->post[0][5]) ?> at <?= htmlspecialchars($this->post[0][3]) ?>

<?php endforeach ?>












