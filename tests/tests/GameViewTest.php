<?php





class GameViewTest extends \PHPUnit\Framework\TestCase
{
    public function test_initial() {
        $game = new Game\Game();
//        $view = new \Game\GameView($game);

        $html = <<<HTML
<p><input type="checkbox" name="Owen" id="Owen"><label for="Owen">Prof. Owen</label></p>
<p><input type="checkbox" name="McCullen" id="McCullen"><label for="McCullen">Prof. McCullen</label></p>
<p><input type="checkbox" name="Onsay" id="Onsay"><label for="Onsay">Prof. Onsay</label></p>
<p><input type="checkbox" name="Enbody" id="Enbody"><label for="Enbody">Prof. Enbody</label></p>
<p><input type="checkbox" name="Plum" id="Plum"><label for="Plum">Prof. Plum</label></p>
<p><input type="checkbox" name="Day" id="Day"><label for="Day">Prof. Day</label></p>
<br>
<p>Select at least 2 players to play the game</p>
<br>
<form action="welcome-post.php"><p><input type="submit" value="Submit"></p></form>
HTML;

//        $this->assertContains($html, $view->intial());
    }
}