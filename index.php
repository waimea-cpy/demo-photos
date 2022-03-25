<?php

    require_once 'common-top.php';

    // See if we are filtering by user
    if( isset( $_GET['user'] ) && !empty( $_GET['user'] ) ) {

        // Is it our photos we're looking for?
        if( $loggedIn && $_SESSION['userID'] == $_GET['user'] ) {
            // Yes, getting our photos, even private ones
            $filter = 'WHERE users.id=?';
            $userID = $_SESSION['userID'];
            $format = 'i';
        } 
        else {
            // No, getting some other user's photos, so no private ones
            $filter = 'WHERE users.id=? AND NOT photos.private';
            $userID = $_GET['user'];
            $format = 'i';
        }
    }
    else {
        // Showing everyone's photos

        if( $loggedIn ) {
            // Logged in, so san see all our own pictures, and also anyone else's not-private ones
            $filter = 'WHERE users.id=? OR NOT photos.private';
            $userID = $_SESSION['userID'];
            $format = 'i';
        }
        else {
            // Not logged in, so can't see anyone's private pictures at all
            $filter = 'WHERE NOT photos.private';
            $userID = null;
            $format = null;
        }
    }

    $sql = 'SELECT photos.id AS pid,
                    photos.image,
                    photos.caption,
                    photos.timestamp,

                    users.id AS uid,
                    users.username,
                    users.forename,
                    users.surname 

            FROM photos
            JOIN users ON photos.user = users.id';

    // Glue on the previously prepared filter clause
    $sql = $sql.' '.$filter;

    $photos = getRecords( $sql, $format, [$userID] );

    echo '<section id="gallery">';

    // Loop thriugh the top-level posts
    foreach( $photos as $photo ) {

        $date = new DateTime( $photo['timestamp'] );
        $niceDate = $date->format( 'j M Y' );

?>

    <article class="photo card preview">

        <figure>
            <a href="show-photo.php?id=<?= $photo['pid'] ?>">
                <img src="<?= $photo['image'] ?>" alt="<?= $photo['caption'] ?>">
            </a>
            <figcaption><?= $photo['caption'] ?></figcaption>
        </figure>

        <div class="info">
            Upload by 
            <a href="index.php?user=<?= $photo['uid'] ?>"><?= $photo['forename'] ?> <?= $photo['surname'] ?></a>
            on <?= $niceDate ?>
        </div>

    </article>

<?php
    }

    echo '</section>';

    require_once 'common-bottom.php';

?>

