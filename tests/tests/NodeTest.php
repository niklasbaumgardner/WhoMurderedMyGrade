<?php


class NodeTest extends \PHPUnit\Framework\TestCase
{

    public function test() {
        $nR1C8 = new Game\Node(8, 1, 7);
        $this->assertInstanceOf('Game\Node', $nR1C8);
    }

    public function test_isFilled() {
        $nR1C8 = new Game\Node(8, 1, 7);
        $nR1C8->setFilled(true);

        $this->assertEquals($nR1C8->isFilled(), true);
    }

    public function test_getNodeType() {
        $nR1C8 = new Game\Node(8, 1, 7);
        $nR0C9 = new Game\Node(9, 0, 8);
        $nR3C2 = new Game\Node(2, 3, 9);

        $this->assertEquals($nR1C8->getNodeType(), Game\Node::REGULAR_NODE);
        $this->assertEquals($nR0C9->getNodeType(), Game\Node::START_NODE);
        $this->assertEquals($nR3C2->getNodeType(), Game\Node::INTERNATIONAL);
    }

    public function test_addTo() {
        $nR10C9 = new Game\Node(9, 10, 7);
        $nR9C9 = new Game\Node(9, 9, 7);
        $nR11C9 = new Game\Node(9, 11, 7);
        $nR10C8 = new Game\Node(8, 10, 7);
        $nR10C10 = new Game\Node(10, 10, 7);

        $nR10C9->addTo($nR9C9);
        $nR10C9->addTo($nR11C9);
        $nR10C9->addTo($nR10C8);
        $nR10C9->addTo($nR10C10);

        $nR9C9->addTo($nR10C9);
        $nR11C9->addTo($nR10C9);
        $nR10C8->addTo($nR10C9);
        $nR10C10->addTo($nR10C9);

        $to = $nR10C9->getTo();
        $c = count($to);
        $this->assertEquals($c, 4);
    }


}