<?php

require __DIR__ . '/lib/game.inc.php';


$players = $game->getPlayers();
$cards_displayed = $game->get_cards_displayed();

if (count($players) == count($cards_displayed)) {
    $game->rollDice();
    header("location: game_board.php");
    exit;
}

foreach ($players as $player) {
    if (!in_array($player, $cards_displayed)) {
        break;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cards</title>
    <link href="lib/game.css" type="text/css" rel="stylesheet" />
</head>
<body>

<fieldset>
    <p>Cards for <?php echo $player->getPlayerChar(); ?></p>
    <form class="no-print" action="cards-post.php" method="post">
        <p><input type="button" onclick="window.print();return false;" value="Print">
            <input type="submit" value="Next">
        </p>
    </form>
</fieldset>

<div class="print-only">
    <h1>Cards for <?php echo $player->getPlayerChar(); ?></h1>
    <br>
    <p>Held cards</p>
    <br>
    <div class="held-cards">
        <p><?php echo $player->getPlayerCards()->displayHand(); ?></p>
    </div>
    <br>
    <p>Other cards</p>
    <br>
    <div class="other-cards">
        <p><?php echo $player->getPlayerCards()->displayNotHand(); ?></p>
    </div>
</div>

</body>
</html>
