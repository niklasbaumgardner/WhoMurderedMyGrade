<?php


class GameTest extends \PHPUnit\Framework\TestCase
{
    public function test() {
        $game = new Game\Game();
        $this->assertInstanceOf('Game\Game', $game);
    }

    public function test_getNode() {
        $game = new Game\Game();

        $n1 = $game->getNode(0, 9);
        $n2 = $game->getNode(2, 3);
        $n3 = $game->getNode(1, 8);

        //$this->assertInstanceOf('Game/Noode', $n1);
        $t1 = $n1->getNodeType();
        $this->assertEquals($t1, Game\Node::START_NODE);

        $t2 = $n2->getNodeType();
        $this->assertEquals($t2, Game\Node::INTERNATIONAL);

        $t3 = $n3->getNodeType();
        $this->assertEquals($t3, Game\Node::REGULAR_NODE);
    }

    public function test_getGrid() {
        $game = new Game\Game();

        $grid = $game->getGrid();

        $c = count($grid);

        $this->assertEquals($c, 25);
    }

    public function test_getPlayers() {
        $game = new Game\Game();
        //$this->addSomePlayers($game);

        $p = $game->getPlayers();
        $c = count($p);
        //$this->assertEquals($c, 6);

    }

    public function test_getPlayer() {
        $game = new Game\Game();
        //$this->addSomePlayers($game);

        $p = $game->getPlayer(0, 14);

        //$id = $p->getPlayerId();
        //$this->assertEquals($id, Game\Player::OWE_ID);
    }

    public function test_addPlayers() {
        $game = new Game\Game();
        //$this->addSomePlayers($game);

        $ps = $game->getPlayers();
        $c = count($ps);
        //$this->assertEquals($c, 6);

        $p = $game->getPlayer(0, 14);

        //$id = $p->getPlayerId();
        //$this->assertEquals($id, Game\Player::OWE_ID);

        //echo "<pre>";

        //print_r($ps);

        //echo "</pre>";
    }

    public function addSomePlayers(Game\Game $game) {
        $owen = new Game\Player(1, 'Owen');
        $game->add_player($owen);
        $mccullen = new Game\Player(2, 'McCullen');
        $game->add_player($mccullen);
        $onsay = new Game\Player(3, 'Onsay');
        $game->add_player($onsay);
        $enbody = new Game\Player(4, 'Enbody');
        $game->add_player($enbody);
        $plum = new Game\Player(5, 'Plum');
        $game->add_player($plum);
        $day = new Game\Player(6, 'Day');
        $game->add_player($day);
    }


}