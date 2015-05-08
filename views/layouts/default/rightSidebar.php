<div class='col-md-2 sidebar'>
    <div class="wrapper">
        <div class="title">
            <h4>
                <?php if($this->isLoggedIn) :?>
                    <a href="/post/create">Create a new Post</a>
                <?php endif ?>
                <?php if(!$this->isLoggedIn) :?>
                    <span>Please Login</span>
                <?php endif ?>
            </h4>
        </div>
    </div>
</div>



