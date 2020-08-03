<?php
$open = true;		// Can be accessed when not logged in
require '../lib/game.inc.php';

$controller = new Game\GameReceiverController($site, $_SESSION, $_POST);
header("location: " . $controller->getRedirect());