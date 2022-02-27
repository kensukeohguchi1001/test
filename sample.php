<?php
// 無名関数を書いてみよう

$times = 3;

$numbers = [1,2,3];
$products = array_map(fn ($num) => $num * $times,$numbers);
var_dump($products);
