<?php

$open = true;        // Can be accessed when not logged in
require '../lib/game.inc.php';

$controller = new Game\NewUserController($site, $_POST);
header("location: " . $controller->getRedirect());

echo "<pre>";
print_r($_POST);
echo "</pre>";