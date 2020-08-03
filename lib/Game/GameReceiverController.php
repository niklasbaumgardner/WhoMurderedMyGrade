<?php


namespace Game;


class GameReceiverController
{

    public function __construct(Site $site, array &$session, array $post, User $user)
    {
        $root = $site->getRoot();


        //check to see if people are added
        if(isset($post['newGameStarter'])) {
            $game = new Game();
            $games = new Games($site);
            $games->add($game, $user);
            $gameId = $game->getGameID();
            //$session[GAME_SESSION] = $game;
            //$this->redirect = "$root/player_selector.php?gid=$gameId";
            $this->redirect = "$root/users.php?id=$gameId";
            return;
        }
        else if(isset($post['gameJoiner'])) {
            $gameId = strip_tags($post['gameJoiner']);
            $games = new Games($site);
            $game = $games->get($gameId);
            //$session[GAME_SESSION] = $game;
            //$this->redirect = "$root/player_selector.php?gid=$gameId";
            //$this->redirect = "$root/player_selector.php?";
            $games->updatePlayer($game, $user);
            $this->redirect = "$root/users.php?id=$gameId";
            return;
        }

        //$root = $site->getRoot();
        $this->redirect = "$root/games.php?e";

        // TODO: USER IS ALWAYS NULL HERE.  The session name is not set for some reason.
        // TODO: MAKE THE REDIRECTION WORK.  Currently each button is in the global form and cannot redirect properly.
        //$this->redirect = "$root/users.php?id=3";

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