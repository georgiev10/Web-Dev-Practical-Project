<h1><?= htmlspecialchars($this->title) ?></h1>

<?php foreach($this->posts as $post) : ?>
    <div>
        <a href="/post/<?=$post['id']?>" ><?= htmlspecialchars($post['title'])?></a>
        <br/>
        from : <?= htmlspecialchars($post['username']) ?>
        <br/>
        <?= htmlspecialchars($post['date']) ?>
    </div>
<?php endforeach ?>


