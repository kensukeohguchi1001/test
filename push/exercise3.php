<?php


// ◯お題
// あなたは小さなパン屋を営んでいました。一日の終りに売上の集計作業を行います。
// 商品は10種類あり、それぞれ金額は以下の通りです（税抜）。

// ①100
// ②120
// ③150
// ④250
// ⑤80
// ⑥120
// ⑦100
// ⑧180
// ⑨50
// ⑩300

// 一日の売上の合計（税込み）と、販売個数の最も多い商品番号と販売個数の最も少ない商品番号を求めてください。

// ◯インプット
// 入力は以下の形式で与えられます。

// 販売した商品番号 販売個数 販売した商品番号 販売個数 ...

// ※ただし、販売した商品番号は1〜10の整数とする。

// ◯アウトプット

// 売上の合計
// 販売個数の最も多い商品番号
// 販売個数の最も少ない商品番号

// ※
// ◯アウトプット例

// 2464
// 1
// 5 10

// ◯実行コマンド例
// php exercise3.php 1 10 2 3 5 1 7 5 10 1
// ①100
// ②120
// ③150
// ④250
// ⑤80
// ⑥120
// ⑦100
// ⑧180
// ⑨50
// ⑩300
const SPLIT_LENGTH = 2;
const TAX = 10;
const BREADS = [
  1 => 100,
  2 => 120,
  3 => 150,
  4 => 250,
  5 => 80,
  6 => 120,
  7 => 100,
  8 => 180,
  9 => 50,
  10 => 300
];

function getInputs (): array
{
  $argument = array_slice($_SERVER['argv'],1);
  $sales = array_chunk($argument,SPLIT_LENGTH);
  return $sales;
}


// なにをするのか？
// [1] => [10]
// BREADS[$quantity] * [product]
function calculateSales(array $sales)
{
  $sum = 0;
  foreach($sales as $sale){
    $quantity = $sale[0];
    $product = $sale[1];
    $sum += BREADS[$quantity] * $product;
    // $sum += BREADS[$quantity] * (int) $product;
  }
  return (int) $sum * (100 + TAX) / 100;
}

function getNumberOfMaxQuantity($sales){
  $max = max($sales);
  // var_dump($max);
  // var_dump($sales);
}

function getNumberOfMinQuantity(array $sales){
  $min = min(array_values($sales));
  return (array_keys($sales,$min));
}





$sales = getInputs();
$salesAmount = calculateSales($sales);
$getNumberOfMaxQuantity = getNumberOfMaxQuantity($sales);
$getNumberOfMinQuantity = getNumberOfMinQuantity($sales);
var_dump($getNumberOfMinQuantity);
