<?php
// <!-- あなたは小さなパン屋を営んでいました。一日の終りに売上の集計作業を行います。
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

// ※ただし、税率は10%とする。
// ※また、販売個数の最も多い商品と販売個数の最も少ない商品について、販売個数が同数の商品が存在する場合、それら全ての商品番号を記載すること。

// ◯インプット例

// 1 10 2 3 5 1 7 5 10 1

// ◯アウトプット例

// 2464
// 1
// 5 10

// ◯実行コマンド例
// php exercise2.php 1 10 2 3 5 1 7 5 10 1 -->





// データの取得
// 正しい形に変換する
//
// 合計金額を求める関数を作成しないといけない
// 合計金額を税率10％で表示
// 販売個数の最も多い商品番号、少ない商品番号を表示
// アウトプットを表示する

// データ構造 [1] => [10]

const SPLIT_LENGTH = 2;
function getInput():array
{
  $input = array_slice($_SERVER['argv'],1);
  return array_chunk($input,SPLIT_LENGTH);
}

// 個数と商品番号を配列に格納 $quantityProduct[1] => [10]
function arrayQuantityProduct(array $inputs):array
{
  $quantityProduct = [];
  foreach($inputs as $input){
    $product = $input[0];
    $quantity = $input[1];

    $quantityProduct[$product] = (int)$quantity;
  }
  return $quantityProduct;
}

function productPriceSum(array $quantityProduct):void
{
  foreach($quantityProduct as $quantity => $product){
    if($quantity == 1){
      $price[] = $product * 100;
    }elseif($quantity == 2){
      $price[] = $product * 120;
    }elseif($quantity == 3){
      $price[] = $product * 150;
    }elseif($quantity == 4){
      $price[] = $product * 250;
    }elseif($quantity == 5){
      $price[] = $product * 80;
    }elseif($quantity == 6){
      $price[] = $product * 120;
    }elseif($quantity == 7){
      $price[] = $product * 100;
    }elseif($quantity == 8){
      $price[] = $product * 180;
    }elseif($quantity == 9){
      $price[] = $product * 50;
    }elseif($quantity == 10){
      $price[] = $product * 300;
    }
  }
  $priceSum = array_sum($price);
  echo $priceSum * 1.1 . PHP_EOL;
}

function productMaxMin(array $quantityProduct)
{
  foreach($quantityProduct as $quantity => $price){
    $quantities[] = $quantity;
  }
  $quantityMax = max($quantities);
  $quantityMin = min($quantities);
  echo $quantityMin . PHP_EOL;
  echo $quantityMax . PHP_EOL;
}

$inputs = getInput();
$quantityProduct = arrayQuantityProduct($inputs);
productPriceSum($quantityProduct);
$productMaxMin = productMaxMin($quantityProduct);
