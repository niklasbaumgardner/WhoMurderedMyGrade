<?php


namespace Game;


class Games extends Table
{

//    $this->id = $row['id'];
//    $this->email = $row['email'];
//    $this->name = $row['name'];
//    $this->joined = strtotime($row['joined']);

    /**
     * Constructor
     * @param $site The Site object
     */
    public function __construct(Site $site) {
        parent::__construct($site, "game");
    }


    public function add(Game $game, User $user) {
        $sql = <<<SQL
SELECT id from $this->tableName
SQL;
        $stmt = $this->pdo()->prepare($sql);
        $stmt->execute();

        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
//        echo "<pre>";
//        print_r($row);
//        echo "</pre>";
        $id = $stmt->rowCount() + 1;
        foreach ($row as $g)
        {
            if ($g['id'] == $id)
            {
                $id += 1;
            }
        }
        $game->setID($id);

        $sql = "";

        $sql = <<<SQL
INSERT INTO $this->tableName(id, created, open, gamestate, playercount, p1id, p2id, p3id, p4id, p5id, p6id)
values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
SQL;

        $mccullen = new \Game\Player(Player::MCC_ID, 'McCullen');
        $game->add_player($mccullen, $user);
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $players = $game->getPlayers();
        $file = $this->createJSON($game);

        $arr = [$id, date("Y-m-d H:i:s"), 1, $file, 1, $user->getId()];
        /*
        foreach ($players as $player)
        {
            $arr[] = $player;
        }
        */

        for ($i = 0; $i < (6 - sizeof($players)); $i++)
        {
            $arr[] = "";
        }

//        echo sizeof($arr);
//        foreach ($arr as $item) {
//            echo $item . ", ";
//        }
        $statement->execute($arr);
        echo $statement->rowCount();
    }

    public function close_game($id)
    {
        $sql = <<<SQL
UPDATE $this->tableName
SET open=?
where id=?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute([0, $id]);
    }


    public function update(Game $game) {
        $sql = <<<SQL
UPDATE $this->tableName
SET gamestate=?
where id=?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $file = $this->createJSON($game);

        $statement->execute([$file, $game->getID()]);


    }

    public function updatePlayer(Game $game, User $user) {
        $dbGame = $this->getWholeGame($game->getGameID());
        $player_count = $dbGame['playercount'];

        $sql = "UPDATE $this->tableName ";
        if($player_count == 0) {
            $sql .= "SET p1id=?";
            $mccullen = new \Game\Player(Player::MCC_ID, 'McCullen');
            $game->add_player($mccullen, $user);
            $this->update($game);
        }
        else if($player_count == 1) {
            $sql .= "SET p2id=?";
            $owen = new \Game\Player(Player::OWE_ID, 'Owen');
            $game->add_player($owen, $user);
            $this->update($game);
        }
        else if($player_count == 2) {
            $sql .= "SET p3id=?";
            $day = new \Game\Player(Player::DAY_ID, 'Day');
            $game->add_player($day, $user);
            $this->update($game);
        }
        else if($player_count == 3) {
            $sql .= "SET p4id=?";
            $plum = new \Game\Player(Player::PLU_ID, 'Plum');
            $game->add_player($plum, $user);
            $this->update($game);
        }
        else if($player_count == 4) {
            $sql .= "SET p5id=?";
            $enbody = new \Game\Player(Player::ENB_ID, 'Enbody');
            $game->add_player($enbody, $user);
            $this->update($game);
        }
        else if($player_count == 5) {
            $sql .= "SET p6id=?";
            $onsay = new \Game\Player(Player::ONS_ID, 'Onsay');
            $game->add_player($onsay, $user);
            $this->update($game);
        }
        $sql .= ", playercount=? ";
        $sql .= "WHERE id=?";


        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $player_count += 1;

        $statement->execute([$user->getId(), $player_count, $game->getID()]);

    }

    public function load(Game $game) {
        $sql = <<<SQL
SELECT gamestate from $this->tableName
where id=?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute([$game->getID()]);

        $game_state = $statement->fetchAll(\PDO::FETCH_ASSOC)[0]['gamestate'];
        $game = $this->loadFromJSON($game_state);

        return $game;
    }



    public function createJSON(Game $game) {
        $arr = array(
            "diceImg1" => $game->getDiceImg1(),
            "diceImg2" => $game->getDiceImg2(),
            "players" => $game->getPlayers(),
            "cards_displayed" => $game->get_cards_displayed(),
            "cards" => $game->get_cards(),
            "suspects" => $game->getSuspects(),
            "locations" => $game->getLocations(),
            "weapons" => $game->getWeapons(),
            "murderer" => $game->getMurderer(),
            "murder_weapon" => $game->getRealMurderWeapon(),
            "murder_location" => $game->getMurderLocation(),
            "winner" => $game->getWinner(),
            "suggestedProf" => $game->getSuggestedProf(),
            "suggestedProfPlayer" => $game->getSuggestedProfPlayer(),
            "suggProfId" => $game->getSuggProfId(),
            "suggestedWeapon" => $game->getSuggestedWeapon(),
            "wordOpt" => $game->getWordOpt(),
            "newWord" => $game->getNewWord(),
            "gameID" => $game->getGameID(),
            "playerUpInd" => $game->getPlayerUpInd(),
            "TotalNumMives" => $game->getTotalNumMoves(),
            "dice1Num" => $game->getDice1Num(),
            "dice2Num" => $game->getDice2Num(),
            "playOpt" => $game->getPlayOpt(),
            "suggOpt" => $game->getSuggOpt(),
            "murdOpt" => $game->getMurdOpt(),
            "frozen" => $game->getFrozen(),
            "display_winner" => $game->get_display_winner(),
            "numAccused" => $game->getNumAccused(),
            "isAccusing" => $game->getIsAccusing()
        );
        return json_encode($arr);
    }

    public function loadFromJSON($json) {
        $game = new Game();
        $arr = json_decode($json, true);


        $game->setDiceImg1($arr["diceImg1"]);
        $game->setDiceImg2($arr["diceImg2"]);


        $players = [];
        $con = new Converter();
        for ($i = 0; $i < sizeof($arr["players"]); $i ++) {
            if ($con->jsonToPlayer($arr["players"][$i]) != null) {
                array_push($players, $con->jsonToPlayer($arr["players"][$i]));
            }
        }

        $game->setPlayers($players);
        $game->setCardsDisplayed($arr["cards_displayed"]);
        $game->setCards($arr["cards"]);
        $game->setSuspects($arr["suspects"]);
        $game->setLocations($arr["locations"]);
        $game->setWeapons($arr["weapons"]);
        $game->setMurderer($arr["murderer"]);
        $game->setRealMurderWeapon($arr["murder_weapon"]);
        $game->setMurderLocation($arr["murder_location"]);
        $game->setWinner($arr["winner"]);
        $game->setSuggestedProf($arr["suggestedProf"]);
        $game->setSuggestedProfPlayer($arr["suggestedProfPlayer"]);
        $game->setSuggProfId($arr["suggProfId"]);
        $game->setSuggestedWeapon($arr["suggestedWeapon"]);
        $game->setWordOpt($arr["wordOpt"]);
        $game->setNewWord($arr["newWord"]);
        $game->setGameID($arr["gameID"]);
        $game->setPlayerUpInd($arr["playerUpInd"]);
        $game->setTotalNumMoves($arr["TotalNumMives"]);
        $game->setDice1Num($arr["dice1Num"]);
        $game->setDice2Num($arr["dice2Num"]);
        $game->setPlayOpt($arr["playOpt"]);
        $game->setSuggOpt($arr["suggOpt"]);
        $game->setMurdOpt($arr["murdOpt"]);
        $game->setFrozen($arr["frozen"]);
        $game->set_display_winner($arr["display_winner"]);
        $game->setNumAccused($arr["numAccused"]);
        $game->setIsAccusing($arr["isAccusing"]);


        return $game;
    }

    public function getGames() {
        $sql = <<<SQL
SELECT *
FROM $this->tableName 
WHERE open=1
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array());
        if($statement->rowCount() === 0){
            return null;
        }
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }


    public function get($id) {
        $sql =<<<SQL
SELECT * from $this->tableName
where id=?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($id));
        if($statement->rowCount() === 0) {
            return null;
        }
        $json = $statement->fetch(\PDO::FETCH_ASSOC)['gamestate'];
        $game = $this->loadFromJson($json);
        return $game;
        //return new Game($statement->fetch(\PDO::FETCH_ASSOC)['gamestate']);
        //return;
    }

    public function getJSON($id) {
        $sql =<<<SQL
SELECT * from $this->tableName
where id=?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($id));
        if($statement->rowCount() === 0) {
            return null;
        }
        $json = $statement->fetch(\PDO::FETCH_ASSOC)['gamestate'];
        return $json;
        //return new Game($statement->fetch(\PDO::FETCH_ASSOC)['gamestate']);
        //return;
    }

    public function getWholeGame($id) {
        $sql =<<<SQL
SELECT * from $this->tableName
where id=?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($id));
        if($statement->rowCount() === 0) {
            return null;
        }
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    public function addPlayer(User $user) {
        $id = $user->getId();
        return;
    }

    public function getPlayers($id){
        $sql =<<<SQL
SELECT * from $this->tableName
where id=?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($id));
        if($statement->rowCount() === 0) {
            return null;
        }
        $s = $statement->fetch(\PDO::FETCH_ASSOC);
        if($s['playercount'] == 1) {
            return [$s["p1id"]];
        }
        else if($s['playercount'] == 2) {
            return [$s['p1id'], $s['p2id']];
        }
        else if($s['playercount'] == 3) {
            return [$s['p1id'], $s['p2id'], $s['p3id']];
        }
        else if($s['playercount'] == 4) {
            return [$s['p1id'], $s['p2id'], $s['p3id'], $s['p4id']];
        }
        else if($s['playercount'] == 5) {
            return [$s['p1id'], $s['p2id'], $s['p3id'], $s['p4id'], $s['p5id']];
        }
        else if($s['playercount'] == 6) {
            return [$s["p1id"],$s["p2id"],$s["p3id"],$s["p4id"],$s["p5id"],$s["p6id"]];
        }
    }

}

