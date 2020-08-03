<?php




class GamesTest extends \PHPUnit\Framework\TestCase
{
    private static $site;

    public static function setUpBeforeClass() {
        self::$site = new Game\Site();
        $localize  = require 'localize.inc.php';
        if(is_callable($localize)) {
            $localize(self::$site);
        }
    }

    protected function setUp()
    {
        $games = new Game\Games(self::$site);
        $tableName = $games->getTableName();

        $sql = <<<SQL
delete from $tableName
SQL;
        self::$site->pdo()->query($sql);
    }

    public function test_pdo() {
        $users = new Game\Users(self::$site);
        $this->assertInstanceOf('\PDO', $users->pdo());
    }

//    public function test_add() {
//        $row = array('id' => 9, 'email' => 'test@gmail.com', 'name' => 'test', 'joined' => 'now');
//        $user = new Game\User($row);
//
//        $game = new Game\Game();
//        $game->setPlayers(["nik", "klas", "blake", "hunter"]);
//
//        $games = new Game\Games(self::$site);
//        $table = $games->getTableName();
//
//
//        $sql = <<<SQL
//INSERT INTO $table (id, created, open, gamestate, playercount, p1id, p2id, p3id, p4id, p5id, p6id)
//values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
//SQL;
//
//        $stmt = $games->pdo()->prepare($sql);
//        $stmt->execute([2, 'now', 1, 'state', 1, 9, 0, 0, 0, 0, 0]);
//
//
//        $sql = <<<SQL
//INSERT INTO $table (id, created, open, gamestate, playercount, p1id, p2id, p3id, p4id, p5id, p6id)
//values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
//SQL;
//
//        $stmt = $games->pdo()->prepare($sql);
//        $stmt->execute([3, 'now', 1, 'state', 1, 9, 0, 0, 0, 0, 0]);
//
//        $games->add($game, $user);
//
//        echo $game->getID();
//        $this->assertEquals(3, 4);
//



//        $games = new Game\Games(self::$site);
//        $table = $games->getTableName();
//        $games->add($game, $user);
//        //echo $table;
//        $sql = <<<SQL
//select * from $table
//SQL;
//        $stmt = $games->pdo()->prepare($sql);
//        $stmt->execute();
//        $this->assertEquals(1, $stmt->rowCount());




//        $games->add($game);
//        $stmt = $games->pdo()->prepare($sql);
//        $stmt->execute();
//        $this->assertEquals(3, $stmt->rowCount());

//        $game2 = new Game\Game();
//        $game2->setPlayers(["nik", "blake"]);
//        $games->add($game2);
//        $stmt = $games->pdo()->prepare($sql);
//        $stmt->execute();
//        $this->assertEquals(2, $stmt->rowCount());
//
//
//        $game3 = new Game\Game();
//        $game3->setPlayers(["nik", "blake", "3", "4", "5", "6"]);
//        $games->add($game3);
//        $stmt = $games->pdo()->prepare($sql);
//        $stmt->execute();
//        $this->assertEquals(3, $stmt->rowCount());
//    }

//    public function test_load()
//    {
//        $games = new Game\Games(self::$site);
//        $table = $games->getTableName();
//        $game = new Game\Game();
//        $correct = new Game\Game();
//
//
//        // ID is 1
//        $games->add($game);
//
//        $sql = <<<SQL
//UPDATE $table
//SET gamestate=?
//where id=?
//SQL;
//
//        $correct->setID(1);
//        $correct->setPlayers(["nik", "klas", "blake", "hunter"]);
//
//        $correct->setWinner('nik');
//        $correct->setDice1Num(4);
//        $correct->setDice2Num(4);
//        $correct->setPlayerUpInd(3);
//
//        $json = $games->createJSON($correct);
//
//
//        $stmt = $games->pdo()->prepare($sql);
//        $stmt->execute([$json, 1]);
//
//        $game = $games->load($game);
//
//        $this->assertEquals($correct->getID(), $game->getID());
//        $this->assertEquals($correct->getPlayers(), $game->getPlayers());
//        $this->assertEquals($correct->getWinner(), $game->getWinner());
//        $this->assertEquals($correct->getDice1Num(), $game->getDice1Num());
//        $this->assertEquals($correct->getDice2Num(), $game->getDice2Num());
//        $this->assertEquals($correct->getPlayerUp(), $game->getPlayerUp());
//
//    }

//    public function test_update() {
//        $row = array('id' => 9, 'email' => 'test@gmail.com', 'name' => 'test', 'joined' => 'now');
//        $user = new Game\User($row);
//
//        $games = new Game\Games(self::$site);
//        $table = $games->getTableName();
//        $game = new Game\Game();
//        $correct = new Game\Game();
//
//        $correct->setPlayers(["nik", "klas", "blake", "hunter"]);
//
//        $correct->setID(1);
//        $correct->setWinner('nik');
//        $correct->setDice1Num(4);
//        $correct->setDice2Num(4);
//        $correct->setPlayerUpInd(3);
//
//
//        // ID is 1
//        $games->add($game, $user);
//
//        $games->update($correct);
//
//        $game = $games->load($correct);
//
//        $this->assertEquals($correct->getID(), $game->getID());
//        $this->assertEquals($correct->getPlayers(), $game->getPlayers());
//        $this->assertEquals($correct->getWinner(), $game->getWinner());
//        $this->assertEquals($correct->getDice1Num(), $game->getDice1Num());
//        $this->assertEquals($correct->getDice2Num(), $game->getDice2Num());
//        $this->assertEquals($correct->getPlayerUp(), $game->getPlayerUp());
//    }

//    public function test_close() {
//        $row = array('id' => 9, 'email' => 'test@gmail.com', 'name' => 'test', 'joined' => 'now');
//        $user = new Game\User($row);
//
//        $games = new Game\Games(self::$site);
//        $table = $games->getTableName();
//        $game = new Game\Game();
//
//        $games->add($game, $user);
//
//        $sql = <<<SQL
//select open
//from $table
//where id=?
//SQL;
//        $stmt = $games->pdo()->prepare($sql);
//        $stmt->execute([$game->getID()]);
//
//        $open = $stmt->fetchAll(\PDO::FETCH_ASSOC)[0]['open'];
//
//        $this->assertEquals(1, $open);
//
//        $games->close_game($game->getID());
//
//        $sql = <<<SQL
//select open
//from $table
//where id=?
//SQL;
//        $stmt = $games->pdo()->prepare($sql);
//        $stmt->execute([$game->getID()]);
//
//        $open = $stmt->fetchAll(\PDO::FETCH_ASSOC)[0]['open'];
//
//        $this->assertEquals(0, $open);
//
//    }

}