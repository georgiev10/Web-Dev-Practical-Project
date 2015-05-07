<div class='col-md-8'>
    <div class="wrapper">
        <div class="title">
            <h4>Recent Posts</h4>
        </div>
        <div class="post">
            <ul class="post">
                <?php foreach($this->posts as $post) : ?>
                    <li class="box">
                        <p><a href="/post/index/<?=$post[0]?>" ><?= htmlspecialchars($post[1])?></a></p>
                        <?php $date = date_create($post[2]);?>
                        <span>Posted by <?= htmlspecialchars($post[3]) ?> at <?php echo date_format($date, 'g:ia \o\n l') ?></span>
                        <br/>

                        <span><?php echo date_format($date, 'jS F Y') ?></span>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
        <span>
            <a href='/home/index/<?=$this->page<=0 ? $this->page=0 : $this->page - 1?>/<?= $this->pageSize ?>'>Previous</a>
            <a href='/home/index/<?= $this->posts==null ? $this->page=$this->page :  $this->page + 1 ?>/<?= $this->pageSize ?>'>Next</a>
        </span>
    </div>
</div>


