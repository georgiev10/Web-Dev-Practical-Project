<?php
$post_id = $_SESSION['post'][0][0];
$title = $_SESSION['post'][0][1];
$content = $_SESSION['post'][0][2];
$postOwner = $_SESSION['post'][0][5];
$date = date_create($_SESSION['post'][0][3]);
$visits = $_SESSION['post'][0][4];
?>

<div class='col-md-8'>
    <div class="wrapper">
        <div class="title">
            <h4><?= htmlspecialchars($title)?></h4>
        </div>
        <div class="boxPost">
            <p><?= htmlspecialchars($content) ?></p>
            <div class="small-text">
                <span>Posted by <?= htmlspecialchars($postOwner) ?> at
                    <?php echo date_format($date, 'g:ia \o\n l jS F Y')?></span>
                <span class="right">visits: <?= htmlspecialchars($visits) ?></span>
                <br/>
                <span>Tags:
                    <?php foreach($_SESSION['tags'] as $tag) :?>
                        <a href=""><?=htmlspecialchars($tag[0]) ?></a>
                    <?php endforeach ?>
                </span>
            </div>
            <div class="right">
                <?php
                if($this->isAdmin) :?>
                    <a href="/post/delete/<?=$post_id?>"><button>Delete</button></a>
                    <a href="/post/index/<?=$post_id?>"><button>Cancel</button></a>
                <?php endif ?>
            </div>
            <br/>
        </div>
    </div>
</div>

