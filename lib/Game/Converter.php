<?php


namespace Game;


class Converter
{


    public function jsonToPlayer($json)
    {
        if (sizeof(array_keys($json)) > 0) {
            $player = new Player(666, "b");
            $arr = $json;

            $player->userID = $arr["userID"];
            $player->playerID = $arr["playerID"];
            $player->playerChar = $arr["playerChar"];
            $player->playerCards = $this->jsonToCards($arr["playerCards"]);
            $player->pos = $arr["pos"];
            $player->madeAccusation = $arr["madeAccusation"];
            $player->col = $arr["col"];
            $player->row = $arr["row"];
            $player->playImg = $arr["playImg"];
            $player->pieceImg = $arr["pieceImg"];
            $player->hasAccused = $arr["hasAccused"];

            return $player;
        }
        return null;

    }

    public function jsonToCard($json){
        if ($json != null) {
            return new Card($json["name"], $json["image"], $json["word"], $json["type"]);
        }
        return null;
    }

    public function jsonToCards($json){
        if ($json != null) {
            $cards = new Cards([]);
            $hand = [];
            $not_in_hand = [];
            $hkeys = array_keys($json["hand"]);
            $nkeys = array_keys($json["not_in_hand"]);
            for ($i = 0; $i < sizeof($hkeys); $i ++){
                if ($this->jsonToCard($json["hand"][$hkeys[$i]]) != null) {
                    $hand[$hkeys[$i]] = $this->jsonToCard($json["hand"][$hkeys[$i]]);
                }
            }
            for ($i = 0; $i < sizeof($nkeys); $i ++){
                if ($this->jsonToCard($json["not_in_hand"][$nkeys[$i]]) != null) {
                    $not_in_hand[$nkeys[$i]] = $this->jsonToCard($json["not_in_hand"][$nkeys[$i]]);
                }
            }
            $cards->hand = $hand;
            $cards->not_in_hand = $not_in_hand;
            return $cards;
        }
        return null;
    }
}