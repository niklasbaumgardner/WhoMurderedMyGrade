<?php

use Game\Player;

require 'lib/game.inc.php';

$controller = new Game\StartController($game, $_POST);
$game->newGame();

if (isset($_POST['Owen'])) {
    $owen = new \Game\Player(Player::OWE_ID, 'Owen');
    $game->add_player($owen);
}
if (isset($_POST['McCullen'])) {
    $mccullen = new \Game\Player(Player::MCC_ID, 'McCullen');
    $game->add_player($mccullen);
}
if (isset($_POST['Onsay'])) {
    $onsay = new \Game\Player(Player::ONS_ID, 'Onsay');
    $game->add_player($onsay);
}
if (isset($_POST['Enbody'])) {
    $enbody = new \Game\Player(Player::ENB_ID, 'Enbody');
    $game->add_player($enbody);
}
if (isset($_POST['Plum'])) {
    $plum = new \Game\Player(Player::PLU_ID, 'Plum');
    $game->add_player($plum);
}
if (isset($_POST['Day'])) {
    $day = new \Game\Player(Player::DAY_ID, 'Day');
    $game->add_player($day);
}

$game->deal();



if (count($game->getPlayers()) >= 2){
    header("location: display_cards.php");
    exit;
}

else{
    header("location: index.php");
    exit;
}

