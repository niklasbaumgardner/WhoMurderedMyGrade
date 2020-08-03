<?php
$open = true;
require '../lib/game.inc.php';

$controller = new Game\PasswordValidateController($site, $_POST);

header("location: " . $controller->getRedirect());