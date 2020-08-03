<?php


namespace Game;


class GameUsersView extends View
{
    /**
     * Constructor
     * Sets the page title and any other settings.
     */
    //public function __construct(Site $site, $get, Game $game) {
    public function __construct(Site $site, $get) {
        $this->site = $site;
        $this->gameid = $get["id"];
        //$this->user = $user;
        /*
        $games = new Games($this->site);
        $whole_game = $games->getWholeGame($this->gameid);
        $is_open = $whole_game['open'];
        if(!$is_open) {
            $root = $site->getRoot();
            $this->isRed = true;
            $this->redirect = "$root/game_board.php";
            $game = $games->get($this->gameid);
            $session[GAME_SESSION] = $game;
        }
        */
    }


    public function presentForm() {
        $html = "";
        $games = new Games($this->site);
        $gid = $this->gameid;
        $players = $games->getPlayers($gid);
        $html .= '<form method="post" action="post/game-user-post.php?id=' . $gid . '">';
        $html .= "<h2 class='gamesHeader'>Users In Game " . $gid . "</h2>";
        $html .=<<<HTML
<table class="gamesTable">
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Player</th>
    </tr>
HTML;
        if($players === null) {
            $html.= "</table>";
            $html .= "<p>There are no players in the game</p>";
        }
        else {
            // div surrounding list of games
            // might want to look into make this table or list
            //$html .= "<div>";
            //$html .= "<table class=\"gamesTable\"><tr></tr>"
            $i = 0;
            foreach($players as $og) {
                $i ++;
                $html .= "<tr>";
                //$id = $og['id'];
                $id = $og;
                $users = new Users($this->site);
                $user = $users->get($id);
                $name = $user->getName();
                if($i == 0) {
                    $player = "Mccullen";
                }
                else if($i == 1) {
                    $player = "Owen";
                }
                else if($i == 2) {
                    $player = "Day";
                }
                else if($i == 3) {
                    $player = "Plum";
                }
                else if($i == 4) {
                    $player = "Enbody";
                }
                else if($i == 5) {
                    $player = "Onsay";
                }
                $html .= "<td>$i</td>";
                $html .= "<td>$name</td>";
                $html .= "<td>$player</td>";
                //$op = $og['name'];
                //$created = $og['created'];

                //TODO make id an <a tag link of button to join that makes a post request

                //$html .= "<td>$i</td>";
                //TODO get datetime conversion figured out for this part of table and also make sure it is right in games
                //$html .= "<td>$op</td>";
                //if($op == true) {
                    //$html .= "<td><input name='gameJoiner' type='submit' value=\"$id\"></td>";
                    //$html .= "<input type=\"text\" id=\"gameid\" value=\"$id\" style=\"display:none\" id=\"$id\">";
                //}

                $html .= "</tr>";
            }
            //$html .= "</div>";
            $html.= "</table>";
        }
        //$html .= "</table>";
        $html .= '<h2 class="gamesHeader">Start The Game</h2>';
        $html .= '<p><input type="submit" name="newGameStarter" id="newGameStarter" value="Start The Game"></p>';
        $html .= "</form>";
        return $html;

    }

    /*
    public function presentForm() {
        $html = "";

        $gid = $this->gameid;

        $html .= '<form method="post" action="post/game-user-post.php?id=' . $gid . '">';
        $html .= "<h2 class='gamesHeader'>Users In Game " . $gid . "</h2>";
        $games = new Users($this->site);
        $openGames = $games->getPlayers($this->gameid);


        $html .=<<<HTML
<table class="gamesTable">
    <tr>
        <th>#</th>
        <th>Player Name</th>
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
            $i = 0;
            foreach($openGames as $og) {
                $i ++;
                $html .= "<tr>";
                $id = $og['id'];
                $op = $og['name'];
                //$created = $og['created'];

                //TODO make id an <a tag link of button to join that makes a post request

                $html .= "<td>$i</td>";
                //TODO get datetime conversion figured out for this part of table and also make sure it is right in games
                $html .= "<td>$op</td>";
                if($op == true) {
                    //$html .= "<td><input name='gameJoiner' type='submit' value=\"$id\"></td>";
                    //$html .= "<input type=\"text\" id=\"gameid\" value=\"$id\" style=\"display:none\" id=\"$id\">";
                }

                $html .= "</tr>";
            }
            //$html .= "</div>";
            $html.= "</table>";
        }
        //$html .= "</table>";

        $html .= '<h2 class="gamesHeader">Start The Game</h2>';
        $html .= '<p><input type="submit" name="newGameStarter" id="newGameStarter" value="Start The Game"></p>';
        $html .= "</form>";
        return $html;
    }
    */

    public function isRedirect() {
        return $this->isRed;
    }

    public function getRedirect() {
        return $this->redirect;
    }


    private $site;
    private $gameid;
    //private $user;
    private $isRed = false;
    private $redirect = "";
}