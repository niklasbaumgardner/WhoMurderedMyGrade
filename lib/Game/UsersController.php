<?php


namespace Game;

class UsersController {
    public function __construct(Site $site) {
        $root = $site->getRoot();

    }

    /**
     * @return mixed
     */
    public function getRedirect() {
        return $this->redirect;
    }


    private $redirect;
}