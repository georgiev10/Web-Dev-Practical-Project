<!DOCTYPE html>
<html>

<head>
    <link href='http://fonts.googleapis.com/css?family=Sanchez&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/content/bootstrap.css" />
    <link rel="stylesheet" href="/content/bootstrap-theme.css" />
    <link rel="stylesheet" href="/content/styles.css">
    <meta charset="utf-8">
    <title>
        <?php if(isset($this->title))
            echo htmlspecialchars($this->title)?>
    </title>
</head>

<body>
    <header id="app-header">
        <ul>
            <li><a href="/">Home</a></li>
            <?php if($this->isLoggedIn):?>
                <li><a href="/authors">TODO</a></li>
                <li><a href="/books">TODO</a></li>
            <?php endif ?>
        </ul>
        <?php if($this->isLoggedIn) :?>
            <div id="logged-in-info">
                <span>Hello,<?php if($this->isAdmin){echo(' admin ');}?> <?php echo $_SESSION['username']?></span>
                <form action="/user/logout"><input type="submit" value="Logout"/></form>
            </div>
        <?php endif ?>
        <?php if(!$this->isLoggedIn) :?>
            <div id="logged-in-info">
                <a href="/user/login">Login</a>
                <a href="/user/register">Register</a>
            </div>
        <?php endif ?>
    </header>
    <?php include('messages.php'); ?>
    <div id='app-content'>