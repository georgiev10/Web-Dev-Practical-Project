<div class='col-md-8'>
    <div class="wrapper">
        <div class="title">
            <h4>Login</h4>
        </div>
        <div class="logRegBox">
            <form action="/user/login" method="POST">
                <label for="username">Username</label>
                <input type="text" name="username" id="username">
                <br/>
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
                <br/>
                <input type="submit" value="Login">
                <a href="/user/register">Register</a>
            </form>
        </div>
    </div>
</div>