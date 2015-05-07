<?php
$post_id = $_SESSION['post'][0][0];
$title = $_SESSION['post'][0][1];
$content = $_SESSION['post'][0][2];
$postOwner = $_SESSION['post'][0][5];
$date = $_SESSION['post'][0][3];
$visits = $_SESSION['post'][0][4];
?>

<h1>Delete</h1>
<h3><?= htmlspecialchars($title) ?></h3>
Posted by <?= htmlspecialchars($postOwner) ?> at <?= htmlspecialchars($date) ?>
<p><?= htmlspecialchars($content) ?></p>
visits: <?= htmlspecialchars($visits) ?>
<br/>
Tags:
<?php foreach($_SESSION['tags'] as $tag) :?>
    <a href=""><?=htmlspecialchars($tag[0]) ?></a>
<?php endforeach ?>
<br/>

<?php
if($this->isAdmin) :?>
    <a href="/post/delete/<?=$post_id?>"><button>Delete</button></a>
    <a href="/post/index/<?=$post_id?>"><button>Cancel</button></a>
<?php endif ?>
