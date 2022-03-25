<?php

    require_once 'common-top.php';

?>

<form class="card" method="POST" action="process-new-photo.php" enctype="multipart/form-data">
    <h2>Upload a New Photo...</h2>

    <label>Photo File</label>
    <input name="photo" type="file" required>

    <label>Caption</label>
    <input name="caption" type="text" required>

    <label>Keep Photo Private?</label>
    <input name="private" type="checkbox" value="1">

    <div class="controls">
        <input type="submit" value="Upload Photo">
    </div>
</form>


<?php

    require_once 'common-bottom.php';

?>

