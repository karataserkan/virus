<?php
namespace app\controllers;

/**
 *
 */

use app\models\Virus;

class TestController
{
    public function test()
    {
        $arr = [[0,1,0,0,0,0,0,1],[0,1,0,0,0,0,0,1],[0,0,0,0,0,0,0,1],[0,0,0,0,0,0,0,0]];
        $virus = new Virus($arr);
        echo $virus->clear() . " walls.\n";
    }
}
