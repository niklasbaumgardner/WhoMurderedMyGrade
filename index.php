<?php

$open = true;
require 'lib/game.inc.php';
$view = new Game\LoginView($_SESSION, $_GET);
?>
<!DOCTYPE html>
<html lang="en">
<!--<head>-->
<!--    --><?php //echo $view->head(); ?>
<!--</head>-->

<body>
<div class="login">
    <?php
    //echo $view->header();
    echo $view->presentForm();
    //echo $view->footer();
    ?>
</div>

</body>
</html>






<!--//old index . php-->
<!---->
<!---->
<!---->
<!--//$open = true;-->
<!--//require __DIR__ . '/lib/game.inc.php';-->
<!--//$view = new Game\GameView($game);-->
<!--//?>-->
<!--<!DOCTYPE html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <title>Pick Your Character</title>-->
<!--    <link href="game.css" type="text/css" rel="stylesheet" />-->
<!--</head>-->
<!--<body>-->
<!---->
<!--<fieldset>-->
<!--    <form method="post" action="welcome-post.php">-->
<!--    --><?php //echo $view->intial(); ?>
<!--    </form>-->
<!--    <br>-->
<!--    <form method="post" action="instructions_page.php">-->
<!--        <p><input type="submit" name="ng" value="Instructions"></p>-->
<!--    </form>-->
<!--</fieldset>-->
<!---->
<!---->
<!--</body>-->
<!--</html>-->
