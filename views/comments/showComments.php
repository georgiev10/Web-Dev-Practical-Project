<?php //var_dump($this->comments);?>



<?php foreach($this->comments as $comment) :?>
    <div>
        <p><?= htmlspecialchars($comment[1]) ?></p>
    </div>
<?php endforeach ?>