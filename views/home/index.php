<?php if(!$this->isLoggedIn) :?>
        <a href="/user/login">Login</a>
        <a href="/user/register">Register</a>
<?php endif ?>
<?php if($this->isLoggedIn) :?>
    <a href="/post/create">Create a new Post</a>
<?php endif ?>

<h3>Last posts</h3>

<?php foreach($this->posts as $post) : ?>
    <div>
        <a href="/post/index/<?=$post[0]?>" ><?= htmlspecialchars($post[1])?></a>
        <br/>
        from : <?= htmlspecialchars($post[3]) ?>
        <br/>
        <?= htmlspecialchars($post[2]) ?>
    </div>
<?php endforeach ?>
<a href='/home/index/<?=$this->page<=0 ? $this->page=0 : $this->page - 1?>/<?= $this->pageSize ?>'>Previous</a>
<a href='/home/index/<?= $this->posts==null ? $this->page=$this->page :  $this->page + 1 ?>/<?= $this->pageSize ?>'>Next</a>




