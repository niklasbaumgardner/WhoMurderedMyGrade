<?php
//require 'lib/Game/BoardView.php';
//require 'lib/game.inc.php';
$open = true;
require 'lib/game.inc.php';
//$view = new Game\BoardView();
$games = new Game\Games($site);
$game = $games->get($game->getID());
$view = new Game\BoardView($game);


//if(!$view->protect($site, $user)) {
//    header("location: " . $view->getProtectRedirect());
//    exit;
//}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game</title>
    <link href="lib/game.css" type="text/css" rel="stylesheet" />


    <script>
        /**
         * Initialize monitoring for a server push command.
         * @param key Key we will receive.
         */
        function pushInit(key) {
            var conn = new WebSocket('ws://webdev.cse.msu.edu/ws');
            conn.onopen = function (e) {
                console.log("Connection to push established!");
                conn.send(key);
            };

            conn.onmessage = function (e) {
                try {
                    var msg = JSON.parse(e.data);
                    if (msg.cmd === "reload") {
                        location.reload();
                    }
                } catch (e) {
                }
            };
        }

        pushInit("saginawawavfbabvac<?php echo $game->getID();?>");
    </script>


</head>
<body>


<form method="post" action="game-post.php">
    <div class="game">
        <?php echo $view->display_board2(); ?>
        <?php echo $view->display_board3(); ?>
    </div>
</form>

<div class="dice-area">
    <?php echo $view->display_current_player(); ?>
    <?php echo $view->display(); ?>
</div>

<!--<form method="post" action="index.php">-->
<!--    <p><input type="submit" name="ng" value="New Game"></p>-->
<!--</form>-->

<div class="cards-area">
    <?php
    $player = null;
    for ($i = 0; $i < count($game->getPlayers()); $i ++) {

        if ($game->getPlayers()[$i]->getUserID() == $_SESSION["user"]->getID()) {

            $player = $game->getPlayers()[$i];
            break;
        }
    }
    ?>
    <h1>Cards for <?php echo $player->getPlayerChar(); ?></h1>
    <h1>It is <?php echo $view->isCurrent(); ?> your turn</h1>

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
