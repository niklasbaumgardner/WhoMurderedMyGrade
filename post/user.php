<?php
require '../lib/game.inc.php';

$controller = new Game\UserController($site, $_POST);
header("location: " . $controller->getRedirect());