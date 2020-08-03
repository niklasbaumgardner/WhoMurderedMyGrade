<?php
$open = true;
require 'lib/game.inc.php';
$view = new Game\PasswordValidateView($site, $_GET);

//if(!$view->protect($site, $user)) {
//    header("location: " . $view->getProtectRedirect());
//    exit;
//}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $view->head(); ?>
</head>

<body>
<div class="password">


    <?php echo $view->display_error(); ?>

    <?php echo $view->present(); ?>


</div>

</body>
</html>