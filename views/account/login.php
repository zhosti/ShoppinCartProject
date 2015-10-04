<div id="login-user">
    <h1>Login</h1>
    <form action="/account/login" method="post">
        <label for="username">Username</label>
        <br />
        <input id="username" type="text" name="username">
        <br />
        <label for="password">Password</label>
        <br>
        <input id="password" type="password" name="password">
        <br/>
        <br />
        <input id="submit" type="submit" value="Login" />
        <br/>
        <a href="/account/register">Go register</a>
    </form>
</div>