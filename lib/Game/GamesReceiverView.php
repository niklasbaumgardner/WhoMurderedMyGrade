<?php


namespace Game;


class GamesReceiverView extends View
{
    /**
     * Constructor
     * Sets the page title and any other settings.
     */
    //public function __construct(Site $site, $get, Game $game) {
    public function __construct(Site $site, $get) {
        $this->site = $site;
        $this->addLink("post/logout.php", "Log out");
        //$this->game = $game;
    }

    public function presentForm() {
        $html = "";

        $html .= '<form method="post" action="post/game-create-post.php">';
        $html .= "<h2 class='gamesHeader'>Join Game</h2>";
        $games = new Games($this->site);
        $openGames = $games->getGames();


        $html .=<<<HTML
<table class="gamesTable">
    <tr>
        <th>ID</th>
        <th>Date Created</th>
        <th>PlayerCount</th>
    </tr>
HTML;
        if($openGames === null) {
            $html.= "</table>";
            $html .= "<p>There are no open games</p>";
        }
        else {
            // div surrounding list of games
            // might want to look into make this table or list
            //$html .= "<div>";
            //$html .= "<table class=\"gamesTable\"><tr></tr>"

            foreach($openGames as $og) {
                $html .= "<tr>";
                $id = $og['id'];
                $op = $og['open'];
                //$created = $og['created'];
                $playercount = $og['playercount'];

                //TODO make id an <a tag link of button to join that makes a post request

                $html .= "<td>$id</td>";
                //TODO get datetime conversion figured out for this part of table and also make sure it is right in games
                $html .= "<td>Some date</td>";
                $html .= "<td>$playercount</td>";
                if($op == true) {
                    $html .= "<td><input name='gameJoiner' type='submit' value=\"$id\"></td>";
                    //$html .= "<input type=\"text\" id=\"gameid\" value=\"$id\" style=\"display:none\" id=\"$id\">";
                }

                $html .= "</tr>";
            }
            //$html .= "</div>";
            $html.= "</table>";
        }
        //$html .= "</table>";

        $html .= '<h2 class="gamesHeader">Start New Game</h2>';
        $html .= '<p><input type="submit" name="newGameStarter" id="newGameStarter" value="New Game"></p>';
        $html .= "</form>";
        return $html;
    }

    private $site;
    //private $game;
}