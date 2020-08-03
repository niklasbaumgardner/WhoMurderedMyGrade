<?php
$open = false;		// Can be accessed when not logged in
require '../lib/game.inc.php';

$_SESSION[Game\User::SESSION_NAME] = null;
$root = $site->getRoot();
header("location: $root/");