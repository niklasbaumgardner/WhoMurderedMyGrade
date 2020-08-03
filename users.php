<?php
$open = true;
require 'lib/game.inc.php';
//$view = new Game\GamesReceiverView($site, $_GET, $game);
//$view = new Game\GameUsersView($site, $_GET);
$view = new Game\GameUsersView($site, $_GET);


if(!$view->protect($site, $user)) {
    header("location: " . $view->getProtectRedirect());
    exit;
}
if($view->isRedirect()) {
    header("location: " + $view->getRedirect());
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $view->head(); ?>
    <script>
        /**
         * Initialize monitoring for a server push command.
         * @param key Key we will receive.
         */
        /*
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

        pushInit("saginawawavfbabvac");
         */
    </script>
</head>

<body>
<div class="games">
    <?php echo $view->presentForm(); ?>
</div>

</body>
</html>