<?php
const TAX = 10;
const ITEM = [
    1 => ['price' => 100, 'type' => ''],
    2 => ['price' => 150, 'type' => ''],
    3 => ['price' => 200, 'type' => ''],
    4 => ['price' => 350, 'type' => ''],
    5 => ['price' => 180, 'type' => 'drink'],
    6 => ['price' => 220, 'type' => ''],
    7 => ['price' => 440, 'type' => 'bento'],
    8 => ['price' => 380, 'type' => 'bento'],
    9 => ['price' => 80, 'type' => 'drink'],
    10 => ['price' => 100, 'type' => 'drink'],
];

const ONION_DISCOUNT_HUNDRED = 100;
const ONION_DISCOUNT_FIFTY = 50;
const ONION_DISCOUNT_FIVE = 5;
const ONION_DISCOUNT_THREE = 3;
const DISCOUNT_SET_ITEM = 20;
const DISCOUNT_BENTO_START_TIME = '20:00';

function calc(string $time, array $items): int
{
    $totalPrice = 0;
  foreach ($items as $item) {
      $totalPrice += ITEM[$item]['price'];
  }
    $totalPrice -= discountPriceOnion($items);
    $totalPrice -= discountSet($items);
    $totalPrice -= discountBentoFiftyPercent($time);
    return $totalPrice * (100 + TAX) / 100;
}

function discountPriceOnion(array $items): int
{
    $arrayTest = [];
    $arrayTest = array_count_values($items);
    $onionDiscount = 0;
  if ($arrayTest[1] >= ONION_DISCOUNT_FIVE) {
    $onionDiscount += ONION_DISCOUNT_HUNDRED;
  }elseif ($arrayTest[1] >= ONION_DISCOUNT_THREE) {
    $onionDiscount += ONION_DISCOUNT_FIFTY;
  }
    return $onionDiscount;
}

function discountSet($items): int
{
    $bentoCount = 0;
    $drinkCount = 0;
  foreach (ITEM as $number => $type) {
      if ($type['type'] === 'bento') {
          $bentoCount++;
      }
      if ($type['type'] === 'drink') {
          $drinkCount++;
      }
    }

      $discountSet = min($bentoCount, $drinkCount);
      return DISCOUNT_SET_ITEM * $discountSet;
}

function discountBentoFiftyPercent($time): int
{
    $bentoPrice = 0;
    foreach (ITEM as $number => $type) {
      if ($type['type'] === 'bento') {
        $bentoPrice += $type['price'];
      }
    }
    if ($time >= DISCOUNT_BENTO_START_TIME) {
        return $bentoPrice / 2;
    }else {
        return 0;
    }
}

$calc = calc('21:00', [1, 1, 1, 3, 5, 7, 8, 9, 10]);
echo $calc;


