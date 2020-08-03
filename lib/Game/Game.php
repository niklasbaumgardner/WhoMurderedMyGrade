<?php

namespace Game;

class Game
{

    const NONE_ID = 0;
    const OWE_ID = 1;
    const MCC_ID = 2;
    const ONS_ID = 3;
    const ENB_ID = 4;
    const PLU_ID = 5;
    const DAY_ID = 6;
    const REGULAR_NODE = 7;
    const START_NODE = 8;
    //const INNER_ROOM_NODE = 3;
    //const ENTRY_ROOM_NODE = 4;
    const INTERNATIONAL = 9;
    const BRESLIN = 10;
    const BEAUMONT = 11;
    const UNION = 12;
    const MUSEUM = 13;
    const LIBRARY = 14;
    const WHARTON = 15;
    const STADIUM = 16;
    const ENGINEERING = 17;
    const BAD_NODE = 18;


    private $diceImg1;
    private $diceImg2;
    private $players = [];
    private $cards_displayed = [];
    private $cards = [];
    private $suspects = [];
    private $locations = [];
    private $weapons = [];

    private $murderer;
    private $murder_weapon;
    private $murder_location;

    private $winner = "";

    private $suggestedProf;
    private $suggestedProfPlayer;
    PRIVATE $suggProfId;
    private $suggestedWeapon;
    private $wordOpt;
    private $newWord;

    private $gameID;

    // player whose turn it is, index in the array
    private $playerUpInd = 0;

    // how many moves there are
    private $totalNumMoves = 0;
    // dice 1's roll
    private $dice1Num;
    // dice 2's roll
    private $dice2Num;

    private $grid;

    private $playOpt = false;
    private $suggOpt = false;
    private $murdOpt = false;

    private $frozen = false;

    private $display_winner = false;

    private $numAccused;


    public function __construct() {
        $this->playOpt = false;
        $this->suggOpt = false;
        $this->murdOpt = false;

        $this->frozen = false;


        // start nodes
        $nMcc = new Node(9, 0,self::START_NODE);
        $nOwe = new Node(14, 0, self::START_NODE);
        $nDay = new Node(23, 7, self::START_NODE);
        $nOns = new Node(0, 17, self::START_NODE);
        $nEnb = new Node(23, 19, self::START_NODE);
        $nPlu = new Node(7, 24, self::START_NODE);

        // International center node
        $nInt = new Node(3, 5, self::INTERNATIONAL);

        // breslin center node
        $nBre = new Node(11, 6, self::BRESLIN);

        // beaumont tower node
        $nBea = new Node(18, 4, self::BEAUMONT);

        // Union node
        $nUni = new Node(5, 12, self::UNION);

        // art museum node
        $nMus = new Node(21, 10, self::MUSEUM);

        // Library node
        $nLib = new Node(20, 16, self::LIBRARY);

        // wharton center node
        $nWha = new Node(3, 22, self::WHARTON);

        // spartan stadium node
        $nSta = new Node(11, 21, self::STADIUM);

        // engineering building node
        $nEng = new Node(20, 23, self::ENGINEERING);

        //$nRC = new Node(, , self::REGULAR_NODE);
        $nR1C7 = new Node(7, 1, self::REGULAR_NODE);
        $nR1C8 = new Node(8, 1, self::REGULAR_NODE);
        $nR1C9 = new Node(9, 1, self::REGULAR_NODE);
        $nR1C14 = new Node(14, 1, self::REGULAR_NODE);
        $nR1C15 = new Node(15, 1, self::REGULAR_NODE);
        $nR1C16 = new Node(16, 1, self::REGULAR_NODE);

        //$nR2C = new Node(, 2, self::REGULAR_NODE);
        $nR2C6 = new Node(6, 2, self::REGULAR_NODE);
        $nR2C7 = new Node(7, 2, self::REGULAR_NODE);
        $nR2C16 = new Node(16, 2, self::REGULAR_NODE);
        $nR2C17 = new Node(17, 2, self::REGULAR_NODE);

        //$nR3C = new Node(, 3, self::REGULAR_NODE);
        $nR3C6 = new Node(6, 3, self::REGULAR_NODE);
        $nR3C7 = new Node(7, 3, self::REGULAR_NODE);
        $nR3C16 = new Node(16, 3, self::REGULAR_NODE);
        $nR3C17 = new Node(17, 3, self::REGULAR_NODE);

        //$nR4C = new Node(, 4, self::REGULAR_NODE);
        $nR4C6 = new Node(6, 4, self::REGULAR_NODE);
        $nR4C7 = new Node(7, 4, self::REGULAR_NODE);
        $nR4C16 = new Node(16, 4, self::REGULAR_NODE);
        $nR4C17 = new Node(17, 4, self::REGULAR_NODE);

        // $nR5C = new Node(, 5, self::REGULAR_NODE);
        $nR5C6 = new Node(6, 5, self::REGULAR_NODE);
        $nR5C7 = new Node(7, 5, self::REGULAR_NODE);
        $nR5C16 = new Node(16, 5, self::REGULAR_NODE);
        $nR5C17 = new Node(17, 5, self::REGULAR_NODE);

        // $nR6C = new Node(, 6, self::REGULAR_NODE);
        $nR6C6 = new Node(6, 6, self::REGULAR_NODE);
        $nR6C7 = new Node(7, 6, self::REGULAR_NODE);
        $nR6C16 = new Node(16, 6, self::REGULAR_NODE);
        $nR6C17 = new Node(17, 6, self::REGULAR_NODE);
        $nR6C18 = new Node(18, 6, self::REGULAR_NODE);
        $nR6C19 = new Node(19, 6, self::REGULAR_NODE);
        $nR6C20 = new Node(20, 6, self::REGULAR_NODE);
        $nR6C21 = new Node(21, 6, self::REGULAR_NODE);
        $nR6C22 = new Node(22, 6, self::REGULAR_NODE);

        // $nR7C = new Node(, 7, self::REGULAR_NODE);
        $nR7C0 = new Node(0, 7, self::REGULAR_NODE);
        $nR7C1 = new Node(1, 7, self::REGULAR_NODE);
        $nR7C2 = new Node(2, 7, self::REGULAR_NODE);
        $nR7C3 = new Node(3, 7, self::REGULAR_NODE);
        $nR7C4 = new Node(4, 7, self::REGULAR_NODE);
        $nR7C5 = new Node(5, 7, self::REGULAR_NODE);
        $nR7C6 = new Node(6, 7, self::REGULAR_NODE);
        $nR7C7 = new Node(7, 7, self::REGULAR_NODE);
        $nR7C16 = new Node(16, 7, self::REGULAR_NODE);
        $nR7C17 = new Node(17, 7, self::REGULAR_NODE);
        $nR7C18 = new Node(18, 7, self::REGULAR_NODE);
        $nR7C19 = new Node(19, 7, self::REGULAR_NODE);
        $nR7C20 = new Node(20, 7, self::REGULAR_NODE);
        $nR7C21 = new Node(21, 7, self::REGULAR_NODE);
        $nR7C22 = new Node(22, 7, self::REGULAR_NODE);

        //$nR8C = new Node(, 8, self::REGULAR_NODE);
        $nR8C1 = new Node(1, 8, self::REGULAR_NODE);
        $nR8C2 = new Node(2, 8, self::REGULAR_NODE);
        $nR8C3 = new Node(3, 8, self::REGULAR_NODE);
        $nR8C4 = new Node(4, 8, self::REGULAR_NODE);
        $nR8C5 = new Node(5, 8, self::REGULAR_NODE);
        $nR8C6 = new Node(6, 8, self::REGULAR_NODE);
        $nR8C7 = new Node(7, 8, self::REGULAR_NODE);
        $nR8C8 = new Node(8, 8, self::REGULAR_NODE);
        $nR8C9 = new Node(9, 8, self::REGULAR_NODE);
        $nR8C10 = new Node(10, 8, self::REGULAR_NODE);
        $nR8C11 = new Node(11, 8, self::REGULAR_NODE);
        $nR8C12 = new Node(12, 8, self::REGULAR_NODE);
        $nR8C13 = new Node(13, 8, self::REGULAR_NODE);
        $nR8C14 = new Node(14, 8, self::REGULAR_NODE);
        $nR8C15 = new Node(15, 8, self::REGULAR_NODE);
        $nR8C16 = new Node(16, 8, self::REGULAR_NODE);
        $nR8C17 = new Node(17, 8, self::REGULAR_NODE);

        // $nR9C = new Node(, 9, self::REGULAR_NODE);
        $nR9C5 = new Node(5, 9, self::REGULAR_NODE);
        $nR9C6 = new Node(6, 9, self::REGULAR_NODE);
        $nR9C7 = new Node(7, 9, self::REGULAR_NODE);
        $nR9C8 = new Node(8, 9, self::REGULAR_NODE);
        $nR9C9 = new Node(9, 9, self::REGULAR_NODE);
        $nR9C10 = new Node(10, 9, self::REGULAR_NODE);
        $nR9C11 = new Node(11, 9, self::REGULAR_NODE);
        $nR9C12 = new Node(12, 9, self::REGULAR_NODE);
        $nR9C13 = new Node(13, 9, self::REGULAR_NODE);
        $nR9C14 = new Node(14, 9, self::REGULAR_NODE);
        $nR9C15 = new Node(15, 9, self::REGULAR_NODE);
        $nR9C16 = new Node(16, 9, self::REGULAR_NODE);
        $nR9C17 = new Node(17, 9, self::REGULAR_NODE);

        // $nR10C = new Node(, 10, self::REGULAR_NODE);
        $nR10C8 = new Node(8, 10, self::REGULAR_NODE);
        $nR10C9 = new Node(9, 10, self::REGULAR_NODE);
        $nR10C15 = new Node(15, 10, self::REGULAR_NODE);
        $nR10C16 = new Node(16, 10, self::REGULAR_NODE);
        $nR10C17 = new Node(17, 10, self::REGULAR_NODE);

        //$nR11C = new Node(, 11, self::REGULAR_NODE);
        $nR11C8 = new Node(8, 11, self::REGULAR_NODE);
        $nR11C9 = new Node(9, 11, self::REGULAR_NODE);
        $nR11C15 = new Node(15, 11, self::REGULAR_NODE);
        $nR11C16 = new Node(16, 11, self::REGULAR_NODE);
        $nR11C17 = new Node(17, 11, self::REGULAR_NODE);

        //$nR12C = new Node(, 12, self::REGULAR_NODE);
        $nR12C8 = new Node(8, 12, self::REGULAR_NODE);
        $nR12C9 = new Node(9, 12, self::REGULAR_NODE);
        $nR12C15 = new Node(15, 12, self::REGULAR_NODE);
        $nR12C16 = new Node(16, 12, self::REGULAR_NODE);
        $nR12C17 = new Node(17, 12, self::REGULAR_NODE);

        /*
        //$nR1C = new Node(, 1, self::REGULAR_NODE);
        $nR1C8 = new Node(8, 1, self::REGULAR_NODE);
        $nR1C9 = new Node(9, 1, self::REGULAR_NODE);
        $nR1C15 = new Node(15, 1, self::REGULAR_NODE);
        $nR1C16 = new Node(16, 1, self::REGULAR_NODE);
        */

        //$nR13C = new Node(, 13, self::REGULAR_NODE);
        $nR13C8 = new Node(8, 13, self::REGULAR_NODE);
        $nR13C9 = new Node(9, 13, self::REGULAR_NODE);
        $nR13C15 = new Node(15, 13, self::REGULAR_NODE);
        $nR13C16 = new Node(16, 13, self::REGULAR_NODE);
        $nR13C17 = new Node(17, 13, self::REGULAR_NODE);
        $nR13C18 = new Node(18, 13, self::REGULAR_NODE);
        $nR13C19 = new Node(19, 13, self::REGULAR_NODE);
        $nR13C20 = new Node(20, 13, self::REGULAR_NODE);
        $nR13C21 = new Node(21, 13, self::REGULAR_NODE);
        $nR13C22 = new Node(22, 13, self::REGULAR_NODE);

        //$nR14C = new Node(, 14, self::REGULAR_NODE);
        $nR14C8 = new Node(8, 14, self::REGULAR_NODE);
        $nR14C9 = new Node(9, 14, self::REGULAR_NODE);
        $nR14C15 = new Node(15, 14, self::REGULAR_NODE);
        $nR14C16 = new Node(16, 14, self::REGULAR_NODE);
        $nR14C17 = new Node(17, 14, self::REGULAR_NODE);

        //$nR15C = new Node(, 15, self::REGULAR_NODE);
        $nR15C8 = new Node(8, 15, self::REGULAR_NODE);
        $nR15C9 = new Node(9, 15, self::REGULAR_NODE);
        $nR15C15 = new Node(15, 15, self::REGULAR_NODE);
        $nR15C16 = new Node(16, 15, self::REGULAR_NODE);

        //$nR16C = new Node(, 16, self::REGULAR_NODE);
        $nR16C1 = new Node(1, 16, self::REGULAR_NODE);
        $nR16C2 = new Node(2, 16, self::REGULAR_NODE);
        $nR16C3 = new Node(3, 16, self::REGULAR_NODE);
        $nR16C4 = new Node(4, 16, self::REGULAR_NODE);
        $nR16C5 = new Node(5, 16, self::REGULAR_NODE);
        $nR16C6 = new Node(6, 16, self::REGULAR_NODE);
        $nR16C7 = new Node(7, 16, self::REGULAR_NODE);
        $nR16C8 = new Node(8, 16, self::REGULAR_NODE);
        $nR16C9 = new Node(9, 16, self::REGULAR_NODE);
        $nR16C15 = new Node(15, 16, self::REGULAR_NODE);
        $nR16C16 = new Node(16, 16, self::REGULAR_NODE);

        //$nR17C = new Node(, 17, self::REGULAR_NODE);
        $nR17C1 = new Node(1, 17, self::REGULAR_NODE);
        $nR17C2 = new Node(2, 17, self::REGULAR_NODE);
        $nR17C3 = new Node(3, 17, self::REGULAR_NODE);
        $nR17C4 = new Node(4, 17, self::REGULAR_NODE);
        $nR17C5 = new Node(5, 17, self::REGULAR_NODE);
        $nR17C6 = new Node(6, 17, self::REGULAR_NODE);
        $nR17C7 = new Node(7, 17, self::REGULAR_NODE);
        $nR17C8 = new Node(8, 17, self::REGULAR_NODE);
        $nR17C9 = new Node(9, 17, self::REGULAR_NODE);
        $nR17C10 = new Node(10, 17, self::REGULAR_NODE);
        $nR17C11 = new Node(11, 17, self::REGULAR_NODE);
        $nR17C12 = new Node(12, 17, self::REGULAR_NODE);
        $nR17C13 = new Node(13, 17, self::REGULAR_NODE);
        $nR17C14 = new Node(14, 17, self::REGULAR_NODE);
        $nR17C15 = new Node(15, 17, self::REGULAR_NODE);
        $nR17C16 = new Node(16, 17, self::REGULAR_NODE);

        //$nR18C = new Node(, 18, self::REGULAR_NODE);
        $nR18C1 = new Node(1, 18, self::REGULAR_NODE);
        $nR18C2 = new Node(2, 18, self::REGULAR_NODE);
        $nR18C3 = new Node(3, 18, self::REGULAR_NODE);
        $nR18C4 = new Node(4, 18, self::REGULAR_NODE);
        $nR18C5 = new Node(5, 18, self::REGULAR_NODE);
        $nR18C6 = new Node(6, 18, self::REGULAR_NODE);
        $nR18C7 = new Node(7, 18, self::REGULAR_NODE);
        $nR18C8 = new Node(8, 18, self::REGULAR_NODE);
        $nR18C15 = new Node(15, 18, self::REGULAR_NODE);
        $nR18C16 = new Node(16, 18, self::REGULAR_NODE);
        $nR18C17 = new Node(17, 18, self::REGULAR_NODE);

        //$nR19C = new Node(, 19, self::REGULAR_NODE);
        $nR19C7 = new Node(7, 19, self::REGULAR_NODE);
        $nR19C8 = new Node(8, 19, self::REGULAR_NODE);
        $nR19C15 = new Node(15, 19, self::REGULAR_NODE);
        $nR19C16 = new Node(16, 19, self::REGULAR_NODE);
        $nR19C17 = new Node(17, 19, self::REGULAR_NODE);
        $nR19C18 = new Node(18, 19, self::REGULAR_NODE);
        $nR19C19 = new Node(19, 19, self::REGULAR_NODE);
        $nR19C20 = new Node(20, 19, self::REGULAR_NODE);
        $nR19C21 = new Node(21, 19, self::REGULAR_NODE);
        $nR19C22 = new Node(22, 19, self::REGULAR_NODE);

        /*
        //$nR2C = new Node(, 2, self::REGULAR_NODE);
        $nR2C7 = new Node(7, 2, self::REGULAR_NODE);
        $nR2C8 = new Node(8, 2, self::REGULAR_NODE);
        $nR2C15 = new Node(15, 2, self::REGULAR_NODE);
        $nR2C16 = new Node(16, 2, self::REGULAR_NODE);
        */

        //$nR20C = new Node(, 20, self::REGULAR_NODE);
        $nR20C7 = new Node(7, 20, self::REGULAR_NODE);
        $nR20C8 = new Node(8, 20, self::REGULAR_NODE);
        $nR20C15 = new Node(15, 20, self::REGULAR_NODE);
        $nR20C16 = new Node(16, 20, self::REGULAR_NODE);
        $nR20C17 = new Node(17, 20, self::REGULAR_NODE);
        $nR20C18 = new Node(18, 20, self::REGULAR_NODE);
        $nR20C19 = new Node(19, 20, self::REGULAR_NODE);
        $nR20C20 = new Node(20, 20, self::REGULAR_NODE);
        $nR20C21 = new Node(21, 20, self::REGULAR_NODE);
        $nR20C22 = new Node(22, 20, self::REGULAR_NODE);

        //$nR21C = new Node(, 21, self::REGULAR_NODE);
        $nR21C7 = new Node(7, 21, self::REGULAR_NODE);
        $nR21C8 = new Node(8, 21, self::REGULAR_NODE);
        $nR21C15 = new Node(15, 21, self::REGULAR_NODE);
        $nR21C16 = new Node(16, 21, self::REGULAR_NODE);

        //$nR22C = new Node(, 22, self::REGULAR_NODE);
        $nR22C7 = new Node(7, 22, self::REGULAR_NODE);
        $nR22C8 = new Node(8, 22, self::REGULAR_NODE);
        $nR22C15 = new Node(15, 22, self::REGULAR_NODE);
        $nR22C16 = new Node(16, 22, self::REGULAR_NODE);

        //$nR23C = new Node(, 23, self::REGULAR_NODE);
        $nR23C7 = new Node(7, 23, self::REGULAR_NODE);
        $nR23C8 = new Node(8, 23, self::REGULAR_NODE);
        $nR23C15 = new Node(15, 23, self::REGULAR_NODE);
        $nR23C16 = new Node(16, 23, self::REGULAR_NODE);

        //$nR24C = new Node(, 24, self::REGULAR_NODE);
        $nR24C16 = new Node(16, 24, self::REGULAR_NODE);

        //Start to add eachother as adjecencies
        // array($nRC)
        // $nRC->addTo(array($nRC));
        // $nRC->addTo($nRC);

        /// $nR1C->addTo(array($nR1C));
        //$nR1C7->addTo(array($nR1C8, $nR2C7));
        $nR1C7->addTo($nR1C8);
        $nR1C7->addTo($nR2C7);
        //$nR1C8->addTo(array($nR1C7, $nR1C9));
        $nR1C8->addTo($nR1C7);
        $nR1C8->addTo($nR1C9);
        //$nR1C9->addTo(array($nR1C8));
        $nR1C9->addTo($nR1C8);
        //$nR1C14->addTo(array($nR1C15));
        $nR1C14->addTo($nR1C15);
        //$nR1C15->addTo(array($nR1C14, $nR1C16));
        $nR1C15->addTo($nR1C14);
        $nR1C15->addTo($nR1C16);
        //$nR1C16->addTo(array($nR1C15, $nR2C16));
        $nR1C16->addTo($nR1C15);
        $nR1C16->addTo($nR2C16);

        /// $nR2C->addTo(array($nR2C));
        /// $nR2C->addTo($nRC);
        //$nR2C6->addTo(array($nR2C7, $nR3C6));
        $nR2C6->addTo($nR2C7);
        $nR2C6->addTo($nR3C6);
        //$nR2C7->addTo(array($nR2C6, $nR1C7, $nR3C7));
        $nR2C7->addTo($nR2C6);
        $nR2C7->addTo($nR1C7);
        $nR2C7->addTo($nR3C7);
        //$nR2C16->addTo(array($nR1C16, $nR2C17, $nR3C16));
        $nR2C16->addTo($nR1C16);
        $nR2C16->addTo($nR2C17);
        $nR2C16->addTo($nR3C16);
        //$nR2C17->addTo(array($nR2C16, $nR3C17));
        $nR2C17->addTo($nR2C16);
        $nR2C17->addTo($nR3C17);

        /*
        // $nRC->addTo(array($nRC));
        $nRC6->addTo(array($nRC6, $nRC7, $nRC6));
        $nRC7->addTo(array($nRC7, $nRC6, $nRC7));
        $nRC16->addTo(array($nRC16, $nRC17, $nRC16));
        $nRC17->addTo(array($nRC17, $nRC16, $nRC17));
        */

        /// $nR3C->addTo(array($nR3C));
        /// $nR3C->addTo($nRC);
        //$nR3C6->addTo(array($nR2C6, $nR3C7, $nR4C6));
        $nR3C6->addTo($nR2C6);
        $nR3C6->addTo($nR3C7);
        $nR3C6->addTo($nR4C6);
        //$nR3C7->addTo(array($nR2C7, $nR3C6, $nR4C7));
        $nR3C7->addTo($nR2C7);
        $nR3C7->addTo($nR3C6);
        $nR3C7->addTo($nR4C7);
        //$nR3C16->addTo(array($nR2C16, $nR3C17, $nR4C16));
        $nR3C16->addTo($nR2C16);
        $nR3C16->addTo($nR4C16);
        $nR3C16->addTo($nR3C17);
        //$nR3C17->addTo(array($nR2C17, $nR3C16, $nR4C17));
        $nR3C17->addTo($nR2C17);
        $nR3C17->addTo($nR3C16);
        $nR3C17->addTo($nR4C17);

        /// $nR4C->addTo(array($nR4C));
        /// $nR4C->addTo($nRC);
        //$nR4C6->addTo(array($nR3C6, $nR4C7, $nR5C6));
        $nR4C6->addTo($nR3C6);
        $nR4C6->addTo($nR4C7);
        $nR4C6->addTo($nR5C6);
        //$nR4C7->addTo(array($nR3C7, $nR4C6, $nR5C7));
        $nR4C7->addTo($nR3C7);
        $nR4C7->addTo($nR4C6);
        $nR4C7->addTo($nR5C7);
        //$nR4C16->addTo(array($nR3C16, $nR4C17, $nR5C16));
        $nR4C16->addTo($nR3C16);
        $nR4C16->addTo($nR4C17);
        $nR4C16->addTo($nR5C16);
        //$nR4C17->addTo(array($nR3C17, $nR4C16, $nR5C17));
        $nR4C17->addTo($nR3C17);
        $nR4C17->addTo($nR4C16);
        $nR4C17->addTo($nR5C17);

        /// $nR5C->addTo(array($nR5C));
        /// $nR5C->addTo($nRC);
        //$nR5C6->addTo(array($nR4C6, $nR5C7, $nR6C6));
        $nR5C6->addTo($nR4C6);
        $nR5C6->addTo($nR5C7);
        $nR5C6->addTo($nR6C6);
        //$nR5C7->addTo(array($nR4C7, $nR5C6, $nR6C7, $nBre));
        $nR5C7->addTo($nR4C7);
        $nR5C7->addTo($nR5C6);
        $nR5C7->addTo($nR6C7);
        $nR5C7->addTo($nBre);
        //$nR5C16->addTo(array($nR4C16, $nR5C17, $nR6C16, $nBre));
        $nR5C16->addTo($nR4C16);
        $nR5C16->addTo($nR5C17);
        $nR5C16->addTo($nR6C16);
        $nR5C16->addTo($nBre);
        //$nR5C17->addTo(array($nR4C17, $nR5C16, $nR6C17));
        $nR5C17->addTo($nR4C17);
        $nR5C17->addTo($nR5C16);
        $nR5C17->addTo($nR6C17);

        /// $nR6C->addTo(array($nR6C));
        /// $nR6C->addTo($nRC);
        //$nR6C6->addTo(array($nR5C6, $nR6C7, $nR7C6));
        $nR6C6->addTo($nR5C6);
        $nR6C6->addTo($nR6C7);
        $nR6C6->addTo($nR7C6);
        //$nR6C7->addTo(array($nR5C7, $nR6C6, $nR7C7));
        $nR6C7->addTo($nR5C7);
        $nR6C7->addTo($nR6C6);
        $nR6C7->addTo($nR7C7);
        //$nR6C16->addTo(array($nR5C16, $nR6C17, $nR7C16));
        $nR6C16->addTo($nR5C16);
        $nR6C16->addTo($nR6C17);
        $nR6C16->addTo($nR7C16);
        //$nR6C17->addTo(array($nR5C17, $nR6C16, $nR6C18, $nR7C17));
        $nR6C17->addTo($nR5C17);
        $nR6C17->addTo($nR6C16);
        $nR6C17->addTo($nR6C18);
        $nR6C17->addTo($nR7C17);
        //$nR6C18->addTo(array($nR6C17, $nR6C19, $nR7C18));
        $nR6C18->addTo($nR6C17);
        $nR6C18->addTo($nR6C19);
        $nR6C18->addTo($nR7C18);
        $nR6C18->addTo($nBea);
        //$nR6C19->addTo(array($nR6C18, $nR6C20, $nR7C19));
        $nR6C19->addTo($nR6C18);
        $nR6C19->addTo($nR6C20);
        $nR6C19->addTo($nR7C19);
        //$nR6C20->addTo(array($nR6C19, $nR6C21, $nR7C20));
        $nR6C20->addTo($nR6C19);
        $nR6C20->addTo($nR6C21);
        $nR6C20->addTo($nR7C20);
        //$nR6C21->addTo(array($nR6C20, $nR6C22, $nR7C21));
        $nR6C21->addTo($nR6C20);
        $nR6C21->addTo($nR6C22);
        $nR6C21->addTo($nR7C21);
        //$nR6C22->addTo(array($nR6C21, $nR7C22));
        $nR6C22->addTo($nR6C21);
        $nR6C22->addTo($nR7C22);

        /// $nR7C->addTo(array($nR7C));
        /// $nR7C->addTo($nRC);
        //$nR7C0->addTo(array($nR7C1));
        $nR7C0->addTo($nR7C1);
        //$nR7C1->addTo(array($nR7C0, $nR8C1));
        $nR7C1->addTo($nR7C0);
        $nR7C1->addTo($nR8C1);
        //$nR7C2->addTo(array($nR7C1, $nR7C3, $nR8C2));
        $nR7C2->addTo($nR7C1);
        $nR7C2->addTo($nR7C3);
        $nR7C2->addTo($nR8C2);
        //$nR7C3->addTo(array($nR7C2, $nR7C4, $nR8C3));
        $nR7C3->addTo($nR7C2);
        $nR7C3->addTo($nR7C4);
        $nR7C3->addTo($nR8C3);
        //$nR7C4->addTo(array($nR7C3, $nR7C5, $nR8C4, $nInt));
        $nR7C4->addTo($nR7C3);
        $nR7C4->addTo($nR7C5);
        $nR7C4->addTo($nR8C4);
        $nR7C4->addTo($nInt);
        //$nR7C5->addTo(array($nR7C4, $nR7C6, $nR8C5));
        $nR7C5->addTo($nR7C4);
        $nR7C5->addTo($nR7C6);
        $nR7C5->addTo($nR8C5);
        //$nR7C6->addTo(array($nR6C6, $nR7C5, $nR7C7, $nR8C6));
        $nR7C6->addTo($nR6C6);
        $nR7C6->addTo($nR7C5);
        $nR7C6->addTo($nR7C7);
        $nR7C6->addTo($nR8C6);
        //$nR7C7->addTo(array($nR6C7, $nR7C6, $nR8C7));
        $nR7C7->addTo($nR6C7);
        $nR7C7->addTo($nR7C6);
        $nR7C7->addTo($nR8C7);
        //$nR7C16->addTo(array($nR6C16, $nR7C17, $nR8C16));
        $nR7C16->addTo($nR6C16);
        $nR7C16->addTo($nR7C17);
        $nR7C16->addTo($nR8C16);
        //$nR7C17->addTo(array($nR6C17, $nR7C16, $nR7C18, $nR8C17));
        $nR7C17->addTo($nR6C17);
        $nR7C17->addTo($nR7C16);
        $nR7C17->addTo($nR7C18);
        $nR7C17->addTo($nR8C17);
        //$nR7C18->addTo(array($nR7C17, $nR7C19, $nR6C18));
        $nR7C18->addTo($nR7C17);
        $nR7C18->addTo($nR7C19);
        $nR7C18->addTo($nR6C18);
        //$nR7C19->addTo(array($nR7C18, $nR7C20, $nR6C19));
        $nR7C19->addTo($nR7C18);
        $nR7C19->addTo($nR7C20);
        $nR7C19->addTo($nR6C19);
        //$nR7C20->addTo(array($nR7C19, $nR7C21, $nR6C20));
        $nR7C20->addTo($nR7C19);
        $nR7C20->addTo($nR7C21);
        $nR7C20->addTo($nR6C20);
        //$nR7C21->addTo(array($nR7C20, $nR7C22, $nR6C21));
        $nR7C21->addTo($nR7C20);
        $nR7C21->addTo($nR7C22);
        $nR7C21->addTo($nR6C21);
        //$nR7C22->addTo(array($nR7C21, $nR6C22));
        $nR7C22->addTo($nR7C21);
        $nR7C22->addTo($nR6C22);

        /// $nR8C->addTo(array($nR8C));
        /// $nR8C->addTo($nRC);
        //$nR8C1->addTo(array($nR7C1, $nR8C2));
        $nR8C1->addTo($nR7C1);
        $nR8C1->addTo($nR8C2);
        //$nR8C2->addTo(array($nR7C2, $nR8C1, $nR8C3));
        $nR8C2->addTo($nR7C2);
        $nR8C2->addTo($nR8C1);
        $nR8C2->addTo($nR8C3);
        //$nR8C3->addTo(array($nR7C3, $nR8C2, $nR8C4));
        $nR8C3->addTo($nR7C3);
        $nR8C3->addTo($nR8C2);
        $nR8C3->addTo($nR8C4);
        //$nR8C4->addTo(array($nR7C4, $nR8C3, $nR8C5));
        $nR8C4->addTo($nR7C4);
        $nR8C4->addTo($nR8C3);
        $nR8C4->addTo($nR8C5);
        //$nR8C5->addTo(array($nR7C5, $nR8C4, $nR8C6, $nR9C5));
        $nR8C5->addTo($nR7C5);
        $nR8C5->addTo($nR8C4);
        $nR8C5->addTo($nR8C6);
        $nR8C5->addTo($nR9C5);
        //$nR8C6->addTo(array($nR7C6, $nR8C5, $nR8C7, $nR9C6));
        $nR8C6->addTo($nR7C6);
        $nR8C6->addTo($nR8C5);
        $nR8C6->addTo($nR8C7);
        $nR8C6->addTo($nR9C6);
        //$nR8C7->addTo(array($nR7C7, $nR8C6, $nR8C8, $nR9C7));
        $nR8C7->addTo($nR7C7);
        $nR8C7->addTo($nR8C6);
        $nR8C7->addTo($nR8C8);
        $nR8C7->addTo($nR9C7);
        //$nR8C8->addTo(array($nR8C7, $nR8C9, $nR9C8));
        $nR8C8->addTo($nR8C7);
        $nR8C8->addTo($nR8C9);
        $nR8C8->addTo($nR9C8);
        //$nR8C9->addTo(array($nR8C8, $nR8C10, $nR9C9, $nBre));
        $nR8C9->addTo($nR8C8);
        $nR8C9->addTo($nR8C10);
        $nR8C9->addTo($nR9C9);
        $nR8C9->addTo($nBre);
        //$nR8C10->addTo(array($nR8C9, $nR8C11, $nR9C10));
        $nR8C10->addTo($nR8C9);
        $nR8C10->addTo($nR8C11);
        $nR8C10->addTo($nR9C10);
        //$nR8C11->addTo(array($nR8C10, $nR8C12, $nR9C11));
        $nR8C11->addTo($nR8C10);
        $nR8C11->addTo($nR8C12);
        $nR8C11->addTo($nR9C11);
        //$nR8C12->addTo(array($nR8C11, $nR8C13, $nR9C12));
        $nR8C12->addTo($nR8C11);
        $nR8C12->addTo($nR8C13);
        $nR8C12->addTo($nR9C12);
        //$nR8C13->addTo(array($nR8C12, $nR8C14, $nR9C13));
        $nR8C13->addTo($nR8C12);
        $nR8C13->addTo($nR8C14);
        $nR8C13->addTo($nR9C13);
        //$nR8C14->addTo(array($nR8C13, $nR8C15, $nR9C14, $nBre));
        $nR8C14->addTo($nR8C13);
        $nR8C14->addTo($nR8C15);
        $nR8C14->addTo($nR9C14);
        $nR8C14->addTo($nBre);
        //$nR8C15->addTo(array($nR8C14, $nR8C16, $nR9C15));
        $nR8C15->addTo($nR8C14);
        $nR8C15->addTo($nR8C16);
        $nR8C15->addTo($nR9C15);
        //$nR8C16->addTo(array($nR7C16, $nR8C15, $nR8C17, $nR9C16));
        $nR8C16->addTo($nR7C16);
        $nR8C16->addTo($nR8C15);
        $nR8C16->addTo($nR8C17);
        $nR8C16->addTo($nR9C16);
        //$nR8C17->addTo(array($nR7C17, $nR8C16, $nR9C17));
        $nR8C17->addTo($nR7C17);
        $nR8C17->addTo($nR8C16);
        $nR8C17->addTo($nR9C17);

        /// $nR9C->addTo(array($nR9C));
        /// $nR9C->addTo($nRC);
        //$nR9C5->addTo(array($nR8C5, $nR9C6));
        $nR9C5->addTo($nR8C5);
        $nR9C5->addTo($nR9C6);
        //$nR9C6->addTo(array($nR8C6, $nR9C5, $nR9C7));
        $nR9C6->addTo($nR8C6);
        $nR9C6->addTo($nR9C5);
        $nR9C6->addTo($nR9C7);
        //$nR9C7->addTo(array($nR8C7, $nR9C6, $nR9C8));
        $nR9C7->addTo($nR8C7);
        $nR9C7->addTo($nR9C6);
        $nR9C7->addTo($nR9C8);
        //$nR9C8->addTo(array($nR8C8, $nR9C7, $nR9C9, $nR10C8));
        $nR9C8->addTo($nR8C8);
        $nR9C8->addTo($nR9C7);
        $nR9C8->addTo($nR9C9);
        $nR9C8->addTo($nR10C8);
        //$nR9C9->addTo(array($nR8C9, $nR9C8, $nR9C10, $nR10C9));
        $nR9C9->addTo($nR8C9);
        $nR9C9->addTo($nR9C8);
        $nR9C9->addTo($nR9C10);
        $nR9C9->addTo($nR10C9);
        //$nR9C10->addTo(array($nR8C10, $nR9C9, $nR9C11));
        $nR9C10->addTo($nR8C10);
        $nR9C10->addTo($nR9C9);
        $nR9C10->addTo($nR9C11);
        //$nR9C11->addTo(array($nR8C11, $nR9C10, $nR9C12));
        $nR9C11->addTo($nR8C11);
        $nR9C11->addTo($nR9C10);
        $nR9C11->addTo($nR9C12);
        //$nR9C12->addTo(array($nR8C12, $nR9C11, $nR9C13));
        $nR9C12->addTo($nR8C12);
        $nR9C12->addTo($nR9C11);
        $nR9C12->addTo($nR9C13);
        //$nR9C13->addTo(array($nR8C13, $nR9C12, $nR9C14));
        $nR9C13->addTo($nR8C13);
        $nR9C13->addTo($nR9C12);
        $nR9C13->addTo($nR9C14);
        //$nR9C14->addTo(array($nR8C14, $nR9C13, $nR9C15));
        $nR9C14->addTo($nR8C14);
        $nR9C14->addTo($nR9C13);
        $nR9C14->addTo($nR9C15);
        //$nR9C15->addTo(array($nR8C15, $nR9C14, $nR9C16, $nR10C15));
        $nR9C15->addTo($nR8C15);
        $nR9C15->addTo($nR9C14);
        $nR9C15->addTo($nR9C16);
        $nR9C15->addTo($nR10C15);
        //$nR9C16->addTo(array($nR8C16, $nR9C15, $nR9C17, $nR10C16));
        $nR9C16->addTo($nR8C16);
        $nR9C16->addTo($nR9C15);
        $nR9C16->addTo($nR9C17);
        $nR9C16->addTo($nR10C16);
        //$nR9C17->addTo(array($nR8C17, $nR9C16, $nR10C17, $nMus));
        $nR9C17->addTo($nR8C17);
        $nR9C17->addTo($nR9C16);
        $nR9C17->addTo($nR10C17);
        $nR9C17->addTo($nMus);

        /*
        // $nR1C->addTo(array($nR1C));
        $nR1C8->addTo(array($nR1C8, $nR1C9, $nR1C8));
        $nR1C9->addTo(array($nR1C9, $nR1C8, $nR1C9));
        $nR1C15->addTo(array($nR1C15, $nR1C16, $nR1C15));
        $nR1C16->addTo(array($nR1C16, $nR1C15, $nR1C17, $nR1C16));
        $nR1C17->addTo(array($nR1C17, $nR1C16, $nR1C17));
        */

        /// $nR10C->addTo(array($nR10C));
        /// $nR10C->addTo($nRC);
        //$nR10C8->addTo(array($nR9C8, $nR10C9, $nR11C8));
        $nR10C8->addTo($nR9C8);
        $nR10C8->addTo($nR10C9);
        $nR10C8->addTo($nR11C8);
        //$nR10C9->addTo(array($nR9C9, $nR10C8, $nR11C9));
        $nR10C9->addTo($nR9C9);
        $nR10C9->addTo($nR10C8);
        $nR10C9->addTo($nR11C9);
        //$nR10C15->addTo(array($nR9C15, $nR10C16, $nR11C15));
        $nR10C15->addTo($nR9C15);
        $nR10C15->addTo($nR10C16);
        $nR10C15->addTo($nR11C15);
        //$nR10C16->addTo(array($nR9C16, $nR10C15, $nR10C17, $nR11C16));
        $nR10C16->addTo($nR9C16);
        $nR10C16->addTo($nR10C15);
        $nR10C16->addTo($nR10C17);
        $nR10C16->addTo($nR11C16);
        //$nR10C17->addTo(array($nR9C17, $nR10C16, $nR11C17));
        $nR10C17->addTo($nR9C17);
        $nR10C17->addTo($nR10C16);
        $nR10C17->addTo($nR11C17);

        /// $nR11C->addTo(array($nR11C));
        /// $nR11C->addTo($nR1C);
        //$nR11C8->addTo(array($nR10C8, $nR11C9, $nR12C8));
        $nR11C8->addTo($nR10C8);
        $nR11C8->addTo($nR11C9);
        $nR11C8->addTo($nR12C8);
        //$nR11C9->addTo(array($nR10C9, $nR11C8, $nR12C9));
        $nR11C9->addTo($nR10C9);
        $nR11C9->addTo($nR11C8);
        $nR11C9->addTo($nR12C9);
        //$nR11C15->addTo(array($nR10C15, $nR11C16, $nR12C15));
        $nR11C15->addTo($nR10C15);
        $nR11C15->addTo($nR11C16);
        $nR11C15->addTo($nR12C15);
        //$nR11C16->addTo(array($nR10C16, $nR11C15, $nR11C17, $nR12C16));
        $nR11C16->addTo($nR10C16);
        $nR11C16->addTo($nR11C15);
        $nR11C16->addTo($nR11C17);
        $nR11C16->addTo($nR12C16);
        //$nR11C17->addTo(array($nR10C17, $nR11C16, $nR12C17));
        $nR11C17->addTo($nR10C17);
        $nR11C17->addTo($nR11C16);
        $nR11C17->addTo($nR12C17);

        /// $nR12C->addTo(array($nR12C));
        /// $nR12C->addTo($nR1C);
        //$nR12C8->addTo(array($nR11C8, $nR12C9, $nR13C8, $nUni));
        $nR12C8->addTo($nR11C8);
        $nR12C8->addTo($nR12C9);
        $nR12C8->addTo($nR13C8);
        $nR12C8->addTo($nUni);
        //$nR12C9->addTo(array($nR11C9, $nR12C8, $nR13C9));
        $nR12C9->addTo($nR11C9);
        $nR12C9->addTo($nR12C8);
        $nR12C9->addTo($nR13C9);
        //$nR12C15->addTo(array($nR11C15, $nR12C16, $nR13C15));
        $nR12C15->addTo($nR11C15);
        $nR12C15->addTo($nR12C16);
        $nR12C15->addTo($nR13C15);
        //$nR12C16->addTo(array($nR11C16, $nR12C15, $nR12C17, $nR13C16));
        $nR12C16->addTo($nR11C16);
        $nR12C16->addTo($nR12C15);
        $nR12C16->addTo($nR12C17);
        $nR12C16->addTo($nR13C16);
        //$nR12C17->addTo(array($nR11C17, $nR12C16, $nR13C17));
        $nR12C17->addTo($nR11C17);
        $nR12C17->addTo($nR12C16);
        $nR12C17->addTo($nR13C17);

        /// $nR13C->addTo(array($nR13C));
        /// $nR13C->addTo($nR1C);
        //$nR13C8->addTo(array($nR12C8, $nR13C9, $nR14C8));
        $nR13C8->addTo($nR12C8);
        $nR13C8->addTo($nR13C9);
        $nR13C8->addTo($nR14C8);
        //$nR13C9->addTo(array($nR12C9, $nR13C8, $nR14C9));
        $nR13C9->addTo($nR12C9);
        $nR13C9->addTo($nR13C8);
        $nR13C9->addTo($nR14C9);
        //$nR13C15->addTo(array($nR12C15, $nR13C16, $nR14C15));
        $nR13C15->addTo($nR12C15);
        $nR13C15->addTo($nR13C16);
        $nR13C15->addTo($nR14C15);
        //$nR13C16->addTo(array($nR12C16, $nR13C15, $nR13C17, $nR14C16));
        $nR13C16->addTo($nR12C16);
        $nR13C16->addTo($nR13C15);
        $nR13C16->addTo($nR13C17);
        $nR13C16->addTo($nR14C16);
        //$nR13C17->addTo(array($nR12C17, $nR13C16, $nR13C18, $nR14C17));
        $nR13C17->addTo($nR12C17);
        $nR13C17->addTo($nR13C16);
        $nR13C17->addTo($nR13C18);
        $nR13C17->addTo($nR14C17);
        //$nR13C18->addTo(array($nR13C17, $nR13C19));
        $nR13C18->addTo($nR13C17);
        $nR13C18->addTo($nR13C19);
        //$nR13C19->addTo(array($nR13C18, $nR13C20));
        $nR13C19->addTo($nR13C18);
        $nR13C19->addTo($nR13C20);
        //$nR13C20->addTo(array($nR13C19, $nR13C21, $nLib));
        $nR13C20->addTo($nR13C19);
        $nR13C20->addTo($nR13C21);
        $nR13C20->addTo($nLib);
        //$nR13C21->addTo(array($nR13C20, $nR13C22));
        $nR13C21->addTo($nR13C20);
        $nR13C21->addTo($nR13C22);
        //$nR13C22->addTo(array($nR13C21, $nMus));
        $nR13C22->addTo($nR13C21);
        $nR13C22->addTo($nMus);

        /// $nR14C->addTo(array($nR14C));
        /// $nR14C->addTo($nR1C);
        //$nR14C8->addTo(array($nR13C8, $nR14C9, $nR15C8));
        $nR14C8->addTo($nR13C8);
        $nR14C8->addTo($nR14C9);
        $nR14C8->addTo($nR15C8);
        //$nR14C9->addTo(array($nR13C9, $nR14C8, $nR15C9));
        $nR14C9->addTo($nR13C9);
        $nR14C9->addTo($nR14C8);
        $nR14C9->addTo($nR15C9);
        //$nR14C15->addTo(array($nR13C15, $nR14C16, $nR15C15));
        $nR14C15->addTo($nR13C15);
        $nR14C15->addTo($nR14C16);
        $nR14C15->addTo($nR15C15);
        //$nR14C16->addTo(array($nR13C16, $nR14C15, $nR14C17, $nR15C16));
        $nR14C16->addTo($nR13C16);
        $nR14C16->addTo($nR14C15);
        $nR14C16->addTo($nR14C17);
        $nR14C16->addTo($nR15C16);
        //$nR14C17->addTo(array($nR13C17, $nR14C16));
        $nR14C17->addTo($nR13C17);
        $nR14C17->addTo($nR14C16);

        /// $nR15C->addTo(array($nR15C));
        /// $nR15C->addTo($nR1C);
        //$nR15C8->addTo(array($nR14C8, $nR15C9, $nR16C8));
        $nR15C8->addTo($nR14C8);
        $nR15C8->addTo($nR15C9);
        $nR15C8->addTo($nR16C8);
        //$nR15C9->addTo(array($nR14C9, $nR15C8, $nR16C9));
        $nR15C9->addTo($nR14C9);
        $nR15C9->addTo($nR15C8);
        $nR15C9->addTo($nR16C9);
        //$nR15C15->addTo(array($nR14C15, $nR15C16, $nR16C15));
        $nR15C15->addTo($nR14C15);
        $nR15C15->addTo($nR15C16);
        $nR15C15->addTo($nR16C15);
        //$nR15C16->addTo(array($nR14C16, $nR15C15, $nR16C16));
        $nR15C16->addTo($nR14C16);
        $nR15C16->addTo($nR15C15);
        $nR15C16->addTo($nR16C16);

        /// $nR16C->addTo(array($nR16C));
        /// $nR16C->addTo($nR1C);
        //$nR16C1->addTo(array($nR16C2, $nR17C1));
        $nR16C1->addTo($nR16C2);
        $nR16C1->addTo($nR17C1);
        //$nR16C2->addTo(array($nR16C1, $nR16C3, $nR17C2));
        $nR16C2->addTo($nR16C1);
        $nR16C2->addTo($nR16C3);
        $nR16C2->addTo($nR17C2);
        //$nR16C3->addTo(array($nR16C2, $nR16C4, $nR17C3));
        $nR16C3->addTo($nR16C2);
        $nR16C3->addTo($nR16C4);
        $nR16C3->addTo($nR17C3);
        //$nR16C4->addTo(array($nR16C3, $nR16C5, $nR17C4));
        $nR16C4->addTo($nR16C3);
        $nR16C4->addTo($nR16C5);
        $nR16C4->addTo($nR17C4);
        //$nR16C5->addTo(array($nR16C4, $nR16C6, $nR17C5));
        $nR16C5->addTo($nR16C4);
        $nR16C5->addTo($nR16C6);
        $nR16C5->addTo($nR17C5);
        //$nR16C6->addTo(array($nR16C5, $nR16C7, $nR17C6, $nUni));
        $nR16C6->addTo($nR16C5);
        $nR16C6->addTo($nR16C7);
        $nR16C6->addTo($nR17C6);
        $nR16C6->addTo($nUni);
        //$nR16C7->addTo(array($nR16C6, $nR16C8, $nR17C7));
        $nR16C7->addTo($nR16C6);
        $nR16C7->addTo($nR16C8);
        $nR16C7->addTo($nR17C7);
        //$nR16C8->addTo(array($nR15C8, $nR16C7, $nR16C9, $nR17C8));
        $nR16C8->addTo($nR15C8);
        $nR16C8->addTo($nR16C7);
        $nR16C8->addTo($nR16C9);
        $nR16C8->addTo($nR17C8);
        //$nR16C9->addTo(array($nR15C9, $nR16C8, $nR17C9));
        $nR16C9->addTo($nR15C9);
        $nR16C9->addTo($nR16C8);
        $nR16C9->addTo($nR17C9);
        //$nR16C15->addTo(array($nR15C15, $nR16C16, $nR17C15));
        $nR16C15->addTo($nR15C15);
        $nR16C15->addTo($nR16C16);
        $nR16C15->addTo($nR17C15);
        //$nR16C16->addTo(array($nR15C16, $nR16C15, $nR17C16, $nLib));
        $nR16C16->addTo($nR15C16);
        $nR16C16->addTo($nR16C15);
        $nR16C16->addTo($nR17C16);
        $nR9C17->addTo($nMus);
        $nR16C16->addTo($nLib);

        /// $nR17C->addTo(array($nR17C));
        /// $nR17C->addTo($nR1C);
        //$nR17C1->addTo(array($nR16C1, $nR17C2, $nR18C1));
        $nR17C1->addTo($nR16C1);
        $nR17C1->addTo($nR17C2);
        $nR17C1->addTo($nR18C1);
        //$nR17C2->addTo(array($nR16C2, $nR17C1, $nR17C3, $nR18C2));
        $nR17C2->addTo($nR16C2);
        $nR17C2->addTo($nR17C1);
        $nR17C2->addTo($nR17C3);
        $nR17C2->addTo($nR18C2);
        //$nR17C3->addTo(array($nR16C3, $nR17C2, $nR17C4, $nR18C3));
        $nR17C3->addTo($nR16C3);
        $nR17C3->addTo($nR17C2);
        $nR17C3->addTo($nR17C4);
        $nR17C3->addTo($nR18C3);
        //$nR17C4->addTo(array($nR16C4, $nR17C3, $nR17C5, $nR18C4));
        $nR17C4->addTo($nR16C4);
        $nR17C4->addTo($nR17C3);
        $nR17C4->addTo($nR17C5);
        $nR17C4->addTo($nR18C4);
        //$nR17C5->addTo(array($nR16C5, $nR17C4, $nR17C6, $nR18C5));
        $nR17C5->addTo($nR16C5);
        $nR17C5->addTo($nR17C4);
        $nR17C5->addTo($nR17C6);
        $nR17C5->addTo($nR18C5);
        //$nR17C6->addTo(array($nR16C6, $nR17C5, $nR17C7, $nR18C6));
        $nR17C6->addTo($nR16C6);
        $nR17C6->addTo($nR17C5);
        $nR17C6->addTo($nR17C7);
        $nR17C6->addTo($nR18C6);
        //$nR17C7->addTo(array($nR16C7, $nR17C6, $nR17C8, $nR18C7));
        $nR17C7->addTo($nR16C7);
        $nR17C7->addTo($nR17C6);
        $nR17C7->addTo($nR17C8);
        $nR17C7->addTo($nR18C7);
        //$nR17C8->addTo(array($nR16C8, $nR17C7, $nR17C9, $nR18C8));
        $nR17C8->addTo($nR16C8);
        $nR17C8->addTo($nR17C7);
        $nR17C8->addTo($nR17C9);
        $nR17C8->addTo($nR18C8);
        //$nR17C9->addTo(array($nR16C9, $nR17C8, $nR17C10));
        $nR17C9->addTo($nR16C9);
        $nR17C9->addTo($nR17C8);
        $nR17C9->addTo($nR17C10);
        //$nR17C10->addTo(array($nR17C9, $nR17C11));
        $nR17C10->addTo($nR17C9);
        $nR17C10->addTo($nR17C11);
        //$nR17C11->addTo(array($nR17C10, $nR17C12, $nSta));
        $nR17C11->addTo($nR17C10);
        $nR17C11->addTo($nR17C12);
        $nR17C11->addTo($nSta);
        //$nR17C12->addTo(array($nR17C11, $nR17C13, $nSta));
        $nR17C12->addTo($nR17C11);
        $nR17C12->addTo($nR17C13);
        $nR17C12->addTo($nSta);
        //$nR17C13->addTo(array($nR17C12, $nR17C14));
        $nR17C13->addTo($nR17C12);
        $nR17C13->addTo($nR17C14);
        //$nR17C14->addTo(array($nR17C13, $nR17C15));
        $nR17C14->addTo($nR17C13);
        $nR17C14->addTo($nR17C15);
        //$nR17C15->addTo(array($nR16C15, $nR17C14, $nR17C16, $nR18C15));
        $nR17C15->addTo($nR16C15);
        $nR17C15->addTo($nR17C14);
        $nR17C15->addTo($nR17C16);
        $nR17C15->addTo($nR18C15);
        //$nR17C16->addTo(array($nR16C16, $nR17C15, $nR18C16));
        $nR17C16->addTo($nR16C16);
        $nR17C16->addTo($nR17C15);
        $nR17C16->addTo($nR18C16);

        /// $nR18C->addTo(array($nR18C));
        /// $nR18C->addTo($nR1C);
        //$nR18C1->addTo(array($nR17C1, $nR18C2));
        $nR18C1->addTo($nR18C1);
        $nR18C1->addTo($nR18C2);
        //$nR18C2->addTo(array($nR17C2, $nR18C1, $nR18C3));
        $nR18C2->addTo($nR17C2);
        $nR18C2->addTo($nR18C1);
        $nR18C2->addTo($nR18C3);
        //$nR18C3->addTo(array($nR17C3, $nR18C2, $nR18C4));
        $nR18C3->addTo($nR17C3);
        $nR18C3->addTo($nR18C2);
        $nR18C3->addTo($nR18C4);
        //$nR18C4->addTo(array($nR17C4, $nR18C3, $nR18C5));
        $nR18C4->addTo($nR17C4);
        $nR18C4->addTo($nR18C3);
        $nR18C4->addTo($nR18C5);
        //$nR18C5->addTo(array($nR17C5, $nR18C4, $nR18C6));
        $nR18C5->addTo($nR17C5);
        $nR18C5->addTo($nR18C4);
        $nR18C5->addTo($nR18C6);
        //$nR18C6->addTo(array($nR17C6, $nR18C5, $nR18C7, $nWha));
        $nR18C6->addTo($nR17C6);
        $nR18C6->addTo($nR18C5);
        $nR18C6->addTo($nR18C7);
        $nR18C6->addTo($nWha);
        //$nR18C7->addTo(array($nR17C7, $nR18C6, $nR18C8, $nR19C7));
        $nR18C7->addTo($nR17C7);
        $nR18C7->addTo($nR18C6);
        $nR18C7->addTo($nR18C8);
        $nR18C7->addTo($nR19C7);
        //$nR18C8->addTo(array($nR17C8, $nR18C7, $nR19C8));
        $nR18C8->addTo($nR17C8);
        $nR18C8->addTo($nR18C7);
        $nR18C8->addTo($nR19C8);
        //$nR18C15->addTo(array($nR17C15, $nR18C16, $nR19C15));
        $nR18C15->addTo($nR17C15);
        $nR18C15->addTo($nR18C16);
        $nR18C15->addTo($nR19C15);
        //$nR18C16->addTo(array($nR17C16, $nR18C15, $nR18C17, $nR19C16));
        $nR18C16->addTo($nR17C16);
        $nR18C16->addTo($nR18C15);
        $nR18C16->addTo($nR18C17);
        $nR18C16->addTo($nR19C16);
        //$nR18C17->addTo(array($nR18C16, $nR19C17));
        $nR18C17->addTo($nR18C16);
        $nR18C17->addTo($nR19C17);

        /// $nR19C->addTo(array($nR19C));
        /// $nR19C->addTo($nRC);
        //$nR19C7->addTo(array($nR18C7, $nR19C8, $nR20C7));
        $nR19C7->addTo($nR18C7);
        $nR19C7->addTo($nR19C8);
        $nR19C7->addTo($nR20C7);
        //$nR19C8->addTo(array($nR18C8, $nR19C7, $nR20C8));
        $nR19C8->addTo($nR18C8);
        $nR19C8->addTo($nR19C7);
        $nR19C8->addTo($nR20C8);
        //$nR19C15->addTo(array($nR18C15, $nR19C16, $nR20C15));
        $nR19C15->addTo($nR18C15);
        $nR19C15->addTo($nR19C16);
        $nR19C15->addTo($nR20C15);
        //$nR19C16->addTo(array($nR18C16, $nR19C15, $nR19C17, $nR20C16));
        $nR19C16->addTo($nR18C16);
        $nR19C16->addTo($nR19C15);
        $nR19C16->addTo($nR19C17);
        $nR19C16->addTo($nR20C16);
        //$nR19C17->addTo(array($nR18C17, $nR19C16, $nR19C18, $nR20C17));
        $nR19C17->addTo($nR18C17);
        $nR19C17->addTo($nR19C16);
        $nR19C17->addTo($nR19C18);
        $nR19C17->addTo($nR20C17);
        //$nR19C18->addTo(array($nR19C17, $nR19C19, $nR20C18));
        $nR19C18->addTo($nR19C17);
        $nR19C18->addTo($nR19C19);
        $nR19C18->addTo($nR20C18);
        //$nR19C19->addTo(array($nR19C18, $nR19C20, $nR20C19));
        $nR19C19->addTo($nR19C18);
        $nR19C19->addTo($nR19C20);
        $nR19C19->addTo($nR20C19);
        //$nR19C20->addTo(array($nR19C19, $nR19C21, $nR20C20));
        $nR19C20->addTo($nR19C19);
        $nR19C20->addTo($nR19C21);
        $nR19C20->addTo($nR20C20);
        //$nR19C21->addTo(array($nR19C20, $nR19C22, $nR20C21));
        $nR19C21->addTo($nR19C20);
        $nR19C21->addTo($nR19C22);
        $nR19C21->addTo($nR20C21);
        //$nR19C22->addTo(array($nR19C21, $nR20C22));
        $nR19C22->addTo($nR19C21);
        $nR19C22->addTo($nR20C22);

        /*
        // $nR2C->addTo(array($nR2C));
        $nR2C7->addTo(array($nR2C7, $nR2C8, $nR2C7));
        $nR2C8->addTo(array($nR2C8, $nR2C7, $nR2C8));
        $nR2C15->addTo(array($nR2C15, $nR2C16, $nR2C15));
        $nR2C16->addTo(array($nR2C16, $nR2C15, $nR2C16));
        $nR2C17->addTo(array($nR2C17, $nR2C16, $nR2C17));
        */

        /// $nR20C->addTo(array($nR20C));
        /// $nR20C->addTo($nRC);
        //$nR20C7->addTo(array($nR19C7, $nR20C8, $nR21C7));
        $nR20C7->addTo($nR19C7);
        $nR20C7->addTo($nR20C8);
        $nR20C7->addTo($nR21C7);
        //$nR20C8->addTo(array($nR19C8, $nR20C7, $nR21C8));
        $nR20C8->addTo($nR19C8);
        $nR20C8->addTo($nR20C7);
        $nR20C8->addTo($nR21C8);
        //$nR20C15->addTo(array($nR19C15, $nR20C16, $nR21C15));
        $nR20C15->addTo($nR19C15);
        $nR20C15->addTo($nR20C16);
        $nR20C15->addTo($nR21C15);
        //$nR20C16->addTo(array($nR19C16, $nR20C15, $nR20C17, $nR21C16));
        $nR20C16->addTo($nR19C16);
        $nR20C16->addTo($nR20C15);
        $nR20C16->addTo($nR20C17);
        $nR20C16->addTo($nR21C16);
        //$nR20C17->addTo(array($nR19C17, $nR20C16, $nR20C18, $nEng));
        $nR20C17->addTo($nR19C17);
        $nR20C17->addTo($nR20C16);
        $nR20C17->addTo($nR20C18);
        $nR20C17->addTo($nEng);
        //$nR20C18->addTo(array($nR19C18, $nR20C17, $nR20C19));
        $nR20C18->addTo($nR19C18);
        $nR20C18->addTo($nR20C17);
        $nR20C18->addTo($nR20C19);
        //$nR20C19->addTo(array($nR19C19, $nR20C18, $nR20C20));
        $nR20C19->addTo($nR19C19);
        $nR20C19->addTo($nR20C18);
        $nR20C19->addTo($nR20C20);
        //$nR20C20->addTo(array($nR19C20, $nR20C19, $nR20C21));
        $nR20C20->addTo($nR19C20);
        $nR20C20->addTo($nR20C19);
        $nR20C20->addTo($nR20C21);
        //$nR20C21->addTo(array($nR19C21, $nR20C20, $nR20C22));
        $nR20C21->addTo($nR19C21);
        $nR20C21->addTo($nR20C20);
        $nR20C21->addTo($nR20C22);
        //$nR20C22->addTo(array($nR19C22, $nR20C21));
        $nR20C22->addTo($nR19C22);
        $nR20C22->addTo($nR20C21);


        /// $nR21C->addTo(array($nR21C));
        /// $nR21C->addTo($nR2C);
        //$nR21C7->addTo(array($nR20C7, $nR21C8, $nR22C7));
        $nR21C7->addTo($nR20C7);
        $nR21C7->addTo($nR21C8);
        $nR21C7->addTo($nR22C7);
        //$nR21C8->addTo(array($nR20C8, $nR21C7, $nR22C8));
        $nR21C8->addTo($nR20C8);
        $nR21C8->addTo($nR21C7);
        $nR21C8->addTo($nR22C8);
        //$nR21C15->addTo(array($nR20C15, $nR21C16, $nR22C15));
        $nR21C15->addTo($nR20C15);
        $nR21C15->addTo($nR21C16);
        $nR21C15->addTo($nR22C15);
        //$nR21C16->addTo(array($nR20C16, $nR21C15, $nR22C16));
        $nR21C16->addTo($nR20C16);
        $nR21C16->addTo($nR21C15);
        $nR21C16->addTo($nR22C16);

        /// $nR22C->addTo(array($nR22C));
        /// $nR22C->addTo($nR2C);
        //$nR22C7->addTo(array($nR21C7, $nR22C8, $nR23C7));
        $nR22C7->addTo($nR21C7);
        $nR22C7->addTo($nR22C8);
        $nR22C7->addTo($nR23C7);
        //$nR22C8->addTo(array($nR21C8, $nR22C7, $nR23C8));
        $nR22C8->addTo($nR21C8);
        $nR22C8->addTo($nR22C7);
        $nR22C8->addTo($nR23C8);
        //$nR22C15->addTo(array($nR21C15, $nR22C16, $nR23C15));
        $nR22C15->addTo($nR21C15);
        $nR22C15->addTo($nR22C16);
        $nR22C15->addTo($nR23C15);
        //$nR22C16->addTo(array($nR21C16, $nR22C15, $nR23C16));
        $nR22C16->addTo($nR21C16);
        $nR22C16->addTo($nR22C15);
        $nR22C16->addTo($nR23C16);

        /// $nR23C->addTo(array($nR23C));
        /// $nR23C->addTo($nR2C);
        //$nR23C7->addTo(array($nR22C7, $nR23C8));
        $nR23C7->addTo($nR22C7);
        $nR23C7->addTo($nR23C8);
        //$nR23C8->addTo(array($nR22C8, $nR23C7));
        $nR23C8->addTo($nR22C8);
        $nR23C8->addTo($nR23C7);
        //$nR23C15->addTo(array($nR22C15, $nR23C16));
        $nR23C15->addTo($nR22C15);
        $nR23C15->addTo($nR23C16);
        //$nR23C16->addTo(array($nR22C16, $nR23C15, $nR24C16));
        $nR23C16->addTo($nR22C16);
        $nR23C16->addTo($nR23C15);
        $nR23C16->addTo($nR24C16);

        /// $nR24C->addTo(array($nR24C));
        /// $nR24C->addTo($nR2C);
        //$nR24C16->addTo(array($nR23C16));
        $nR24C16->addTo($nR23C16);

        $nMcc->addTo($nR1C9);
        $nOwe->addTo($nR1C14);
        $nDay->addTo($nR7C22);
        $nOns->addTo($nR17C1);
        $nPlu->addTo($nR19C22);
        $nEnb->addTo($nR23C7);

        ///$n->addTo($nRC);
        //$nInt->addTo(array($nR7C4, $nEng));
        $nInt->addTo($nR7C4);
        $nInt->addTo($nEng);
        //$nBre->addTo(array($nR5C7, $nR5C16, $nR8C9, $nR8C14));
        $nBre->addTo($nR5C7);
        $nBre->addTo($nR5C16);
        $nBre->addTo($nR8C9);
        $nBre->addTo($nR8C14);
        //$nBea->addTo(array($nR16C5, $nWha));
        $nBea->addTo($nR6C18);
        $nBea->addTo($nWha);
        //$nUni->addTo(array($nR12C8, $nR16C6));
        $nUni->addTo($nR12C8);
        $nUni->addTo($nR16C6);
        //$nMus->addTo(array($nR9C17, $nR13C22));
        $nMus->addTo($nR9C17);
        $nMus->addTo($nR13C22);
        //$nLib->addTo(array($nR13C20, $nR16C16));
        $nLib->addTo($nR13C20);
        $nLib->addTo($nR16C16);
        //$nWha->addTo(array($nR18C6, $nBea));
        $nWha->addTo($nR18C6);
        $nWha->addTo($nBea);
        //$nSta->addTo(array($nR17C11, $nR17C12));
        $nSta->addTo($nR17C11);
        $nSta->addTo($nR17C12);
        //$nEng->addTo(array($nR20C17, $nInt));
        $nEng->addTo($nR20C17);
        $nEng->addTo($nInt);

        $en = new Node(0, 0, self::BAD_NODE);
        $this->grid = array(0 => array($en, $en, $en, $en, $en, $en, $en, $en, $en, $nMcc, $en, $en, $en, $en, $nOwe,
                        $en, $en, $en, $en, $en, $en, $en, $en, $en),
                    1 => array($nInt, $nInt, $nInt, $nInt, $nInt, $nInt, $en, $nR1C7, $nR1C8, $nR1C9,
                        $nBre, $nBre, $nBre, $nBre, $nR1C14, $nR1C15, $nR1C16, $en,
                        $nBea, $nBea, $nBea, $nBea, $nBea, $nBea),
                    2 => array($nInt, $nInt, $nInt, $nInt, $nInt, $nInt, $nR2C6, $nR2C7,
                        $nBre, $nBre, $nBre, $nBre, $nBre, $nBre, $nBre, $nBre, $nR2C16, $nR2C17,
                        $nBea, $nBea, $nBea, $nBea, $nBea, $nBea),
                    3 => array($nInt, $nInt, $nInt, $nInt, $nInt, $nInt, $nR3C6, $nR3C7,
                        $nBre, $nBre, $nBre, $nBre, $nBre, $nBre, $nBre, $nBre, $nR3C16, $nR3C17,
                        $nBea, $nBea, $nBea, $nBea, $nBea, $nBea),
                    4 => array($nInt, $nInt, $nInt, $nInt, $nInt, $nInt, $nR4C6, $nR4C7,
                        $nBre, $nBre, $nBre, $nBre, $nBre, $nBre, $nBre, $nBre, $nR4C16, $nR4C17,
                        $nBea, $nBea, $nBea, $nBea, $nBea, $nBea),
                    5 => array($nInt, $nInt, $nInt, $nInt, $nInt, $nInt, $nR5C6, $nR5C7,
                        $nBre, $nBre, $nBre, $nBre, $nBre, $nBre, $nBre, $nBre, $nR5C16, $nR5C17,
                        $nBea, $nBea, $nBea, $nBea, $nBea, $en),
                    6 => array($en, $nInt, $nInt, $nInt, $nInt, $nInt, $nR6C6, $nR6C7,
                        $nBre, $nBre, $nBre, $nBre, $nBre, $nBre, $nBre, $nBre, $nR6C16, $nR6C17,
                        $nR6C18, $nR6C19, $nR6C20, $nR6C21, $nR6C22, $en),
                    7 => array($nR7C0, $nR7C1, $nR7C2, $nR7C3, $nR7C4, $nR7C5, $nR7C6, $nR7C7,
                        $nBre, $nBre, $nBre, $nBre, $nBre, $nBre, $nBre, $nBre, $nR7C16, $nR7C17,
                        $nR7C18, $nR7C19, $nR7C20, $nR7C21, $nR7C22, $nDay),
                    8 => array($en, $nR8C1, $nR8C2, $nR8C3, $nR8C4, $nR8C5, $nR8C6, $nR8C7,
                        $nR8C8, $nR8C9, $nR8C10, $nR8C11, $nR8C12, $nR8C13, $nR8C14, $nR8C15, $nR8C16, $nR8C17,
                        $nMus, $nMus, $nMus, $nMus, $nMus, $nMus),
                    9 => array($nUni, $nUni, $nUni, $nUni, $nUni, $nR9C5, $nR9C6, $nR9C7,
                        $nR9C8, $nR9C9, $nR9C10, $nR9C11, $nR9C12, $nR9C13, $nR9C14, $nR9C15, $nR9C16, $nR9C17,
                        $nMus, $nMus, $nMus, $nMus, $nMus, $nMus),
                    10 => array($nUni, $nUni, $nUni, $nUni, $nUni, $nUni, $nUni, $nUni,
                        $nR10C8, $nR10C9, $en, $en, $en, $en, $en, $nR10C15, $nR10C16, $nR10C17,
                        $nMus, $nMus, $nMus, $nMus, $nMus, $nMus),
                    11 => array($nUni, $nUni, $nUni, $nUni, $nUni, $nUni, $nUni, $nUni,
                        $nR11C8, $nR11C9, $en, $en, $en, $en, $en, $nR11C15, $nR11C16, $nR11C17,
                        $nMus, $nMus, $nMus, $nMus, $nMus, $nMus),
                    12 => array($nUni, $nUni, $nUni, $nUni, $nUni, $nUni, $nUni, $nUni,
                        $nR12C8, $nR12C9, $en, $en, $en, $en, $en, $nR12C15, $nR12C16, $nR12C17,
                        $nMus, $nMus, $nMus, $nMus, $nMus, $nMus),
                    13 => array($nUni, $nUni, $nUni, $nUni, $nUni, $nUni, $nUni, $nUni,
                        $nR13C8, $nR13C9, $en, $en, $en, $en, $en, $nR13C15, $nR13C16, $nR13C17,
                        $nR13C18, $nR13C19, $nR13C20, $nR13C21, $nR13C22, $en),
                    14 => array($nUni, $nUni, $nUni, $nUni, $nUni, $nUni, $nUni, $nUni,
                        $nR14C8, $nR14C9, $en, $en, $en, $en, $en, $nR14C15, $nR14C16, $nR14C17,
                        $nLib, $nLib, $nLib, $nLib, $nLib, $en),
                    15 => array($nUni, $nUni, $nUni, $nUni, $nUni, $nUni, $nUni, $nUni,
                        $nR15C8, $nR15C9, $en, $en, $en, $en, $en, $nR15C15, $nR15C16, $nLib,
                        $nLib, $nLib, $nLib, $nLib, $nLib, $nLib),
                    16 => array($en, $nR16C1, $nR16C2, $nR16C3, $nR16C4, $nR16C5, $nR16C6, $nR16C7,
                        $nR16C8, $nR16C9, $en, $en, $en, $en, $en, $nR16C15, $nR16C16, $nLib,
                        $nLib, $nLib, $nLib, $nLib, $nLib, $nLib),
                    17 => array($nOns, $nR17C1, $nR17C2, $nR17C3, $nR17C4, $nR17C5, $nR17C6, $nR17C7,
                        $nR17C8, $nR17C9, $nR17C10, $nR17C11, $nR17C12, $nR17C13, $nR17C14, $nR17C15,
                        $nR17C16, $nLib, $nLib, $nLib, $nLib, $nLib, $nLib, $nLib),
                    18 => array($en, $nR18C1, $nR18C2, $nR18C3, $nR18C4, $nR18C5, $nR18C6, $nR18C7,
                        $nR18C8, $nSta, $nSta, $nSta, $nSta, $nSta, $nSta, $nR18C15, $nR18C16, $nR18C17,
                        $nLib, $nLib, $nLib, $nLib, $nLib, $en),
                    19 => array($nWha, $nWha, $nWha, $nWha, $nWha, $nWha, $nWha, $nR19C7,
                        $nR19C8, $nSta, $nSta, $nSta, $nSta, $nSta, $nSta, $nR19C15, $nR19C16, $nR19C17,
                        $nR19C18, $nR19C19, $nR19C20, $nR19C21, $nR19C22, $nPlu),
                    20 => array($nWha, $nWha, $nWha, $nWha, $nWha, $nWha, $nWha, $nR20C7,
                        $nR20C8, $nSta, $nSta, $nSta, $nSta, $nSta, $nSta, $nR20C15, $nR20C16, $nR20C17,
                        $nR20C18, $nR20C19, $nR20C20, $nR20C21, $nR20C22, $en),
                    21 => array($nWha, $nWha, $nWha, $nWha, $nWha, $nWha, $nWha, $nR21C7,
                        $nR21C8, $nSta, $nSta, $nSta, $nSta, $nSta, $nSta, $nR21C15, $nR21C16, $nEng,
                        $nEng, $nEng, $nEng, $nEng, $nEng, $nEng),
                    22 => array($nWha, $nWha, $nWha, $nWha, $nWha, $nWha, $nWha, $nR22C7,
                        $nR22C8, $nSta, $nSta, $nSta, $nSta, $nSta, $nSta, $nR22C15, $nR22C16, $nEng,
                        $nEng, $nEng, $nEng, $nEng, $nEng, $nEng),
                    23 => array($nWha, $nWha, $nWha, $nWha, $nWha, $nWha, $nWha, $nR23C7,
                        $nR23C8, $nSta, $nSta, $nSta, $nSta, $nSta, $nSta, $nR23C15, $nR23C16, $nEng,
                        $nEng, $nEng, $nEng, $nEng, $nEng, $nEng),
                    24 => array($nWha, $nWha, $nWha, $nWha, $nWha, $nWha, $en, $nEnb,
                        $en, $nSta, $nSta, $nSta, $nSta, $nSta, $nSta, $en, $nR24C16, $en,
                        $nEng, $nEng, $nEng, $nEng, $nEng, $nEng));


    }

    public function deal() {

        $numCards = [6,6,6,4,3,3];

        $card_info = ["Beaumont","Breslin","Day","Enbody","Engineering","Final",
            "International","Library","McCullen", "Midterm", "Museum","Onsay", "Owen",
            "Plum", "Programming","Project","Quiz","Stadium", "Union","Wharton", "Written"];

        $m1 = $this->murderer;
        $m2 = $this->murder_weapon;
        $m3 = $this->murder_location;
        $card_info =array_diff( $card_info, [$m1] );
        $card_info =array_diff( $card_info, [$m2] );
        $card_info =array_diff( $card_info, [$m3] );

        shuffle($card_info);
        $count = 0;

        $this->numAccused = 0;

        foreach ($this->players as $player) {
            $this->numAccused += 1;
            $temp = array();
            for ($i = 0; $i < $numCards[count($this->players)-1]; $i++) {
                array_push($temp, $card_info[$count]);

                $count += 1;
            }

            $player->deal($temp);
        }

    }

    public function setID($id) {
        $this->gameID = $id;
    }

    public function getID() {
        return $this->gameID;
    }

    public function getNumAccused() {
        return $this->numAccused;
    }

    public function setNumAccused($n) {
        $this->numAccused = $n;
    }

    public function show_other_cards($player) {
        $hand = $player->getPlayerCards();
        $html = "";
        foreach ($this->cards as $card) {
            if (!in_array($card, $hand)) {
                $image = $card->getImage();
                $name = $card->getName();
                $word = $card->getWord();
                $html .= <<<HTML
<p><img src="images/$image" alt="$name"><br>$word</p>
HTML;
            }
        }
        return $html;
    }

    public function get_cards() {
        return $this->cards;
    }

    /**
     * @param mixed $diceImg1
     */
    public function setDiceImg1($diceImg1)
    {
        $this->diceImg1 = $diceImg1;
    }

    /**
     * @param mixed $diceImg2
     */
    public function setDiceImg2($diceImg2)
    {
        $this->diceImg2 = $diceImg2;
    }

    /**
     * @param array $cards_displayed
     */
    public function setCardsDisplayed($cards_displayed)
    {
        $this->cards_displayed = $cards_displayed;
    }

    /**
     * @param array $cards
     */
    public function setCards($cards)
    {
        $this->cards = $cards;
    }

    /**
     * @param array $suspects
     */
    public function setSuspects($suspects)
    {
        $this->suspects = $suspects;
    }

    /**
     * @param array $locations
     */
    public function setLocations($locations)
    {
        $this->locations = $locations;
    }

    /**
     * @param array $weapons
     */
    public function setWeapons($weapons)
    {
        $this->weapons = $weapons;
    }

    /**
     * @param mixed $murderer
     */
    public function setMurderer($murderer)
    {
        $this->murderer = $murderer;
    }

    /**
     * @param mixed $murder_location
     */
    public function setMurderLocation($murder_location)
    {
        $this->murder_location = $murder_location;
    }

    /**
     * @param mixed $suggestedProf
     */
    public function setSuggestedProf($suggestedProf)
    {
        $this->suggestedProf = $suggestedProf;
    }

    /**
     * @param mixed $suggestedProfPlayer
     */
    public function setSuggestedProfPlayer($suggestedProfPlayer)
    {
        $this->suggestedProfPlayer = $suggestedProfPlayer;
    }

    /**
     * @param mixed $suggProfId
     */
    public function setSuggProfId($suggProfId)
    {
        $this->suggProfId = $suggProfId;
    }

    /**
     * @param mixed $suggestedWeapon
     */
    public function setSuggestedWeapon($suggestedWeapon)
    {
        $this->suggestedWeapon = $suggestedWeapon;
    }

    /**
     * @param mixed $gameID
     */
    public function setGameID($gameID)
    {
        $this->gameID = $gameID;
    }

    /**
     * @param int $playerUpInd
     */
    public function setPlayerUpInd($playerUpInd)
    {
        $this->playerUpInd = $playerUpInd;
    }

    /**
     * @param int $totalNumMoves
     */
    public function setTotalNumMoves($totalNumMoves)
    {
        $this->totalNumMoves = $totalNumMoves;
    }

    /**
     * @param mixed $dice1Num
     */
    public function setDice1Num($dice1Num)
    {
        $this->dice1Num = $dice1Num;
    }

    /**
     * @param mixed $dice2Num
     */
    public function setDice2Num($dice2Num)
    {
        $this->dice2Num = $dice2Num;
    }

    public function get_current_player() {
        return $this->players[$this->playerUpInd];
    }

    public function get_cards_displayed() {
        return $this->cards_displayed;
    }

    public function add_cards_displayed($player) {
        $this->cards_displayed[] = $player;
    }


    public function badProfessor() {
        return $this->murderer;
    }

    public function rollDice1() {
        //$randomNum = rand(0,6);
        //return $randomNum;
        $this->dice1Num = rand(1,6);

    }

    public function rollDice2() {
        //$randomNum = rand(0,6);
        //return $randomNum;
        $this->dice2Num = rand(1,6);
    }

    public function getDice1Img() {
        return $this->diceImg1;
    }

    public function getDice1Num() {
        return $this->dice1Num;
    }

    public function getDice2Img() {
        return $this->diceImg2;
    }

    public function getDice2Num() {
        return $this->dice2Num;
    }

    public function rollDice() {
        //$totalMoves = $this->rollDice1() + $this->rollDice2();
        //return $totalMoves;
        $this->rollDice1();
        $this->rollDice2();
        $this->setImagesForDice();
        //$this->totalNumMoves = $this->dice1Num + $this->dice2Num;
        $amt = $this->dice1Num + $this->dice2Num;
        $this->totalNumMoves = $this->dice1Num + $this->dice2Num;
        return $amt;
    }

    public function getTotalNumMoves() {
        return $this->totalNumMoves;
    }


    public function setImagesForDice() {
        if ($this->dice1Num == 1){
            $this->diceImg1 = "dice1.png";
        }
        else if ($this->dice1Num == 2){
            $this->diceImg1 = "dice2.png";
        }
        else if ($this->dice1Num == 3){
            $this->diceImg1 = "dice3.png";
        }
        else if ($this->dice1Num == 4){
            $this->diceImg1 = "dice4.png";
        }
        else if ($this->dice1Num == 5){
            $this->diceImg1 = "dice5.png";
        }
        else if ($this->dice1Num == 6){
            $this->diceImg1 = "dice6.png";
        }

        if ($this->dice2Num == 1){
            $this->diceImg2 = "dice1.png";
        }
        else if ($this->dice2Num == 2){
            $this->diceImg2 = "dice2.png";
        }
        else if ($this->dice2Num == 3){
            $this->diceImg2 = "dice3.png";
        }
        else if ($this->dice2Num == 4){
            $this->diceImg2 = "dice4.png";
        }
        else if ($this->dice2Num == 5){
            $this->diceImg2 = "dice5.png";
        }
        else if ($this->dice2Num == 6){
            $this->diceImg2 = "dice6.png";
        }
    }

    public function GetPlayerUpInd() {
        return $this->playerUpInd;
    }


    public function setNextPlayerUpInd() {
        /*
        if(($this->playerUpInd + 1) >= (count($this->players))) {
                $this->playerUpInd = 0;
            }
        else {
            $this->playerUpInd += 1;
        }
        */
        if(($this->playerUpInd + 1) < (count($this->players))) {
            $this->playerUpInd += 1;
        }
        else {
            $this->playerUpInd = 0;
        }
    }

    public function getPlayerUp() {
        $ind = $this->playerUpInd;
        $p = $this->players[$ind];
        return $p;
    }

    public function get_player_cards(Player $player) {
        return $player->getPlayerChar();
    }

    public function add_player(Player $player, User $user) {
        $player->setUserID($user->getId());
        $this->numAccused += 1;
        $this->players[] = $player;
        if($player->getPlayerId() == Player::MCC_ID){
            $player->setRow(0);
            $player->setCol(9);
            $n = $this->getNode(0, 9);
            $n->setFilled(true);

            //$n->setBlocked(true);
        }
        else if($player->getPlayerId() == Player::OWE_ID){
            $player->setRow(0);
            $player->setCol(14);
            $n = $this->getNode(0, 14);
            $n->setFilled(true);
            //$n->setBlocked(true);
        }
        else if($player->getPlayerId() == Player::DAY_ID){
            $player->setRow(7);
            $player->setCol(23);
            $n = $this->getNode(7, 23);
            $n->setFilled(true);
            //$n->setBlocked(true);
        }
        else if($player->getPlayerId() == Player::ONS_ID){
            $player->setRow(17);
            $player->setCol(0);
            $n = $this->getNode(17, 0);
            $n->setFilled(true);
            //$n->setBlocked(true);
        }
        else if($player->getPlayerId() == Player::PLU_ID){
            $player->setRow(19);
            $player->setCol(23);
            $n = $this->getNode(19, 23);
            $n->setFilled(true);
            //$n->setBlocked(true);
        }
        else if($player->getPlayerId() == Player::ENB_ID){
            $player->setRow(24);
            $player->setCol(7);
            $n = $this->getNode(24, 7);
            $n->setFilled(true);
            //$n->setBlocked(true);
        }
    }


    public function echo_player() {
        foreach ($this->players as $player) {
            echo $player->getPlayerChar();
        }
    }

    public function set_murder_stuff() {
        $card_info = [["Beaumont", "beaumont.jpg", "location"], ["Breslin", "breslin.jpg", "location"],
            ["Day", "day.jpg", "suspect"], ["Enbody", "enbody.jpg", "suspect"],
            ["Engineering", "engineering.jpg", "location"], ["Final", "final.jpg", "weapon"],
            ["International", "international.jpg", "location"], ["Library", "library.jpg", "location"],
            ["McCullen", "mccullen.jpg", "suspect"], ["Midterm", "midterm.jpg", "weapon"],
            ["Museum", "museum.jpg", "location"], ["Onsay", "onsay.jpg", "suspect"], ["Owen", "owen.jpg", "suspect"],
            ["Plum", "plum.jpg", "suspect"], ["Programming", "programming.jpg", "weapon"],
            ["Project", "project.jpg", "weapon"], ["Quiz", "quiz.jpg", "weapon"],
            ["Stadium", "stadium.jpg", "location"], ["Union", "union.jpg", "location"],
            ["Wharton", "wharton.jpg", "location"], ["Written", "written.jpg", "weapon"]];

        foreach ($card_info as $ele) {
            if ($ele[2] == "suspect") {
                $this->suspects[] = $ele[0];
            }
            else if ($ele[2] == "weapon") {
                $this->weapons[] = $ele[0];
            }
            else {
                $this->locations[] = $ele[0];
            }
        }

        $this->murderer = $this->suspects[rand(0,5)];
        $this->murder_weapon = $this->weapons[rand(0,5)];
        $this->murder_location = $this->locations[rand(0,8)];
    }

    public function newGame() {
        $this->isAccusing = false;
        $this->numAccused = 0;
        $this->players = array();
        $this->cards_displayed = array();
        $this->cards = array();
        $this->locations = array();
        $this->weapons = array();
        $this->suspects = array();
        $this->set_murder_stuff();
        $this->playerUpInd = 0;
        $this->gridFullReset();
        $this->winner = "";
        $this->display_winner = false;
        $this->playOpt = false;
        $this->suggOpt = false;
        $this->murdOpt = false;
        $this->wordOpt = false;
        $this->frozen = false;
    }

    public function getPlayer($r, $c) {
        foreach($this->players as $p) {
            if(($p->getRow() == $r) && ($p->getCol() == $c)) {
                return $p;
            }
        }
        return 0;
    }

    public function getNode($r, $c) {
        $n = $this->grid[$r][$c];
        return $n;
        //return $this->grid[$r][$c];
    }

    public function getImg(Player $p) {
        return $p->getPieceImg();
    }

    public function getGrid() {
        return $this->grid;
    }

    public function resetNodes() {
        for($i = 0; $i < 25; $i++) {
            for($j = 0; $j < 24; $j++) {
                $n = $this->grid[$i][$j];
                $n->setReachable(false);
                $n->setOnPath(false);
                if(($n->isRoomNode()) && (!$this->isPlayerAtPos($i, $j))) {
                    $n->setBlocked(false);
                }
            }
        }
        $p = $this->getPlayerUp();
        foreach($this->players as $pl) {
            if($pl != $p) {
                $r = $pl->getRow();
                $c = $pl->getCol();
                $n = $this->grid[$r][$c];
                if($n->getNodeType() == Node::REGULAR_NODE) {
                    $n->setBlocked(true);
                }
            }
        }
    }

    public function getPlayers() {
        return $this->players;
    }


    public function move($r, $c) {
        $p = $this->getPlayerUp();
        $old_r = $p->getRow();
        $old_c = $p->getCol();
        $n1 = $this->grid[$old_r][$old_c];
        $n1->setFilled(false);
        $p->setRow($r);
        $p->setCol($c);
        $n2 = $this->grid[$r][$c];
        if(!$this->isInRoom($r, $c)) {
            $this->gridFullReset();
            $this->setNextPlayerUpInd();
            $this->rollDice();
        } else {
            $this->gridFullReset();
            $this->frozen = true;
        }
    }

    public function isPlayerAtPos($r, $c) {
        foreach($this->players as $p) {
            $p_row = $p->getRow();
            $p_col = $p->getCol();
            if(($p_row == $r) && ($p_col == $c)) {
                return true;
            }
        }
        return false;
    }

    public function gridFullReset() {
        foreach($this->grid as $row) {
            foreach($row as $col) {
                $col->setBlocked(false);
                $col->setOnPath(false);
                $col->setReachable(false);
            }
        }
    }

    public function setPlayers($arr) {
        $this->players = $arr;
    }

    public function isInRoom($r, $c) {
        $node = $this->grid[$r][$c];
        return $node->isRoomNode();
    }

    public function setPlayOpt($val) {
        $this->playOpt = $val;
    }

    public function setSuggOpt($val) {
        $this->suggOpt = $val;
    }

    public function setMurdOpt($val) {
        $this->murdOpt = $val;
    }

    public function getPlayOpt() {
        return $this->playOpt;
    }

    public function getSuggOpt() {
        return $this->suggOpt;
    }

    public function getMurdOpt() {
        return $this->murdOpt;
    }

    public function getFrozen() {
        return $this->frozen;
    }

    public function setFrozen($f) {
        $this->frozen = $f;
    }

    public function setSuggestProf($s) {
        $this->suggestedProf = $s;

    }

    public function getSuggestProf() {
        return $this->suggestedProf;
    }


    public function setSuggestProfPlayer($s) {
        if($s == Player::OWEN_NAME) {
            $this->suggProfId = Player::OWE_ID;
            foreach($this->getPlayers() as $p) {
                if(Player::OWE_ID == $p->getPlayerId())
                    $this->suggestedProfPlayer = $p;
            }
        }
        else if($s == Player::MCCULLEN_NAME) {
            $this->suggProfId = Player::MCC_ID;
            foreach($this->getPlayers() as $p) {
                if(Player::MCC_ID == $p->getPlayerId())
                    $this->suggestedProfPlayer = $p;
            }
        }
        else if($s == Player::ONSAY_NAME) {
            $this->suggProfId = Player::ONS_ID;
            foreach($this->getPlayers() as $p) {
                if(Player::ONS_ID == $p->getPlayerId())
                    $this->suggestedProfPlayer = $p;
            }
        }
        else if($s == Player::ENBODY_NAME) {
            $this->suggProfId = Player::ENB_ID;
            foreach($this->getPlayers() as $p) {
                if(Player::ENB_ID == $p->getPlayerId())
                    $this->suggestedProfPlayer = $p;
            }
        }
        else if($s == Player::PLUM_NAME) {
            $this->suggProfId = Player::PLU_ID;
            foreach($this->getPlayers() as $p) {
                if(Player::PLU_ID == $p->getPlayerId())
                    $this->suggestedProfPlayer = $p;
            }
        }
        else if($s == Player::DAY_NAME) {
            $this->suggProfId = Player::DAY_ID;
            foreach($this->getPlayers() as $p) {
                if(Player::DAY_ID == $p->getPlayerId())
                    $this->suggestedProfPlayer = $p;
            }
        }
        //$this->suggestedProfPlayer = $s;
    }

    public function getSuggestProfPlayer() {
        return $this->suggestedProfPlayer;
    }

    public function getSuggProfId() {
        return $this->suggProfId;
    }

    public function setMurderWeapon($s) {
        $this->suggestedWeapon = $s;
    }

    public function setRealMurderWeapon($s) {
        $this->murder_weapon = $s;
    }

    public function getMurderWeapon() {
        return $this->suggestedWeapon;
    }

    public function getWordOpt() {
        return $this->wordOpt;
    }

    public function setWordOpt($w) {
        $this->wordOpt = $w;
    }

    public function getNewWord() {
        return $this->newWord;
    }

    public function setNewWord($w) {
        $this->newWord = $w;
    }

    public function getMurderer() {
        return $this->murderer;
    }

    public function getMurderLocation() {
        return $this->murder_location;
    }

    public function getRealMurderWeapon() {
        return $this->murder_weapon;
    }

    private $isAccusing = false;

    public function getIsAccusing() {
        return $this->isAccusing;
    }

    public function setIsAccusing($s) {
        $this->isAccusing = $s;
    }

    public function setWinner($winner) {
        $this->winner = $winner;
    }

    public function getWinner() {
        return $this->winner;
    }

    public function set_display_winner($win) {
        $this->display_winner = $win;
    }

    public function get_display_winner() {
        return $this->display_winner;
    }

    /**
     * @return mixed
     */
    public function getDiceImg1()
    {
        return $this->diceImg1;
    }

    /**
     * @return mixed
     */
    public function getDiceImg2()
    {
        return $this->diceImg2;
    }

    /**
     * @return array
     */
    public function getSuspects()
    {
        return $this->suspects;
    }

    /**
     * @return array
     */
    public function getLocations()
    {
        return $this->locations;
    }

    /**
     * @return array
     */
    public function getWeapons()
    {
        return $this->weapons;
    }

    /**
     * @return mixed
     */
    public function getSuggestedProf()
    {
        return $this->suggestedProf;
    }

    /**
     * @return mixed
     */
    public function getSuggestedProfPlayer()
    {
        return $this->suggestedProfPlayer;
    }

    /**
     * @return mixed
     */
    public function getSuggestedWeapon()
    {
        return $this->suggestedWeapon;
    }

    /**
     * @return mixed
     */
    public function getGameID()
    {
        return $this->gameID;
    }



}