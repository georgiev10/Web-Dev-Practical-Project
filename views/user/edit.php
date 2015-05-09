<div class='col-md-8'>
    <div class="wrapper">
        <div class="title">
            <h4>Edit User Profile</h4>
        </div>
        <div class="logRegBox">
            <form action="/user/edit" method="POST">
                <?php if($this->isAdmin) :?>
                    <label for="newUsername">Username</label>
                    <input type="text" name="newUsername" id="newUsername" value=<?=$_SESSION['userProfile']['username']?>>
                    <input type="hidden" name="user_id" value=<?=$_SESSION['userProfile']['id']?>>
                    <input type="hidden" name="username" value=<?=$_SESSION['userProfile']['username']?>>
                    <br/>
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value=<?=$_SESSION['userProfile']['email']?>>
                    <br/>
                    <?php $_SESSION['userProfile']['is_admin'] == 0 ? $isUser = 'checked' : $isUser = ''; ?>
                    <?php $_SESSION['userProfile']['is_admin'] == 1 ? $isAdmin = 'checked' : $isAdmin = ''; ?>
                    <input type="radio" name="isAdmin" value="0" <?=$isUser?> > user<br>
                    <input type="radio" name="isAdmin" value="1" <?=$isAdmin?> > admin
                    <br/><br/>
                    <input type="submit" value="Edit">
                    <a href="/user/profile/<?=$_SESSION['userProfile']['username']?>">Cancel</a>
                <?php endif ?>
                <?php if(!$this->isAdmin) :?>
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value=<?=$_SESSION['userProfile']['email']?>>
                    <input type="hidden" name="user_id" value=<?=$_SESSION['userProfile']['id']?>>
                    <br/>
                    <input type="submit" value="Edit">
                    <a href="/user/profile/<?=$_SESSION['userProfile']['username']?>">Cancel</a>
                <?php endif ?>
            </form>
        </div>
    </div>
</div>