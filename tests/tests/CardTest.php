<?php


namespace tests;


use Game\Card;

class CardTest extends \PHPUnit\Framework\TestCase
{
    public function test_construct(){
        $card = new Card("Owen", "mccullen.jpg", "cool", "location");
        $this->assertEquals("mccullen.jpg", $card->getImage());
        $this->assertEquals("cool", $card->getWord());
        $this->assertEquals("Owen", $card->getName());
    }

    public function test_display(){
        $card = new Card("Owen", "mccullen.jpg", "cool", "location");


        $html = <<<HTML
<div class="card">
    <p class="cardImage"><img src="images/mccullen.jpg" alt="Owen" height="auto" width="auto"></p>
    
HTML;

        $this->assertContains($html, $card->display());
    }


}