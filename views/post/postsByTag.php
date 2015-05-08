<div class='col-md-8'>
    <div class="wrapper">
        <div class="title">
            <h4>Posts By Tag: <?=$this->tag?></h4>
        </div>
        <div class="posts">
            <ul class="posts">
                <?php foreach($this->posts as $post) : ?>
                    <li class="box">
                        <p><a href="/post/index/<?=$post[0]?>" ><?= htmlspecialchars($post[1])?></a></p>
                        <div class="small-text">
                            <?php $date = date_create($post[2]);?>
                            <span>Posted by <?= htmlspecialchars($post[3]) ?> at <?php echo date_format($date, 'g:ia \o\n l') ?></span>
                            <br/>
                            <span><?php echo date_format($date, 'jS F Y') ?></span>
                        </div>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
        <div class="paging">
            <a href='/post/getPostsByTag/<?=$this->page<=0 ? $this->page=0 : $this->page - 1?>/<?= $this->pageSize ?>/<?=$this->tag?>'>Previous..</a>
            <a href='/post/getPostsByTag/0/<?=$this->pageSize?>/<?=$this->tag?>'>...Home...</a>
            <a href='/post/getPostsByTag/<?= $this->posts==null ? $this->page=$this->page :  $this->page + 1 ?>/<?= $this->pageSize ?>/<?=$this->tag?>'>..Next</a>
        </div>
    </div>
</div>

