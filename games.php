<?php
$open = true;
require 'lib/game.inc.php';
//$view = new Game\GamesReceiverView($site, $_GET, $game);

$view = new Game\GamesReceiverView($site, $_GET);

if(!$view->protect($site, $user)) {
    header("location: " . $view->getProtectRedirect());
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $view->head(); ?>
</head>

<body>
<div class="games">
    <?php echo $view->header(); ?>
    <?php echo $view->presentForm(); ?>
</div>

</body>
</html>