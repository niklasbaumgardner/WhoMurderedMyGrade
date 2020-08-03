<?php


namespace Game;


class Player
{
    public $userID;
    public $playerID;
    public $playerChar;
    public $playerCards;
    public $pos;
    public $madeAccusation;
    public $col;
    public $row;
    public $playImg;
    public $pieceImg;

    /* Const Variables */
    const ENBODY_IMG = "enbody.jpg";
    const MCCULLEN_IMG = "mccullen.jpg";
    const ONSAY_IMG = "onsay.jpg";
    const OWEN_IMG = "owen.jpg";
    const PLUM_IMG = "plum.jpg";
    const DAY_IMG = "day.jpg";

    const ENBODY_PIECE = "images/enbody-piece.png";
    const MCCULLEN_PIECE = "images/mccullen-piece.png";
    const ONSAY_PIECE = "images/onsay-piece.png";
    const OWEN_PIECE = "images/owen-piece.png";
    const PLUM_PIECE = "images/plum-piece.png";
    const DAY_PIECE = "images/day-piece.png";

    // player id's
    const NONE_ID = 0;
    const OWE_ID = 1;
    const MCC_ID = 2;
    const ONS_ID = 3;
    const ENB_ID = 4;
    const PLU_ID = 5;
    const DAY_ID = 6;

    public $hasAccused = false;

    const OWEN_NAME = "Prof. Owen";
    const MCCULLEN_NAME = "Prof. McCullen";
    const ONSAY_NAME = "Prof. Onsay";
    const ENBODY_NAME = "Prof. Enbody";
    const PLUM_NAME = "Prof. Plum";
    const DAY_NAME = "Prof. Day";


    //public function __construct($playerID, $playerChar = "",$playerCards, $pos, $madeAccusation)
    public function __construct($playerID, $playerChar) {
        /*
         * playerChar is a string
         */

        $this->hasAccused = false;

        $this->playerID = $playerID;
        $this->playerChar = $playerChar;
        $this->playerCards = [];
        $this->pos = 0;
        $this->madeAccusation = false;

        if($playerID == self::MCC_ID){
            $this->playImg = self::MCCULLEN_IMG;
            $this->pieceImg = self::MCCULLEN_PIECE;
        }
        else if($playerID == self::OWE_ID){
            $this->playImg = self::OWEN_IMG;
            $this->pieceImg = self::OWEN_PIECE;
        }
        else if($playerID == self::DAY_ID){
            $this->playImg = self::DAY_IMG;
            $this->pieceImg = self::DAY_PIECE;
        }
        else if($playerID == self::ONS_ID){
            $this->playImg = self::ONSAY_IMG;
            $this->pieceImg = self::ONSAY_PIECE;
        }
        else if($playerID == self::PLU_ID){
            $this->playImg = self::PLUM_IMG;
            $this->pieceImg = self::PLUM_PIECE;
        }
        else if($playerID == self::ENB_ID){
            $this->playImg = self::ENBODY_IMG;
            $this->pieceImg = self::ENBODY_PIECE;
        }
    }

    /*
        Call this function from Game after the players are chosen.
    */
    public function deal($hand) {
        # hand is an array of strings, those being the names of the cards in the player's hand.
        # words will eventually be determined by some file with a wordlist, but until then, I'll use this id system.

        # TODO: implement real words

        $keys = array_keys(Cards::CARD_INFO);
//        shuffle($keys);
//        for ($i = 0; $i < Cards::CARD_NUM; $i ++) {
//            if (!in_array($keys[$i], $hand)) {
//                $wordList[$keys[$i]] = strval($this->playerID) . " " . strval($i);
//            }
//        }
        //print(array_keys($wordList)[0]);
        $this->playerCards = new Cards($hand);
    }

         /*
         * These are the getters for the variables
         */
    public function getPlayerId()
    {
        return $this->playerID;
    }

    public function getPlayerChar(){
        return $this->playerChar;
    }

    public function set_player_cards($temp) {
        $this->playerCards = $temp;
    }

    public function getPlayerCards(){
        return $this->playerCards;
    }

    public function getPos(){
        return $this->pos;
    }

    public function getAccusation(){
        return $this->madeAccusation;
    }

    public function show_cards() {
        //$html = "<div class=\"cards\"";
        $html = "";
        print("got here");
        foreach ($this->playerCards as $card) {
            $image = $card->getImage();
            $name = $card->getName();
            $word = $card->getWord();
            print($word);
            $html .= <<<HTML
<p><img src="images/$image" alt="$name"></p>
HTML;

        }
        //$html .= "</div>";
        return $html;
    }


    public function getCol(){
        return $this->col;
    }

    public function setCol($c) {
        $this->col = $c;
    }

    public function getRow() {
        return $this->row;
    }

    public function setRow($r) {
        $this->row = $r;
    }

    public function getPlayImg() {
        return $this->playImg;
    }

    public function getPieceImg() {
        return $this->pieceImg;
    }

    public function getHasAccused(){
        return $this->hasAccused;
    }

    public function setHasAccused($h) {
        $this->hasAccused = $h;
    }

    public function getUserID(){
        return $this->userID;
    }

    public function setUserID($h) {
        $this->userID = $h;
    }
}