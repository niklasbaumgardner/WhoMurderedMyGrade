<?php


namespace Game;


/**
 * A node in the game graph
 */
class Node {

    const REGULAR_NODE = 7;
    const START_NODE = 8;
    //const INNER_ROOM_NODE = 3;
    //const ENTRY_ROOM_NODE = 4;
    const INTERNATIONAL = 9;
    const BRESLIN = 10;
    const BEAUMONT = 11;
    const UNION = 12;
    const MUSEUM = 13;
    const LIBRARY = 14;
    const WHARTON = 15;
    const STADIUM = 16;
    const ENGINEERING = 17;
    const BAD_NODE = 18;

    public function __construct($xP, $yP, $t) {
        $this->x = $xP;
        $this->y = $yP;
        $this->type = $t;
        //$this->to = array();
    }

    public function addTo($to) {
        $this->to[] = $to;
        //$this->to = $to;
        //$this->to = array();
    }


    // x location of node on grid
    private $x;

    // y location of node on grid
    private $y;

    // type of node
    private $type;

    // Pointers to adjacent nodes
    private $to = [];

    // This node is blocked and cannot be visited
    private $blocked = false;

    // This node is on a current path
    private $onPath = false;

    // Node is reachable in the current move
    private $reachable = false;

    //private $contents;

    private $filled = false;

    public function searchReachable($distance, $start) {

        // The path is done if it at the end of the distanc
        if($distance === 0){
            $this->reachable = true;
            return;
        }

        if ($this->isRoomNode()){
            $this->reachable = true;
            if ($this->getNodeType() != $start->getNodeType())
                return;
        }
        /*
        if($distance === 0){
            $this->reachable = true;
            return;
        }
        else if($this->isRoomNode()) {
            $this->reachable = true;
        }
        */

        $this->onPath = true;

        if(count($this->to) > 0) {
            foreach ($this->to as $to) {
                if (!$to->isBlocked() && !$to->isOnPath()) {
                    $to->searchReachable($distance - 1, $start);
                }
            }
        }

        $this->onPath = false;
    }


    public function setFilled($val) {
        $this->filled = $val;
    }

    public function isFilled() {
        return $this->filled;
    }

    /*
    public function clearTo() {
        $this->to = array();
    }
    */

    public function getNodeType() {
        return $this->type;
    }

    public function setBlocked($val) {
        $this->blocked = $val;
    }

    public function setReachable($val) {
        $this->reachable = $val;
    }

    public function setOnPath($val) {
        $this->onPath = $val;
    }

    public function isReachable() {
        return $this->reachable;
    }

    public function isBlocked() {
        return $this->blocked;
    }

    public function isOnPath() {
        return $this->onPath;
    }

    public function getTo() {
        return $this->to;
    }

    public function getX() {
        return $this->x;
    }

    public function getY() {
        return $this->y;
    }

    public function isRoomNode() {
        if(($this->type == self::INTERNATIONAL) ||
            ($this->type == self::BRESLIN) ||
            ($this->type == self::BEAUMONT) ||
            ($this->type == self::UNION) ||
            ($this->type == self::MUSEUM) ||
            ($this->type == self::LIBRARY) ||
            ($this->type == self::WHARTON) ||
            ($this->type == self::STADIUM) ||
            ($this->type == self::ENGINEERING)) {
            return true;
        }
        else {
            return false;
        }
    }

    //public function test_search
}