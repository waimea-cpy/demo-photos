<?php
    require_once 'common-session.php';
    require_once 'common-functions.php';

    // Check if login data exists and use is logged in
    if( isset( $_SESSION['loggedIn'] ) && $_SESSION['loggedIn'] == true ) {
        $loggedIn = true;
    }
    else {
        $loggedIn = false;
    }

?>
    

<!doctype html>

<html>
    
<head>
    <title>Lens</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="favicon.svg" type="image/svg+xml">

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <header id="main-header">

        <h1><a href="index.php">
            <img src="images/lens.svg" alt="header icon">
            Lens
        </a></h1>

        <div id="user-info">
<?php
    if( $loggedIn ) {
        echo $_SESSION['forename'].' '.$_SESSION['surname'];
    }
    else {
        echo 'Guest';
    }
?>
        </div>

        <nav id="main-nav">
            
            <label for="toggle">
                <img src="images/menu.svg">
            </label>

            <input id="toggle" type="checkbox">

            <ul>
                <label for="toggle">
                    <img src="images/close.svg">
                </label>

<?php

    echo '<li><a href="index.php">Browse Photos</a></li>';

    if( $loggedIn ) {
        echo '<li><a href="index.php?user='.$_SESSION['userID'].'">View Your Photos</a></li>';
        echo '<li><a href="form-new-photo.php">Upload a Photo</a></li>';
        echo '<li><a href="process-logout.php">Logout</a></li>';
    }
    else {    
        echo '<li><a href="form-login.php">Login</a></li>';
        echo '<li><a href="form-new-user.php">Create Account</a></li>';
    }

?>
            </ul>
        </nav>

    </header>

    <main>

