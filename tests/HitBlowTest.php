<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../lib/HitBlow.php');

  class HitBlowTest extends TestCase
  {
    public function testCalc()
    {
      $this->assertSame([4, 0], judge(5678, 5678));
      $this->assertSame([1, 1], judge(5678, 7612));
      $this->assertSame([0, 4], judge(5678, 8756));
      $this->assertSame([0, 0], judge(5678, 1234));
    }
  }
