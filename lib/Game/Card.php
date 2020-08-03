<?php


namespace Game;


class Card
{
    /*
     * USAGE:  Every player has one instance of Cards, which has a whole set of Card instances.
     */

    public $name; // the title of the card
    public $image; // the image which is used
    public $word; // the word (possibly empty) which is attached to the card
    public $type; // type of the card. (suspect, weapon, location)

    // TODO: I have no idea whether these will be the right size, but they are the image sizes
    const CARD_HEIGHT = 505 / 2;
    const CARD_WIDTH = 342 / 2;

    public function __construct($name, $image, $word="", $type="") {
        /*
         * $name, $image, and $word are all strings.
         */


        $this->name = $name;
        $this->image = $image;
        $this->type = $type;
        $this->word = $word;

    }

    public function getName() {
        // gets the name
        return $this->name;
    }

    public function getImage() {
        // gets the image
        return $this->image;
    }

    public function getWord() {
        // gets the word
        return $this->word;
    }

    public function display() {
        // displays the html for the card
        $h = Card::CARD_HEIGHT;
        $w = Card::CARD_WIDTH;
        $html = <<<HTML
<div class="card">
    <p class="cardImage"><img src="images/$this->image" alt="$this->name" height="auto" width="auto"></p>
    
HTML;
        if ($this->word != "") {  // if the card isn't in the hand, we add the extra word
            $html .= <<<HTML
    <p class="cardWord">$this->word</p>
    
HTML;
        }
        $html .= <<<HTML
</div>
HTML;
        return $html;
    }

}