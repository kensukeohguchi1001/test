<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../lib/tvScreen.php');

class tvScreenTest extends TestCase
{
      public function test()
      {
        $output = <<<EOD
        1.7
        1 45 2
        5 25 1
        2 30 1

        EOD;
        $this->expectOutputString($output);
        var_dump($output);
        $inputs = inputs(['file', '1', '30', '5', '25', '2', '30', '1', '15']);
        $separateOfChanelTime = separateOfChanelTime($inputs);
        $chanelWatchTimeSum = chanelWatchTimeSum($separateOfChanelTime);
        chanelTimeSum($separateOfChanelTime, $chanelWatchTimeSum);
        $chanelTimeSum =
    chanelTimeSum($separateOfChanelTime, $chanelWatchTimeSum);
    var_dump($chanelTimeSum);
  }
}
