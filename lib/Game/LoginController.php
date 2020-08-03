<?php


namespace Game;


class LoginController
{
    /**
     * LoginController constructor.
     * @param Site $site The Site object
     * @param array $session $_SESSION
     * @param array $post $_POST
     */
    public function __construct(Site $site, array &$session, array $post)
    {
        // Create a Users object to access the table
        $users = new Users($site);

        $email = strip_tags($post['email']);
        $password = strip_tags($post['password']);
        $user = $users->login($email, $password);
        $session[User::SESSION_NAME] = $user;

        $root = $site->getRoot();
        if ($user === null) {
            // Login failed
            $this->redirect = "$root/login.php?e";
        } else {
            // TODO after login where to redirect to...
            //$this->redirect = "$root/index.php";
            $this->redirect = "$root/games.php";
        }

    }

    private $redirect;    // Page we will redirect the user to.

    public function getRedirect()
    {
        return $this->redirect;
    }

}