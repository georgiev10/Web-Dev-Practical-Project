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
            <div id="top-menu">
                <a href="/">Home</a>
            </div>
            <?php if($this->isLoggedIn) :?>
                <div id="user-in-info">
                    <span>Hello,
                        <?php if($this->isAdmin){echo(' admin ');}?>
                        <?php echo ($_SESSION['username'])?>
                    </span>
                </div>
            <?php endif ?>
            <?php if($this->isLoggedIn) :?>
                <div id="logged-in-info">
                    <a href="/user/logout">Logout</a>
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