<?php

namespace Game;

class StartController {
    private $game;
    private $reset = false;

    public function isReset(){
        return $this->reset;
    }

    public function __construct(Game $game, $post) {
        $this->game = $game;

    }



}