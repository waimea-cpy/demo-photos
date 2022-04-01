<?php

    require_once 'common-top.php';


    // Make sure that there is an ID passed via GET
    if( !isset( $_GET['id'] ) || empty( $_GET['id'] ) ) showErrorAndDie( "Unknown photo ID" );

    // Get the ID from the URL
    $photoID = $_GET['id'];

    // Get the top-level posts (parent is NULL)
    $sql = 'SELECT photos.image,
                   photos.caption,
                   photos.timestamp,

                   users.id AS uid,
                   users.username,
                   users.forename,
                   users.surname 

            FROM photos
            JOIN users ON photos.user = users.id 

            WHERE photos.id=?';

    $photos = getRecords( $sql, 'i', [$photoID] );

    if( count( $photos ) == 0 ) showErrorAndDie( 'No photo with the given ID' );

    $photo = $photos[0];

    echo '<section id="post-list">';

    $date = new DateTime( $photo['timestamp'] );
    $niceDate = $date->format( 'h:ia, j M Y' );

?>

    <article class="photo card">

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

    echo '</section>';

    require_once 'common-bottom.php';

?>

