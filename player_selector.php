<?php
$open = true;
require __DIR__ . '/lib/game.inc.php';
$view = new Game\GameView($site, $user, $_GET, $_SESSION);
//$view = new Game\GameView($site, $_GET, $_SESSION, $user);

//if(!$view->protect($site, $user)) {
//    header("location: " . $view->getProtectRedirect());
//    exit;
//}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pick Your Character</title>
    <link href="lib/game.css" type="text/css" rel="stylesheet" />
</head>
<body>

<fieldset>
    <form method="post" action="welcome-post.php">
        <?php echo $view->intial(); ?>
    </form>
    <br>
    <form method="post" action="instructions_page.php">
        <p><input type="submit" name="ng" value="Instructions"></p>
    </form>
</fieldset>


</body>
</html>