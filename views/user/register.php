<div class='col-md-8'>
    <div class="wrapper">
        <div class="title">
            <h4>Register</h4>
        </div>
        <div class="logRegBox">
            <form action="/user/register" method="POST">
                <label for="username">Username</label>
                <input type="text" name="username" id="username">
                <br/>
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
                <br/>
                <label for="email">Email</label>
                <input type="text" name="email" id="email">
                <br/>
                <input type="submit" value="Register">
                <a href="/user/login">Login</a>
            </form>
        </div>
    </div>
</div>

