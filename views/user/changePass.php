<div class='col-md-8'>
    <div class="wrapper">
        <div class="title">
            <h4>Edit User Profile</h4>
        </div>
        <div class="logRegBox">
            <form action="/user/changePassConfirm" method="POST">
                <label for="new-password">New Password</label>
                <input type="password" name="new-password" id="new-password">
                <br/>
                <label for="repeat-new-password">Repeat New Password</label>
                <input type="password" name="repeat-new-password" id="repeat-new-password">
                <input type="hidden" name="user_id" value=<?=$_SESSION['userProfile']['id']?>>
                <br/>
                <input type="submit" value="Change Password">
                <a href="/user/profile/<?=$_SESSION['userProfile']['username']?>">Cancel</a>
            </form>
        </div>
    </div>
</div>