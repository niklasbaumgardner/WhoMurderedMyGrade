<?php

namespace Game;

class Cards
{

    /*
     * USAGE:  Every player has one instance of Cards.
     */
    public $words = ['area', 'book', 'business', 'case', 'child', 'company', 'country', 'eye', 'fact', 'family',
        'government', 'group', 'hand', 'home', 'job', 'life', 'lot', 'man', 'money', 'month', 'mother', 'night',
        'number', 'part', 'people', 'place', 'point', 'problem', 'program', 'question', 'right', 'room', 'school',
        'state', 'story', 'student', 'study', 'system', 'thing', 'time', 'water', 'way', 'week', 'woman', 'word',
        'work', 'world', 'year'];


    const CARD_INFO = array(
        "Beaumont" => "beaumont.jpg",
        "Breslin" => "breslin.jpg",
        "Day" => "day.jpg",
        "Enbody" => "enbody.jpg",
        "Engineering" => "engineering.jpg",
        "Final" => "final.jpg",
        "International" => "international.jpg",
        "Library" => "library.jpg",
        "McCullen" => "mccullen.jpg",
        "Midterm" => "midterm.jpg",
        "Museum" => "museum.jpg",
        "Onsay" => "onsay.jpg",
        "Owen" => "owen.jpg",
        "Plum" => "plum.jpg",
        "Programming" => "programming.jpg",
        "Project" => "project.jpg",
        "Quiz" => "quiz.jpg",
        "Stadium" => "stadium.jpg",
        "Union" => "union.jpg",
        "Wharton" => "wharton.jpg",
        "Written" => "written.jpg"
    ); // All card names and pictures in a 2D array.

    const CARD_NUM = 21;


    public $hand; // A string-indexed array where the player's cards are kept
    public $not_in_hand; // A string-indexed where the player's other cards are kept


    public function __construct($in_hand) {
        /*
         * $in_hand is an array of strings, being the names of the cards which are in the player's hand
         *
         * $words is an array of strings, indexed by strings.   $words["Project"] would give the word on the Project card, for example.
         */
        $this->hand = array();
        $this->not_in_hand = array();
        $temp = [];
        $keys = array_keys(Cards::CARD_INFO);

        for ($i = 0; $i < count(Cards::CARD_INFO); $i ++) {
            if (in_array($keys[$i], $in_hand)) {
                $this->hand[$keys[$i]] = new Card($keys[$i], Cards::CARD_INFO[$keys[$i]]);
            } else {
                $index = rand(0, sizeof($this->words) - 1);
                while (in_array($index, $temp)) {
                    $index = rand(0, sizeof($this->words) - 1);
                }
                $temp[] = $index;
                $this->not_in_hand[$keys[$i]] = new Card($keys[$i], Cards::CARD_INFO[$keys[$i]], $this->words[$index]);
            }
        }
     }

     public function getHand() {
        // gets the hand
        return $this->hand;
     }

     public function getNotInHand() {
        // gets the not-in-hand
        return $this->not_in_hand;
     }

     public function displayHand() {
        // displays the player's hand
        // TODO: Make the display styled properly.  Perhaps add rows to this function for that purpose.

        $html = <<<HTML
    <p class="hand">
HTML;
        $keys = array_keys($this->hand);
        $size = count($keys);
        for ($i = 0; $i < $size; $i ++) {
            $html .= $this->hand[$keys[$i]]->display();
        }
        $html .= <<<HTML
    </p>
HTML;
        return $html;
    }

    public function displayNotHand() {
        // displays what's not in the player's hand
        // TODO: Make the display styled properly.  Perhaps add rows to this function for that purpose.

        $html = <<<HTML
<p>
HTML;
        $keys = array_keys($this->not_in_hand);
        $size = count($keys);
        for ($i = 0; $i < $size; $i ++) {
            $html .= $this->not_in_hand[$keys[$i]]->display();
        }
        $html .= <<<HTML
</p>
HTML;
        return $html;
    }

}