<?php
$open = true;
require 'lib/game.inc.php';
$view = new Game\GamesReceiverView($_SESSION, $_GET);

//if(!$view->protect($site, $user)) {
//    header("location: " . $view->getProtectRedirect());
//    exit;
//}

?>

<!DOCTYPE html>
<html lang="en">


<body>
<header>Join Game!!</header>

</body>
</html>

