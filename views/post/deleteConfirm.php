<h1>Delete</h1>

<?php //var_dump($this->post)?>

<h3><?= htmlspecialchars($_SESSION['post'][0][1]) ?></h3>

Posted by <?= htmlspecialchars($_SESSION['post'][0][5]) ?> at <?= htmlspecialchars($_SESSION['post'][0][3]) ?>

<p><?= htmlspecialchars($_SESSION['post'][0][2]) ?></p>

visits: <?= htmlspecialchars($_SESSION['post'][0][4]) ?>

<br/>
Tags:
<?php foreach($_SESSION['tags'] as $tag) :?>
    <a href=""><?=htmlspecialchars($tag[0]) ?></a>
<?php endforeach ?>
<br/>

<?php
if($this->isAdmin) :?>
    <a href="/post/delete/<?=$_SESSION['post'][0][0]?>"><button>Delete</button></a>
<?php endif ?>