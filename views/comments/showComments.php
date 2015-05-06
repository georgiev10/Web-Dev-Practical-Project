<?php //var_dump($this->comments);?>



<?php foreach($this->comments as $comment) :?>
<!--    --><?php //var_dump($comment);?>


    <div>
        <p><?= htmlspecialchars($comment[1]) ?></p>

        <?php
        $loggedUserId = $_SESSION['user_id'];
        $commentOwner = $comment[5];
        if($commentOwner == $loggedUserId || $this->isAdmin) :?>
            <a href="/comment/edit/<?=$comment[0]?>/<?=$commentOwner?>"><button>Edit</button></a>
        <?php endif ?>

        <?php
        if($this->isAdmin) :?>
            <a href="/comment/deleteConfirm"><button>Delete</button></a>
        <?php endif ?>
    </div>
<?php endforeach ?>