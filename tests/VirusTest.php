<?php

declare(strict_types = 1);

namespace app\tests;

use PHPUnit\Framework\TestCase;
use app\models\Virus;

final class VirusTest extends TestCase
{
    public function testVirus()
    {
        $virus = new Virus([[0,0,0],[0,0,0],[1,1,1]]);
        $this->assertEquals(3, $virus->clear());

        $virus = new Virus([[0,1,0,0,0,0,0,1],[0,1,0,0,0,0,0,1],[0,0,0,0,0,0,0,1],[0,0,0,0,0,0,0,0]]);
        $this->assertEquals(10, $virus->clear());

        $virus = new Virus([[1,1,1],[1,0,1],[1,1,1]]);
        $this->assertEquals(4, $virus->clear());

        $virus = new Virus([[1,0],[0,0]]);
        $this->assertEquals(2, $virus->clear());

        $virus = new Virus([[1,0,1],[1,1,1],[1,0,1]]);
        $this->assertEquals(6, $virus->clear());

        $arr = [
            [1,1,0,0,0,0,0,1],
            [0,1,0,0,0,0,0,0],
            [0,0,0,0,0,0,0,0],
            [0,0,0,0,0,0,0,0],
            [0,0,0,0,1,0,0,0]

        ];
        $virus = new Virus($arr);
        $this->assertEquals(20, $virus->clear());
    }
}
