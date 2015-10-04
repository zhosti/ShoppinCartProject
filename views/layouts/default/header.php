<!DOCTYPE html>
<html>

<head>
    <meta charset="utf8">
    <link rel="stylesheet" href="/content/styles.css">
    <title>
        <?php if(isset($this->title)) echo htmlspecialchars($this->title); ?>
    </title>
</head>

<body>
    <header>
        <nav id="navigation" class="site-navigation" role="navigation">
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/categories">Categories</a></li>
                <li><a href="/products">Products</a></li>
                <?php if($this->isLoggedIn()) : ?>
                    <li><a href="/cart">Cart</a></li>
                <?php endif ?>
                <?php if($this->isAdmin()) : ?>
                    <li class="menu-item"><a href="/admin">AdminPanel</a>
                    <ul class="dropdown">
                        <li class="menu-item sub-menu"><a href="#">Users</a></li>
                        <li  class="menu-item sub-menu"><a href="/admin/addProductInCategory">Products</a></li>
                    </ul>
                    </li>
                <?php endif ?>
            </ul>

        <?php if(!$this->isLoggedIn()) : ?>
            <div class="menu-login">
                <ul>
                    <li><a href="/account/login">Login</a></li>
                    <li><a href="/account/register">Register</a></li>
                </ul>
            </div>
        <?php endif ?>

        <?php if ($this->isLoggedIn()): ?>
            <div id="logged-in-info">

                <span>Welcome, <?= $_SESSION['username']; ?> </span>
                <br/>
                <span>Your Amount is: <?= $this->userId[1]; ?> &euro;</span>
                <form action="/account/logout">
                    <input type="submit" value="Logout" />
                </form>
            </div>
        <?php endif; ?>
        </nav>
    </header>
    <?php include_once('views/layouts/messages.php'); ?>