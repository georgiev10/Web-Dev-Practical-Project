<?php
$post_id = $this->post[0][0];
$title = $this->post[0][1];
$content = $this->post[0][2];
$postOwner = $this->post[0][5];
$date = date_create($this->post[0][3]);
$visits = $this->post[0][4];
?>

<div class='col-md-8'>
    <div class="wrapper">
        <div class="title">
            <h4><?= htmlspecialchars($title) ?></h4>
        </div>
        <div class="boxPost">
            <p><?= htmlspecialchars($content) ?></p>
            <div class="small-text">
                <span>Posted by <a href="/user/getUserProfile/<?=$postOwner?>"><?= htmlspecialchars($postOwner) ?></a> at <?php echo date_format($date, 'g:ia \o\n l jS F Y')?></span>
                <span class="right">visits: <?= htmlspecialchars($visits) ?></span>
                <br/>
                <span>Tags:
                    <?php foreach($this->tags as $tag) :?>
                       <a href=""><?=htmlspecialchars($tag[0]) ?></a>
                    <?php endforeach ?>
                </span>
            </div>
            <div class="right">
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
            </div>
            <br/>
        </div>
    </div>

    <div class="wrapper">

        <div class="title">
            <h4>Comments</h4>
        </div>

        <div class="boxPost">
            <?php foreach($this->comments as $comment) :?>
                <?php
                    $comment_id = $comment[0];
                    $content = $comment[1];
                    $commentPublishDate =  date_create($comment[2]);
                    $commentQwnerRegisteredUser = $comment[5];
                    $commentQwnerVisitorName = $comment[3];
                    $commentQwnerVisitorEmail = $comment[4];
                    if($commentQwnerRegisteredUser){
                        $commentQwner = '<a href=/user/getUserProfile/' . $commentQwnerRegisteredUser .'/>' .
                                            htmlspecialchars($commentQwnerRegisteredUser) .'</a>';
                    }else{
                        if($commentQwnerVisitorEmail){
                            $commentQwner = $commentQwnerVisitorName . ' ' . $commentQwnerVisitorEmail;
                        }else{
                            $commentQwner = $commentQwnerVisitorName;
                        }
                    }
                ?>
                <div class="commentBox">
                    <p><?= htmlspecialchars($content) ?></p>
                    <div class="small-text">
                        <span>Comment by <?=$commentQwner?> at
                            <?php echo date_format($commentPublishDate, 'g:ia \o\n l jS F Y')?>
                        </span>
                    </div>
                    <div class="right">
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
                    <br/>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>












