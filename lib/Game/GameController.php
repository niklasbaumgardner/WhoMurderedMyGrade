<?php

namespace Game;



class GameController
{
    private $site;
    public function __construct(Game $game, $post, $site) {
        $games = new Games($site);
        $game = $games->get($game->getID());


        $this->site = $site;
        $this->game = $game;
        $this->post_val = $post;



        if(isset($post['cell'])){
            $split = explode(',', strip_tags($post['cell']));
            //intval($split[0]), intval($split[1]);
            $r = +$split[0];
            $c = +$split[1];
            $this->move($r, $c);
            if($this->game->isInRoom($r, $c)) {
                $this->game->setPlayOpt(true);
            }

        }
        else if(isset($post['ng'])) {
            $this->reset = true;
            $this->page = 'index.php';
        }
        else if(isset($post['psa'])) {
            if ($post['psaa'] == "Pass") {
                $this->game->setFrozen(false);
                $this->game->setSuggOpt(false);
                $this->game->setPlayOpt(false);
                $this->game->setNextPlayerUpInd();
                $this->game->rollDice();
            } else if ($post['psaa'] == "Suggest") {
                //do suggest stuff

                $this->game->setPlayOpt(false);
                $this->game->setSuggOpt(true);

            } else if ($post['psaa'] == "Accuse") {
                $p = $this->game->get_current_player();

                if (!$p->getHasAccused()) {
                    $p->setHasAccused(true);
                    $this->game->setNumAccused($this->game->getNumAccused() - 1);
                    $this->game->setIsAccusing(true);
                    $this->game->setPlayOpt(false);
                    $this->game->setSuggOpt(true);
                }

            }
        }
        else if (isset($post["suggestProf"])) {
            $this->game->setSuggestProf($post["radgroup"]);
            $this->game->setSuggestProfPlayer($post["radgroup"]);
            /*
            if(($post["radgroup"]) == Player::OWEN_NAME) {
                $this->game->setSuggestedProfId(Player::OWE_ID);
            }
            else if(($post["radgroup"]) == Player::MCCULLEN_NAME) {
                $this->game->setSuggestedProfId(Player::MCCULLEN_ID);
            }
            else if(($post["radgroup"]) == Player::ONSAY_NAME) {
                $this->game->setSuggProfId = Player::ONS_ID;
            }
            else if(($post["radgroup"]) == Player::ENBODY_NAME) {
                $this->game->setSuggProfId = Player::ENBODY_ID;
            }
            else if(($post["radgroup"]) == Player::PLUM_NAME) {
                $this->game->setSuggProfId = Player::OWE_ID;
            }
            else if(($post["radgroup"]) == Player::DAY_NAME) {
                $this->game->setSuggProfId = Player::PLUM_ID;
            }
            */
            $this->game->setSuggOpt(false);
            $this->game->setMurdOpt(true);
        }
        else if (isset($post["suggestWeapon"])) {
            $this->game->setMurderWeapon($post["radgroup"]);
            $row = $this->game->get_current_player()->getRow();
            $col = $this->game->get_current_player()->getCol();
            $n = $this->game->getNode($row, $col);
            $type = $n->getNodeType();
            $loc = "";
            if($type == Node::INTERNATIONAL) {
                $loc = "International";
            }
            else if ($type == Node::BRESLIN) {
                $loc = "Breslin";
            }
            else if ($type == Node::BEAUMONT) {
                $loc = "Beaumont";
            }
            else if ($type == Node::UNION) {
                $loc = "Union";
            }
            else if ($type == Node::MUSEUM) {
                $loc = "Museum";
            }
            else if ($type == Node::LIBRARY) {
                $loc = "Library";
            }
            else if ($type == Node::WHARTON) {
                $loc = "Wharton";
            }
            else if ($type == Node::STADIUM) {
                $loc = "Stadium";
            }
            else if ($type == Node::ENGINEERING){
                $loc = "Engineering";
            }


            $this->game->setMurdOpt(false);
            $this->game->setWordOpt(true);

            $murderer = $this->game->getMurderer();
            $sugMurderer = explode(" ", $this->game->getSuggestProf())[1];

            $murderWeapon = $this->game->getRealMurderWeapon();
            $sugMurderWeapon = explode(" ", $this->game->getMurderWeapon())[0];

            $murderLoc = $this->game->getMurderLocation();
            $sugMurderLoc = $loc;

            $posse = array();
            if ($murderer != $sugMurderer) {
                array_push($posse, $sugMurderer);
            }
            if ($murderWeapon != $sugMurderWeapon) {
                array_push($posse, $sugMurderWeapon);
            }
            if ($murderLoc != $sugMurderLoc) {
                array_push($posse, $sugMurderLoc);
            }

            $p = $this->game->get_current_player();
            $pc = $p->getPlayerCards();
            $hand = $pc->getNotInHand();
            $keys = array_keys($hand);

            $words = array();

            $debug = "";

            foreach ($posse as $item) {
                $debug .= " " . $item;
                if (in_array($item, $keys)) {
                    array_push($words, $hand[$item]->getWord());
                    $debug .= " " . $hand[$item]->getWord();
                }
            }

            $streetWord = "I got nothing.";




            if (count($words) > 0) {
                shuffle($words);
                $streetWord = $words[0];
                if ($this->game->getIsAccusing()) {
                    if ($this->game->getNumAccused() == 0) {
                        $this->game->set_display_winner(true);
                        $this->game->setFrozen(true);
                        $this->game->setWordOpt(false);
                        $this->game->setNumAccused(-1);
                    } else {
                        $this->game->setIsAccusing(false);
                    }
                }

            } else if ($this->game->getIsAccusing()) {
                $streetWord = "I got nothing.";
                if (count($posse) == 0) {
                    $p = $this->game->get_current_player();
                    // TODO $p wins here
                    $this->game->setWinner($p->getPlayerChar());
                    $this->game->set_display_winner(true);
                    $this->game->setFrozen(true);
                    $this->game->setWordOpt(false);
                } else {
                    $this->game->setIsAccusing(false);
                }
                // freeze game ?
            }



            //$streetWord .= " ~ " . $debug;

            //$streetWord .= "~" . $murderer . " " . $murderWeapon . " " . $murderLoc;
            $this->game->setNewWord($streetWord );

    }

        else if (isset($post['gotWord'])) {
            $this->game->setFrozen(false);
            $this->game->setSuggOpt(false);
            $this->game->setPlayOpt(false);
            $this->game->setWordOpt(false);
            $this->game->setNextPlayerUpInd();
            $this->game->rollDice();


        }


/*
        if ($this->game->getNumAccused() == 0) {
            $this->game->set_display_winner(true);
            $this->game->setFrozen(true);
            $this->game->setWordOpt(false);
            $this->game->setNumAccused(-1);
        }
*/

/*
        else if (isset($post['Pass'])) {
            $this->game->setNextPlayerUpInd();
            $this->game->rollDice();
        }

        else if (isset($post['Accuse'])) {
            //
        }

        else if (isset($post['Suggest'])) {
            // doesn't work
            $this->game->setSuggOpt(true);
        }
*/

        $games = new Games($this->site);
        $games->update($this->game);


        /*
 * PHP code to cause a push on a remote client.
 */
        $msg = json_encode(array('key'=>'saginawawavfbabvac' . $game->getID(), 'cmd'=>'reload'));

        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

        $sock_data = socket_connect($socket, '127.0.0.1', 8078);
        if(!$sock_data) {
            echo "Failed to connect";
        } else {
            socket_write($socket, $msg, strlen($msg));
        }
        socket_close($socket);
    }

    public function move($r, $c) {
        $games = new Games($this->site);
        $games->update($this->game);
        // check for it moving into room or something
        $this->game->move($r, $c);

        $games = new Games($this->site);
        $games->update($this->game);

    }

    public function isReset(){
        return $this->reset;
    }

    public function get_post_val() {
        return $this->post_val;
    }

    public function getPage() {
        return $this->page;
    }


    private $game;
    private $reset = false;
    private $post_val;
    private $page ='game_board.php';
    // to do
    // 1 person wins
    // everybody loses
}