<?php
require '../lib/game.inc.php';

$controller = new Game\GameController($site, $_POST);
header("location: " . $controller->getRedirect());