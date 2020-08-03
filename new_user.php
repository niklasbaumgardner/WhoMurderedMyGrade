<?php
$open = true;
require 'lib/game.inc.php';
$view = new Game\NewUserView($site, $_GET);
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