<div class='col-md-2 sidebar'>
    <div class="wrapper">
        <div class="title">
            <h4>Search by tag</h4>
        </div>
        <div class="tagsBox">
            <form method="get" action="/post/getPostsByTag/0/4/">
                <input type="text" name="tag" id="tag" placeholder="Enter a tag...">
                <br/>
                <input type="submit" value="Search">
            </form>
        </div>
    </div>
    <div class="wrapper">
        <div class="title">
            <h4>Popular tags</h4>
        </div>
        <div class="tagsBox">
            <?php foreach($this->tagSidebar as $tag) :?>
                <div class="tag"><a href="/post/getPostsByTag/0/4/<?=$tag[0]?>"><?=htmlspecialchars($tag[0]) ?></a></div>
            <?php endforeach ?>
            <br/>
        </div>
    </div>
</div>


