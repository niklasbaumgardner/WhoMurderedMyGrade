<?php
require __DIR__ . '/lib/game.inc.php';


$players = $game->getPlayers();
$cards_displayed = $game->get_cards_displayed();


foreach ($players as $player) {
    if (!in_array($player, $cards_displayed)) {
        $game->add_cards_displayed($player);
        break;
    }
}

header("location: display_cards.php");
exit;
