<?php


namespace tests;


use Game\Player;

class PlayerTest extends \PHPUnit\Framework\TestCase
{
    public function test_construct(){
        $player = new Player(1, "Owen");


        $this->assertEquals(1, $player->getPlayerId());
        $this->assertEquals("Owen", $player->getPlayerChar());
        $this->assertEquals(0, $player->getPos());

        $row = $player->setRow(12);
        $col = $player->setCol(81);

        $this->assertEquals(12, $player->getRow());
        $this->assertEquals(81, $player->getCol());

        $this->assertEquals("owen.jpg", $player->getPlayImg());
        $this->assertEquals("images/owen-piece.png", $player->getPieceImg());

        $player->set_player_cards(["McCullen"]);


    }

    public function test_accused(){
        $player = new Player(1, "Owen");

        $accused = $player->setHasAccused("McCullen");
        $this->assertEquals("McCullen", $player->getHasAccused());
        $this->assertEquals(false, $player->getAccusation());
    }

    public function test_get_char() {
        $player = new Player(1, "Owen");
        $img = $player->getPlayImg();
        $char = $player->getPlayerChar();
        $id = $player->getPlayerId();
        $acc = $player->getHasAccused();
        $hand = $player->getPlayerCards();
        $hacc = $player->getAccusation();


        $this->assertEquals("owen.jpg", $img);
        $this->assertEquals(1, $id);
        $this->assertEquals("Owen", $char);
        $this->assertEquals([], $hand);
        $this->assertEquals(false, $acc);
        $this->assertEquals(false, $hacc);

        $player = new Player(2, "Plum");
        $char = $player->getPlayerChar();
        $id = $player->getPlayerId();
        $acc = $player->getHasAccused();
        $hand = $player->getPlayerCards();
        $hacc = $player->getAccusation();


        $this->assertEquals(2, $id);
        $this->assertEquals("Plum", $char);
        $this->assertEquals([], $hand);
        $this->assertEquals(false, $acc);
        $this->assertEquals(false, $hacc);

        $player = new Player(3, "Nik");
        $char = $player->getPlayerChar();
        $id = $player->getPlayerId();
        $acc = $player->getHasAccused();
        $hand = $player->getPlayerCards();
        $hacc = $player->getAccusation();


        $this->assertEquals(3, $id);
        $this->assertEquals("Nik", $char);
        $this->assertEquals([], $hand);
        $this->assertEquals(false, $acc);
        $this->assertEquals(false, $hacc);

        $player = new Player(0, "jeremy");
        $char = $player->getPlayerChar();
        $id = $player->getPlayerId();
        $acc = $player->getHasAccused();
        $hand = $player->getPlayerCards();
        $hacc = $player->getAccusation();


        $this->assertEquals(0, $id);
        $this->assertEquals("jeremy", $char);
        $this->assertEquals([], $hand);
        $this->assertEquals(false, $acc);
        $this->assertEquals(false, $hacc);
    }





}