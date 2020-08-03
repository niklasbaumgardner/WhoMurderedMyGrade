<?php
require __DIR__ . "/../vendor/autoload.php";

$site = new Game\Site();
$localize = require 'localize.inc.php';
if(is_callable($localize)) {
    $localize($site);
}

// Start the PHP session system
session_start();

// Start the session system
$user = null;
if(isset($_SESSION[Game\User::SESSION_NAME])) {
    $user = $_SESSION[Game\User::SESSION_NAME];

}



/*
define("GAME_SESSION", 'game');

if(!isset($_SESSION[GAME_SESSION])) {
    $_SESSION[GAME_SESSION] = new Game\Game();
}


//$_SESSION[GAME_SESSION] = new Game\Game();
//if(!isset($_POST[]))

$game = $_SESSION[GAME_SESSION];
*/

define("GAME_SESSION", 'game');

if(isset($_SESSION[GAME_SESSION])) {
    $game = $_SESSION[GAME_SESSION];
}

// redirect if user is not logged in
if((!isset($open) || !$open) && $user === null) {
    $root = $site->getRoot();
    header("location: $root/");
    exit;
}

