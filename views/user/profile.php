<div class='col-md-8'>
    <div class="wrapper">
        <div class="title">
            <h4>User Profile</h4>
        </div>
        <div class="logRegBox">
            <p><b>Username: </b><?=$this->userProfile['username']?></p>
            <p><b>Email:  </b><?=$this->userProfile['email']?></p>
            <p><b>Role:  </b><?php echo($this->userProfile['is_admin']==0 ? 'user': 'admin')?></p>

            <?php
            if(isset($_SESSION['username'])){
                $loggedUsername = $_SESSION['username'];
            }else{
                $loggedUsername='';
            }
            ?>

            <?php if($loggedUsername == $this->userProfile['username']):?>
                <a href="/user/changePassConfirm"><button>Change Password</button></a>
            <?php endif ?>

            <?php if($loggedUsername == $this->userProfile['username'] || $this->isAdmin) :?>
                <a href="/user/editConfirm/<?=$this->userProfile['username']?>"><button>Edit</button></a>
            <?php endif ?>

            <a href="/"><button>Cancel</button></a>
        </div>
    </div>
</div>




