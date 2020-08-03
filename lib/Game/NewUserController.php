<?php


namespace Game;


class NewUserController
{
    public function __construct(Site $site, array $post) {
        $root = $site->getRoot();
//        echo $post['ok'];

        if(!isset($post['ok'])) {
            $this->redirect = "$root/new_user.php";
            echo "not create";
            return;
        }

        if ($post['email'] == "") {
            $this->redirect = "$root/new_user.php?e=" . NewUserView::NO_EMAIL;
            echo "email bad";
            return;
        }

        $users = new Users($site);

        $id = 0;
        $email = strip_tags($post['email']);
        $name = strip_tags($post['name']);

        if ($users->exists($email)) {
            $this->redirect = "$root/new_user.php?e=" . NewUserView::EMAIL_EXISTS;
            return;
        }

        $row = ['id' => $id,
            'email' => $email,
            'name' => $name,
            'joined' => null];

        $user = new User($row);

        // This is a new user
        $mailer = new Email();
        $users->add($user, $mailer);

        $this->redirect = "$root/login.php";
    }


    /**
     * @return string
     */
    public function getRedirect()
    {
        return $this->redirect;
    }


    private $redirect;	// Page we will redirect the user to.


}