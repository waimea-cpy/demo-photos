<?php

    require_once 'common-top.php';

    echo '<div class="card">';
    echo '<h2>Uploading Photo...</h2>';

    // Check if image file exists
    if( !isset( $_FILES['photo'] ) ) showErrorAndDie( 'Missing Photo File' );

    // Check that all data fields exist
    if( !isset( $_POST['caption'] ) || empty( $_POST['caption'] ) )  showErrorAndDie( 'Missing Caption' );
    if( !isset( $_POST['private'] ) || empty( $_POST['private'] ) )  $_POST['private'] = 0;

    // Upload the image to the server and get the new randomised filename
    $photoFilePath = uploadImage( $_FILES['photo'], 'uploads', true );

    // Setup query
    $sql = 'INSERT INTO photos (image, caption, private, user)
            VALUES (?, ?, ?, ?)';
    $types = 'ssii';
    $data = [
        $photoFilePath, 
        $_POST['caption'],
        $_POST['private'],
        $_SESSION['userID']
    ];

    // Send data to server
    modifyRecords( $sql, $types, $data );

    // If we get here, all went well!
    showStatus( 'Success!' );
    echo '</div>';

    // Head back to the home page
    addRedirect( 2000, 'index.php' );

    require_once 'common-bottom.php';
?>    