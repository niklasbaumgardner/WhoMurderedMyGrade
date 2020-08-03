<?php
require __DIR__ . '/lib/game.inc.php';
$view = new Game\GameView($game);

//if(!$view->protect($site, $user)) {
//    header("location: " . $view->getProtectRedirect());
//    exit;
//}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>You Win</title>
    <link href="lib/game.css" type="text/css" rel="stylesheet" />
</head>
<body>
</body>
</html>
