<?php


namespace Game;

// This is a basic game state class
class GameState
{
    public function __construct(Game $game) {
        $this->game = $game;
    }

    private $game;
}