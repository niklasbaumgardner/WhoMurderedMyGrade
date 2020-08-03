<?php


namespace Game;


class GameView
{

    public function __construct(Site $site, User $user, $get, array &$session) {
        //$this->game = $game;
        $this ->site = $site;
        $this->user = $user;
        if(isset($get['$gid'])) {
            $this->gameId = $get['gid'];
        }
    }


    public function intial() {
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
        return $html;
    }


    /*
    public function intial() {
        $games = new Games($this->site);
        $game = $games->getWholeGame($this->gameId);
        if($userId )
    }
    */


    private $gameId;
    private $site;
    private $user;

}