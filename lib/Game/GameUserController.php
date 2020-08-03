<?php


namespace Game;


class GameUserController
{


    public $game;
    public $json;
    public $json2;
    public $gggame;

    public function __construct(Site $site, array &$session, array $get)
    {

        $root = $site->getRoot();
        //check to see if people are added
        if(isset($get["id"])) {
            $gameid = $get["id"];
            $games = new Games($site);
            $game = $games->get($gameid);

            //$game = new Game();
            /*
            $this->game = $game;
            $this->json = $games->getJSON($gameid);

            $ggame = new Game();
            $mccullen = new \Game\Player(Player::MCC_ID, 'McCullen');
            $ggame->add_player($mccullen);
            $this->json2 = $games->createJSON($ggame);
            $this->gggame = $games->loadFromJSON($this->json2);

            */

            $session[GAME_SESSION] = $game;
            $whole_game = $games->getWholeGame($gameid);
            $is_open = $whole_game['open'];

            if(!$is_open) {
                $this->redirect = "$root/game_board.php";
                return;
            }
            $game->set_murder_stuff();
            $games->close_game($game->getID());
            $game->deal();
            $game->rollDice();
            $games->update($game);

            /*
                * PHP code to cause a push on a remote client.
            */
//            $msg = json_encode(array('key'=>'saginawawavfbabvac', 'cmd'=>'reload'));
//
//            $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
//
//            $sock_data = socket_connect($socket, '127.0.0.1', 8078);
//            if(!$sock_data) {
//                echo "Failed to connect";
//            } else {
//                socket_write($socket, $msg, strlen($msg));
//            }
//            socket_close($socket);

            // TODO: ACTUALLY IMPLEMENT THE BEGINNING OF THE GAME WITH THESE CHARACTERS, CURRENTLY NOTHING IS SET AND NO PLAYERS EXIST IN-GAME

            $session[GAME_SESSION] = $game;
            $this->redirect = "$root/game_board.php";
            return;
        }


        $this->redirect = "$root/games.php?e";

    }


    /**
     * @return string
     */
    public function getRedirect()
    {
        return $this->redirect;
    }

    private $redirect;    // Page we will redirect the user to.

}