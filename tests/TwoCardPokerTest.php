<?php

  use PHPUnit\Framework\TestCase;

  require_once(__DIR__ . '/../lib/TwoCardPoker.php');

  class TwoCardPokerTest extends TestCase
  {
    public function testShowDown()
    {
      $this->assertSame(['high card', 'pair', 2], showDown('CK', 'DJ', 'C10', 'H10'));
      $this->assertSame(['high card', 'straight', 2], showDown('CK', 'DJ', 'C3', 'H4'));
      $this->assertSame(['straight', 'pair', 1], showDown('C3', 'H4', 'DK', 'SK'));
    }
  }
