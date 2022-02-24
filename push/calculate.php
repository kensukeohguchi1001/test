
<?php

// 玉ねぎ 100円
// 人参 150円
// りんご 200円
// ぶどう 350円
// 牛乳 180円
// 卵 220円
// 唐揚げ弁当 440円
// のり弁 380円
// お茶 80円
// コーヒー 100円
// また、以下の条件を満たすと割引されます。

// a. 玉ねぎは3つ買うと50円引き
// b. 玉ねぎは5つ買うと100円引き
// c. 弁当と飲み物を一緒に買うと20円引き（ただし適用は一組ずつ）
// d. お弁当は20〜23時はタイムセールで半額

// 合計金額（税込み）を求めてください。

// ◯仕様
// 金額を計算するcalc関数を定義してください。
// calcメソッドは「購入時刻 商品番号 商品番号 商品番号 ...」を引数に取り、合計金額（税込み）を返します。
// 購入時刻はHH:MM形式（例. 20:00）とし、商品番号は1〜10の整数とします。
// 同時に買える商品は20個までです。また、購入時刻は9〜23時です。

// ◯実行例

// calc('21:00', [1, 1, 1, 3, 5, 7, 8, 9, 10])  //=> 1298


//
// numbersについての条件分岐
// calcで呼び出す calc側では calc($time,$numbers[]){

  // }のように定義する
  const PRODUCTS = [
  // 時間の条件分岐、(お弁当は20〜23時はタイムセールで半額)
  1 => ['price' => 100,'type' => ''],
  2 => ['price' => 150,'type' => ''],
  3 => ['price' => 200,'type' => ''],
  4 => ['price' => 350,'type' => ''],
  5 => ['price' => 180,'type' => 'drink'],
  6 => ['price' => 220,'type' => ''],
  7 => ['price' => 440,'type' => 'bento'],
  8 => ['price' => 380,'type' => 'bento'],
  9 => ['price' => 80,'type' => 'drink'],
  10 => ['price' => 100,'type' => 'drink'],
];


const TAX = 10;
const DISCOUNT_FIFTY_YEN = 50;
const DISCOUNT_THREE_ONION = 3;
const DISCOUNT_HUNDRED_YEN = 100;
const DISCOUNT_FIVE_ONION = 5;
const DISCOUNT_START_TIME = '20:00';
function calc(string $time, array $items):int
{
  $totalAmount = 0;
  $drink = 0;
  $bento = 0;
  $bentoAmount = 0;
  foreach($items as $item){
    $totalAmount += PRODUCTS[$item]['price'];

    if(PRODUCTS[$item]['type'] === 'drink'){

      $drink++;
    }

    if(PRODUCTS[$item]['type'] === 'bento'){
      $bento++;
      $bentoAmount += PRODUCTS[$item]['price'];
    }
  }

  $totalAmount -= discountOnion(array_count_values($items)[1]);
  $totalAmount -= discountSet($drink,$bento);
  $totalAmount -= discountStartTime($time,$bentoAmount);
  return (int) $totalAmount * (100 + TAX) / 100;
}

function discountOnion (int $number):int

{
  $discountOnion = 0;
  if($number >= DISCOUNT_FIVE_ONION){
    $discountOnion += DISCOUNT_HUNDRED_YEN;
  }elseif($number >= DISCOUNT_THREE_ONION){
    $discountOnion += DISCOUNT_FIFTY_YEN;
  }
  return $discountOnion;
}
function discountSet($drinkCount,$bentoCount):int
{
  return min([$drinkCount,$bentoCount]) * 20;
}

function discountStartTime($time,$bentoAmount):int
{
  if(strtotime(DISCOUNT_START_TIME) > strtotime($time)){
    return 0;
  }
    return $bentoAmount / 2;
}

$test = calc('21:00', [1, 1, 1, 3, 5, 7, 8, 9, 10]);
var_dump($test);






// function discount ($calculateTest,$calculate)
// {
//   $discountProduct = array_count_values($calculateTest);
//   // [1]=>
//   // int(3)
//   // [2]=>
//   // int(1)
//   if($discountProduct[1] >= 3){

//     $discountPrice = $calculate[1] - round(($calculate[1] * DISCOUNT_FIFTY_YEN));
//     var_dump($discountPrice);

//     }elseif($discountProduct[1] % 5 == 0){
//       $discountPrice = $calculate[1] - round(($calculate[1] * DISCOUNT_HUNDRED_YEN));
//     }
//   }
