<?php


class CardsTest extends \PHPUnit\Framework\TestCase
{
    public function test_cards() {
        $in_hand = array("Beaumont", "Breslin", "Day", "Final", "Quiz", "Project");
        $hand = new \Game\Cards($in_hand);
        $inhand = $hand->getHand();
        $keys  = array_keys($hand->getHand());
        $this->assertContains("Beaumont", $keys);
        $this->assertEquals($inhand["Beaumont"]->getName(), "Beaumont");
        $this->assertEquals($inhand["Beaumont"]->getImage(), "beaumont.jpg");
        $this->assertContains('<p class="cardImage">', $inhand["Beaumont"]->display());
        $this->assertContains("beaumont.jpg", $inhand["Beaumont"]->display());

        $this->assertContains("Breslin", $keys);
        $this->assertEquals($inhand["Breslin"]->getName(), "Breslin");
        $this->assertEquals($inhand["Breslin"]->getImage(), "breslin.jpg");
        $this->assertContains('<p class="cardImage">', $inhand["Breslin"]->display());
        $this->assertContains("breslin.jpg", $inhand["Breslin"]->display());

        $this->assertContains("Day", $keys);
        $this->assertEquals($inhand["Day"]->getName(), "Day");
        $this->assertEquals($inhand["Day"]->getImage(), "day.jpg");
        $this->assertContains('<p class="cardImage">', $inhand["Day"]->display());
        $this->assertContains("day.jpg", $inhand["Day"]->display());

        $this->assertContains("Final", $keys);
        $this->assertEquals($inhand["Final"]->getName(), "Final");
        $this->assertEquals($inhand["Final"]->getImage(), "final.jpg");
        $this->assertContains('<p class="cardImage">', $inhand["Final"]->display());
        $this->assertContains("final.jpg", $inhand["Final"]->display());

        $this->assertContains("Project", $keys);
        $this->assertEquals($inhand["Project"]->getName(), "Project");
        $this->assertEquals($inhand["Project"]->getImage(), "project.jpg");
        $this->assertContains('<p class="cardImage">', $inhand["Project"]->display());
        $this->assertContains("project.jpg", $inhand["Project"]->display());

        $this->assertContains("Quiz", $keys);
        $this->assertEquals($inhand["Quiz"]->getName(), "Quiz");
        $this->assertEquals($inhand["Quiz"]->getImage(), "quiz.jpg");
        $this->assertContains('<p class="cardImage">', $inhand["Quiz"]->display());
        $this->assertContains("quiz.jpg", $inhand["Quiz"]->display());

        $inhand = $hand->getNotInHand();
        $keys  = array_keys($hand->getNotInHand());
        $this->assertContains("Onsay", $keys);
        $this->assertEquals($inhand["Onsay"]->getName(), "Onsay");
        $this->assertEquals($inhand["Onsay"]->getImage(), "onsay.jpg");
        $this->assertContains('<p class="cardImage">', $inhand["Onsay"]->display());
        $this->assertContains("onsay.jpg", $inhand["Onsay"]->display());

        $this->assertContains("Programming", $keys);
        $this->assertEquals($inhand["Programming"]->getName(), "Programming");
        $this->assertEquals($inhand["Programming"]->getImage(), "programming.jpg");
        $this->assertContains('<p class="cardImage">', $inhand["Programming"]->display());
        $this->assertContains("programming.jpg", $inhand["Programming"]->display());

        $this->assertContains("Union", $keys);
        $this->assertEquals($inhand["Union"]->getName(), "Union");
        $this->assertEquals($inhand["Union"]->getImage(), "union.jpg");
        $this->assertContains('<p class="cardImage">', $inhand["Union"]->display());
        $this->assertContains("union.jpg", $inhand["Union"]->display());

        $this->assertContains("Written", $keys);
        $this->assertEquals($inhand["Written"]->getName(), "Written");
        $this->assertEquals($inhand["Written"]->getImage(), "written.jpg");
        $this->assertContains('<p class="cardImage">', $inhand["Written"]->display());
        $this->assertContains("written.jpg", $inhand["Written"]->display());

        $this->assertContains("Enbody", $keys);
        $this->assertEquals($inhand["Enbody"]->getName(), "Enbody");
        $this->assertEquals($inhand["Enbody"]->getImage(), "enbody.jpg");
        $this->assertContains('<p class="cardImage">', $inhand["Enbody"]->display());
        $this->assertContains("enbody.jpg", $inhand["Enbody"]->display());

        $this->assertContains("Plum", $keys);
        $this->assertEquals($inhand["Plum"]->getName(), "Plum");
        $this->assertEquals($inhand["Plum"]->getImage(), "plum.jpg");
        $this->assertContains('<p class="cardImage">', $inhand["Plum"]->display());
        $this->assertContains("plum.jpg", $inhand["Plum"]->display());
    }

}