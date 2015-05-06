<h1><?= htmlspecialchars($this->title) ?></h1>

<?php var_dump($this->post)?>


<h3><?= htmlspecialchars($this->post[0][1]) ?></h3>

Posted by <?= htmlspecialchars($this->post[0][5]) ?> at <?= htmlspecialchars($this->post[0][3]) ?>

<p><?= htmlspecialchars($this->post[0][2]) ?></p>

visits: <?= htmlspecialchars($this->post[0][4]) ?>


<?php var_dump($this->tags)?>


<button id="show-comments">Show comments</button>

<a href="/comments/create/<?=$this->post[0][0]?>"><button>Add comments</button></a>

<?php
$loggedUsername = $_SESSION['username'];
$postOwner = $this->post[0][5];
if($loggedUsername == $postOwner || $this->isAdmin) :?>
    <a href="/post/edit/<?=$this->post[0][0]?>"><button>Edit</button></a>
<?php endif ?>

<div id="comments"></div>
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script>
    $('#show-comments').on('click', function(event) {
        $.ajax({
            url: '/comments/showComments/<?=$this->post[0][0]?>',
            method: 'GET'
        }).success(function(data){
            $('#comments').html(data);
        })
    })
</script>