<?php
require '../lib/game.inc.php';

$controller = new Game\StartController($site, $_POST);
header("location: " . $controller->getRedirect());