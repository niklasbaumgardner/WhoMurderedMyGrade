<?php

namespace Game;


class BoardView
{
    private $game;

    private $isCurrentPlayer;

    //private $player;

    public function __construct(Game $game)
    {
        $this->game = $game;
        //$this->player = $player;
        $current = $game->get_current_player();
        if ($_SESSION["user"]->getID() == $current->getUserID()){
            $this->isCurrentPlayer = true;
        } else {
            $this->isCurrentPlayer = false;
        }
    }

    public function display_current_player()
    {
        $player = $this->game->get_current_player();
        $player_name = $player->getPlayerChar();
        $html = "";
        $html .= <<<HTML
<p>Player<br>Prof. $player_name<br></p>
HTML;
        return $html;
    }

    public function display_dice()
    {
        $html = "";
        if ((!$this->game->getPlayOpt())
            && (!$this->game->getMurdOpt())
            && (!$this->game->getSuggOpt())) {
            $html .= '<div class="dice">';
            $image1 = $this->game->getDice1Img();
            $image2 = $this->game->getDice2Img();
            $name1 = $this->game->getDice1Num();
            $name2 = $this->game->getDice2Num();
            $html .= <<<HTML
<p><img src="images/$image1" alt="$name1"><img src="images/$image2" alt="$name2"></p>
HTML;
            $html .= '</div>';
        }
        return $html;
    }


    public function display_board2()
    {
        $html = "";
        if (!$this->game->getMurdOpt()) {
            $pUp = $this->game->getPlayerUp();
            $this->game->resetNodes();
            $c = $pUp->getCol();
            $r = $pUp->getRow();

            $dist = $this->game->getTotalNumMoves();

            $pN = $this->game->getNode($r, $c);
            $pN->searchReachable($dist, $pN);


            $frozen = $this->game->getFrozen();

            for ($i = 0; $i < 25; $i++) {
                $html .= '<div class="row">';
                for ($j = 0; $j < 24; $j++) {

                    $n = $this->game->getNode($i, $j);
                    if ($n->isReachable() and !$frozen and $this->isCurrentPlayer) {
                        if (($i == $r) && ($j == $c)) {
                            $p = $this->game->getPlayer($i, $j);
                            $html .= '<div class="cell">';
                            $html .= "<button type=\"submit\" name=\"cell\" value=\"$i, $j\">";
                            if ($p->getPlayerId() == Player::MCC_ID) {
                                $html .= "<img class=\"player-piece\" src=\"images/mccullen-piece.png\">";
                            } else if ($p->getPlayerId() == Player::OWE_ID) {
                                $html .= "<img class=\"player-piece\" src=\"images/owen-piece.png\">";
                            } else if ($p->getPlayerId() == Player::ONS_ID) {
                                $html .= "<img class=\"player-piece\" src=\"images/onsay-piece.png\">";
                            } else if ($p->getPlayerId() == Player::ENB_ID) {
                                $html .= "<img class=\"player-piece\" src=\"images/enbody-piece.png\">";
                            } else if ($p->getPlayerId() == Player::PLU_ID) {
                                $html .= "<img class=\"player-piece\" src=\"images/plum-piece.png\">";
                            } else if ($p->getPlayerId() == Player::DAY_ID) {
                                $html .= "<img class=\"player-piece\" src=\"images/day-piece.png\">";
                            }
                            $html .= '</button>';
                            $html .= '</div>';
                        } else if ($this->game->isPlayerAtPos($i, $j)) {
                            $p = $this->game->getPlayer($i, $j);
                            //$img = $this->game->getImg($p);
                            //$img = $p->getPieceImg();
                            $html .= '<div class="cell">';
                            //$html .= "<button type=\"submit\" name=\"cell\" value=\"$i, $j\">";
                            if ($p->getPlayerId() == Player::MCC_ID) {
                                $html .= "<img class=\"player-piece\" src=\"images/mccullen-piece.png\">";
                            } else if ($p->getPlayerId() == Player::OWE_ID) {
                                $html .= "<img class=\"player-piece\" src=\"images/owen-piece.png\">";
                            } else if ($p->getPlayerId() == Player::ONS_ID) {
                                $html .= "<img class=\"player-piece\" src=\"images/onsay-piece.png\">";
                            } else if ($p->getPlayerId() == Player::ENB_ID) {
                                $html .= "<img class=\"player-piece\" src=\"images/enbody-piece.png\">";
                            } else if ($p->getPlayerId() == Player::PLU_ID) {
                                $html .= "<img class=\"player-piece\" src=\"images/plum-piece.png\">";
                            } else if ($p->getPlayerId() == Player::DAY_ID) {
                                $html .= "<img class=\"player-piece\" src=\"images/day-piece.png\">";
                            }
                            $html .= '</div>';
                        } else {
                            $html .= '<div class="cell">';
                            //$html .= "<button type=\"submit\" name=\"cell\" value=\"$i, $j\"></button>";
                            $html .= "<button type=\"submit\" name=\"cell\" value=\"$i, $j\">";
                            $html .= '</button>';
                            $html .= '</div>';
                        }
                    } else if ($this->game->isPlayerAtPos($i, $j)) {
                        $p = $this->game->getPlayer($i, $j);
                        //$img = $this->game->getImg($p);
                        //$img = $p->getPieceImg();
                        $html .= '<div class="cell">';
                        //$html .= "<button type=\"submit\" name=\"cell\" value=\"$i, $j\">";
                        if ($p->getPlayerId() == Player::MCC_ID) {
                            $html .= "<img class=\"player-piece\" src=\"images/mccullen-piece.png\">";
                        } else if ($p->getPlayerId() == Player::OWE_ID) {
                            $html .= "<img class=\"player-piece\" src=\"images/owen-piece.png\">";
                        } else if ($p->getPlayerId() == Player::ONS_ID) {
                            $html .= "<img class=\"player-piece\" src=\"images/onsay-piece.png\">";
                        } else if ($p->getPlayerId() == Player::ENB_ID) {
                            $html .= "<img class=\"player-piece\" src=\"images/enbody-piece.png\">";
                        } else if ($p->getPlayerId() == Player::PLU_ID) {
                            $html .= "<img class=\"player-piece\" src=\"images/plum-piece.png\">";
                        } else if ($p->getPlayerId() == Player::DAY_ID) {
                            $html .= "<img class=\"player-piece\" src=\"images/day-piece.png\">";
                        }
                        $html .= '</div>';
                    } else {
                        $html .= '<div class="cell">';
                        $html .= '</div>';
                    }

                }
                $html .= '</div>';

            }
            //$html .= "<div>dist: $dist</div>";
        }
        return $html;
    }

    public function display_board3()
    {
        $html = "";
        $frozen = $this->game->getFrozen();
        if ($this->game->getMurdOpt()) {
            $pUp = $this->game->getPlayerUp();
            $c = $pUp->getCol();
            $r = $pUp->getRow();

            $pN = $this->game->getNode($r, $c);
            // get player suggested or accused
            // then in forloop can just display accussed players head in first location
            // that is that same node as the one of the player who is up
            // making function in node to check if the nodes are the same
            // can also probably just add an if statement to checking if the player up and accussed/suggested player
            // are already in the same room
            // nevermind on node function can just call getType on both nodes and check if they are the same

            //$suggId = $this->game->getSuggestProfId();

            $sugg = $this->game->getSuggestProfPlayer();
            $suggId = $this->game->getSuggProfId();
            //$nT = $pN->getNodeType();

            //$grid = $this->game->getGrid();
            /*
            for ($i = 0; $i < 25; $i++) {
                for ($j = 0; $j < 24; $j++) {

                }
            }
            */
            $suggSet = false;
            for ($i = 0; $i < 25; $i++) {
                $html .= '<div class="row">';
                for ($j = 0; $j < 24; $j++) {
                    $n = $this->game->getNode($i, $j);

                    if ($n->getNodeType() == $pN->getNodeType()) {
                        if ((!$this->game->isPlayerAtPos($i, $j) && ($suggSet != true))) {
                            //check for player up not all players
                            $suggSet = true;
                            $html .= '<div class="cell">';
                            if (($suggId == Player::MCC_ID)) {
                                $html .= "<img class=\"player-piece\" src=\"images/mccullen-piece.png\">";
                            } else if (($suggId == Player::OWE_ID)) {
                                $html .= "<img class=\"player-piece\" src=\"images/owen-piece.png\">";
                            } else if (($suggId == Player::ONS_ID)) {
                                $html .= "<img class=\"player-piece\" src=\"images/onsay-piece.png\">";
                            } else if (($suggId == Player::ENB_ID)) {
                                $html .= "<img class=\"player-piece\" src=\"images/enbody-piece.png\">";
                            } else if (($suggId == Player::PLU_ID)) {
                                $html .= "<img class=\"player-piece\" src=\"images/plum-piece.png\">";
                            } else if (($suggId == Player::DAY_ID)) {
                                $html .= "<img class=\"player-piece\" src=\"images/day-piece.png\">";
                            }
                            $html .= '</div>';
                        } else if ($this->game->isPlayerAtPos($i, $j)) {
                            $p = $this->game->getPlayer($i, $j);
                            //$img = $this->game->getImg($p);
                            //$img = $p->getPieceImg();
                            //$nPN = $this->game->getNode($i, $j);

                            $html .= '<div class="cell">';
                            if (($p->getPlayerId() == Player::MCC_ID) && ($p->getPlayerId() != $suggId)) {
                                $html .= "<img class=\"player-piece\" src=\"images/mccullen-piece.png\">";
                            } else if (($p->getPlayerId() == Player::OWE_ID) && ($p->getPlayerId() != $suggId)) {
                                $html .= "<img class=\"player-piece\" src=\"images/owen-piece.png\">";
                            } else if (($p->getPlayerId() == Player::ONS_ID) && ($p->getPlayerId() != $suggId)) {
                                $html .= "<img class=\"player-piece\" src=\"images/onsay-piece.png\">";
                            } else if (($p->getPlayerId() == Player::ENB_ID) && ($p->getPlayerId() != $suggId)) {
                                $html .= "<img class=\"player-piece\" src=\"images/enbody-piece.png\">";
                            } else if (($p->getPlayerId() == Player::PLU_ID) && ($p->getPlayerId() != $suggId)) {
                                $html .= "<img class=\"player-piece\" src=\"images/plum-piece.png\">";
                            } else if (($p->getPlayerId() == Player::DAY_ID) && ($p->getPlayerId() != $suggId)) {
                                $html .= "<img class=\"player-piece\" src=\"images/day-piece.png\">";
                            }
                            $html .= '</div>';
                        } else {
                            $html .= '<div class="cell">';
                            $html .= '</div>';
                        }
                    } else if ($this->game->isPlayerAtPos($i, $j)) {
                        $p = $this->game->getPlayer($i, $j);
                        //$img = $this->game->getImg($p);
                        //$img = $p->getPieceImg();
                        //$nPN = $this->game->getNode($i, $j);

                        $html .= '<div class="cell">';
                        if (($p->getPlayerId() == Player::MCC_ID) && ($p->getPlayerId() != $suggId)) {
                            $html .= "<img class=\"player-piece\" src=\"images/mccullen-piece.png\">";
                        } else if (($p->getPlayerId() == Player::OWE_ID) && ($p->getPlayerId() != $suggId)) {
                            $html .= "<img class=\"player-piece\" src=\"images/owen-piece.png\">";
                        } else if (($p->getPlayerId() == Player::ONS_ID) && ($p->getPlayerId() != $suggId)) {
                            $html .= "<img class=\"player-piece\" src=\"images/onsay-piece.png\">";
                        } else if (($p->getPlayerId() == Player::ENB_ID) && ($p->getPlayerId() != $suggId)) {
                            $html .= "<img class=\"player-piece\" src=\"images/enbody-piece.png\">";
                        } else if (($p->getPlayerId() == Player::PLU_ID) && ($p->getPlayerId() != $suggId)) {
                            $html .= "<img class=\"player-piece\" src=\"images/plum-piece.png\">";
                        } else if (($p->getPlayerId() == Player::DAY_ID) && ($p->getPlayerId() != $suggId)) {
                            $html .= "<img class=\"player-piece\" src=\"images/day-piece.png\">";
                        }
                        $html .= '</div>';
                    } else {
                        $html .= '<div class="cell">';
                        $html .= '</div>';
                    }
                }
                $html .= '</div>';

            }
        }
//        else if($this->game->getMurderOpt()) {
//            $pUp = $this->game->getPlayerUp();
//            $c = $pUp->getCol();
//            $r = $pUp->getRow();
//
//            $pN = $this->game->getNode($r, $c);
//            // get player suggested or accused
//            // then in forloop can just display accussed players head in first location
//            // that is that same node as the one of the player who is up
//            // making function in node to check if the nodes are the same
//            // can also probably just add an if statement to checking if the player up and accussed/suggested player
//            // are already in the same room
//            // nevermind on node function can just call getType on both nodes and check if they are the same
//
//            //$murd = $this->game->getMurdPlayer();
//            //$nT = $pN->getNodeType();
//
//            //$grid = $this->game->getGrid();
//            //$murdSet = true;
//            for ($i = 0; $i < 25; $i++) {
//                $html .= '<div class="row">';
//                for ($j = 0; $j < 24; $j++) {
//                    $n = $this->game->getNode($i, $j);
//
//                    if($n->getNodeType() == $pN->getNodeType()) {
//                        if(($i != $pN->getRow()) || ($j != $pN->getNodeCol())) {
//                            $html .= '<div class="cell">';
//                            if (($p->getPlayerId() == Player::MCC_ID) && ($p->getPlayerId() != $pN->getPlayerId())) {
//                                $html .= "<img class=\"player-piece\" src=\"images/mccullen-piece.png\">";
//                            } else if (($p->getPlayerId() == Player::OWE_ID) && ($p->getPlayerId() != $pN->getPlayerId())) {
//                                $html .= "<img class=\"player-piece\" src=\"images/owen-piece.png\">";
//                            } else if (($p->getPlayerId() == Player::ONS_ID) && ($p->getPlayerId() != $pN->getPlayerId())) {
//                                $html .= "<img class=\"player-piece\" src=\"images/onsay-piece.png\">";
//                            } else if (($p->getPlayerId() == Player::ENB_ID) && ($p->getPlayerId() != $pN->getPlayerId())) {
//                                $html .= "<img class=\"player-piece\" src=\"images/enbody-piece.png\">";
//                            } else if (($p->getPlayerId() == Player::PLU_ID) && ($p->getPlayerId() != $pN->getPlayerId())) {
//                                $html .= "<img class=\"player-piece\" src=\"images/plum-piece.png\">";
//                            } else if (($p->getPlayerId() == Player::DAY_ID) && ($p->getPlayerId() != $pN->getPlayerId())) {
//                                $html .= "<img class=\"player-piece\" src=\"images/day-piece.png\">";
//                            }
//                            $html .= '</div>';
//                        }
//                    }
//                    else if ($this->game->isPlayerAtPos($i, $j)) {
//                        $p = $this->game->getPlayer($i, $j);
//                        //$img = $this->game->getImg($p);
//                        //$img = $p->getPieceImg();
//                        //$nPN = $this->game->getNode($i, $j);
//
//                        $html .= '<div class="cell">';
//                        if (($p->getPlayerId() == Player::MCC_ID) && ($p->getPlayerId() != $pN->getPlayerId())) {
//                            $html .= "<img class=\"player-piece\" src=\"images/mccullen-piece.png\">";
//                        } else if (($p->getPlayerId() == Player::OWE_ID) && ($p->getPlayerId() != $pN->getPlayerId())) {
//                            $html .= "<img class=\"player-piece\" src=\"images/owen-piece.png\">";
//                        } else if (($p->getPlayerId() == Player::ONS_ID) && ($p->getPlayerId() != $pN->getPlayerId())) {
//                            $html .= "<img class=\"player-piece\" src=\"images/onsay-piece.png\">";
//                        } else if (($p->getPlayerId() == Player::ENB_ID) && ($p->getPlayerId() != $pN->getPlayerId())) {
//                            $html .= "<img class=\"player-piece\" src=\"images/enbody-piece.png\">";
//                        } else if (($p->getPlayerId() == Player::PLU_ID) && ($p->getPlayerId() != $pN->getPlayerId())) {
//                            $html .= "<img class=\"player-piece\" src=\"images/plum-piece.png\">";
//                        } else if (($p->getPlayerId() == Player::DAY_ID) && ($p->getPlayerId() != $pN->getPlayerId())) {
//                            $html .= "<img class=\"player-piece\" src=\"images/day-piece.png\">";
//                        }
//                        $html .= '</div>';
//                    } else {
//                        $html .= '<div class="cell">';
//                        $html .= '</div>';
//                    }
//                }
//                $html .= '</div>';
//
//            }
//
//        }
        return $html;
    }


    public function display()
    {
        if ($this->game->get_display_winner()) {
            if ($this->game->getNumAccused() >= 0) {
                return $this->displayWinner();
            } else {
                return $this->displayLoser();
            }
        }

        if (!$this->isCurrentPlayer) {
            return $this->display_dice();
        }
        if ($this->game->getPlayOpt()) {
            return $this->playerOptions();
        } else if ($this->game->getSuggOpt()) {
            return $this->suggestOptions();
        } else if ($this->game->getMurdOpt()) {
            return $this->murderOptions();
        } else if ($this->game->getWordOpt()) {
            return $this->wordOnTheStreet();
        } else if ($this->game->get_display_winner()) {
            if ($this->game->getNumAccused() >= 0) {
                return $this->displayWinner();
            } else {
                return $this->displayLoser();
            }
        } else {
            return $this->display_dice();
        }
    }

    public function displayWinner()
    {
        $html = "";
        $winner = $this->game->getWinner();
        $html .= <<<HTML
<p>Accusation is correct!</p>
<p>Prof $winner wins!</p>
<!--<form class="radButtons" method="post" action="index.php">-->
<!--    <p><input type="submit" name="ng" value="New Game"></p>-->
<!--</form>-->
HTML;
        return $html;
    }

    public function displayLoser()
    {
        $html = "";
        $html .= <<<HTML
<p>Everybody has run out of accusations!</p>
<p>Everybody loses!</p>
<!--<form class="radButtons" method="post" action="index.php">-->
<!--    <p><input type="submit" name="ng" value="New Game"></p>-->
<!--</form>-->
HTML;
        return $html;
    }

    public function playerOptions()
    {
        $html = "";
        $html .= <<<HTML
<div class="box">
    <div class="box red"></div>
        <div class="inputField" style="block"> 
            <p>What do you wish to do?</p>
            <form class="radButtons" method="post" action="game-post.php">
                <p><label class="block"><input type="radio" id="Pass" checked="checked" name="psaa" value="Pass">Pass</label></p>
                <br>
                <p><label class="block"><input type="radio" id="Suggest" name="psaa" value="Suggest">Suggest</label></p>
                <br>
                <p><label class="block"><input type="radio" id="Accuse" name="psaa" value="Accuse">Accuse</label></p>
                <br>
                <p class="goButton"><input type="submit" name="psa"  value="Go"></p>
            </form>
            
        </div> 
        
    </div>
</div>
HTML;
        return $html;
    }

    public function suggestOptions()
    {
        $html = "";
        $html .= <<<HTML
<div class="box">
    <div class="box red"></div>
        <div class="inputField" style="block"> 
            <p>What done it?</p>
            <form class="radButtons" method="post" action="game-post.php">
                <label class="block"><input type="radio" name="radgroup" checked="checked" value="Prof. Owen">Prof. Owen</label>
                <br>
                <label class="block"><input type="radio" name="radgroup" value="Prof. McCullen">Prof. McCullen</label>
                <br>
                <label class="block"><input type="radio" name="radgroup" value="Prof. Onsay">Prof. Onsay</label>
                <br>
                <label class="block"><input type="radio" name="radgroup" value="Prof. Enbody">Prof. Enbody</label>
                <br>
                <label class="block"><input type="radio" name="radgroup" value="Prof. Plum">Prof. Plum</label>
                <br>
                <label class="block"><input type="radio" name="radgroup" value="Prof. Day">Prof. Day</label>
                <p class="goButton"><input type="submit" name="suggestProf"  value="Go"></p>
            </form>
        </div> 
        
    </div>
</div>
HTML;

        return $html;
    }

    public function murderOptions()
    {
        $html = "";
        $html .= <<<HTML
<div class="box">
    <div class="box red"></div>
        <div class="inputField" style="block">
            <p>With what?</p> 
            <form class="radButtons" method="post" action="game-post.php"><br>
                    <label class="block"><input type="radio" name="radgroup" checked="checked" value="Final Exam">Final Exam</label><br>
                    <label class="block"><input type="radio" name="radgroup" value="Midterm Exam">Midterm Exam</label><br>
                    <label class="block"><input type="radio" name="radgroup" value="Programming Assignment">Programming Assignment</label><br>
                    <label class="block"><input type="radio" name="radgroup" value="Project">Project</label><br>
                    <label class="block"><input type="radio" name="radgroup" value="Written Assignment">Written Assignment</label><br>
                    <label class="block"><input type="radio" name="radgroup" value="Quiz">Quiz</label><br>
                    <p class="goButton"><input type="submit" name="suggestWeapon"  value="Go"></p>
            </form>
        </div> 
        
    </div>
</div>
HTML;
        return $html;
    }

    public function wordOnTheStreet()
    {
        $html = "";

        $s = $this->game->getNewWord();

        $html .= <<<HTML
<div class="box">
    <div class="box red"></div>
        <div class="inputField" style="block">
            <p>Word on the street is: </p>
            <br>
            <p>$s</p>
        </div> 
        <form class="radButtons" method="post" action="game-post.php">
            <p class="goButton"><input type="submit" name="gotWord"  value="Go"></p>
        </form>

    </div>
</div>
HTML;
        return $html;
    }


    public function isCurrent(){
        if ($this->isCurrentPlayer) {
            return "";
        }
        return "not";
    }

    public function getCurrent(){
        return $this->isCurrentPlayer;
    }


}
