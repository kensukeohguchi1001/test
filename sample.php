<?php
// 無名関数を書いてみよう

$times = 3;

$numbers = [1,2,3];
$products = array_map(fn ($num) => $num * $times, $numbers);
var_dump($products);

function convertToNumber(string ...$cards): array
{
  return array_map(fn ($card) => substr($card, 1), $cards);
}

$test = convertToNumber('H3', 'S10', 'DA');
var_dump($test);
