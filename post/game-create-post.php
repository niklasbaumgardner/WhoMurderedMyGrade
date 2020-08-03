<?php
$open = true; // will need to change
require '../lib/game.inc.php';

$controller = new Game\GameReceiverController($site, $_SESSION, $_POST, $user);
header("location: " . $controller->getRedirect());