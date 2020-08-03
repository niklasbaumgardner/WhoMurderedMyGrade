<?php
require __DIR__ . '/lib/game.inc.php';
//$controller = new Game\StartController($game, $_POST);
$controller = new Game\GameController($game, $_POST, $site);

/*
if($controller->isReset()) {
    //$controller->newGame();
}
*/


//header('Location: ', $controller->getPage());
header('Location: game_board.php');
//header('Location: index.php');
exit;
