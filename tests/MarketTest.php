<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../lib/Market.php');

class MarketTest extends TestCase
{
      public function testCalc()
      {
        $this->assertSame(1298, calc('21:00', [1, 1, 1, 3, 5, 7, 8, 9, 10]));
      }
}
