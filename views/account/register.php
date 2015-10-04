
<div id="login-user">
    <h1>Register</h1>
<form action="/account/register" method="post">
    <label for="username">Username:</label>
    <br />
    <input id="username" type="text" name="username">
    <br />
    <label for="password">Password:</label>
    <br />
    <input id="password" type="password" name="password">
    <br/>
    <label for="amount">Card-Amount</label>
    <br />
    <input id="amount" type="number" name="amount">
    <br />
    <input id="submit" type="submit" value="Register" />
    <br />
    <a href="/account/login">Go login</a>
</form>
</div>