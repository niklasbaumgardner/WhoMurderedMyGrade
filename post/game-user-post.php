<?php
$open = true; // will need to change
require '../lib/game.inc.php';

$controller = new Game\GameUserController($site, $_SESSION, $_GET);



header("location: " . $controller->getRedirect());