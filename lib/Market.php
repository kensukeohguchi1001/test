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

//タスク分解した上でどれくらい時間がかかるか算出しよう

// 1h

// ※アロー関数を使用する インプットしたい10h分

// 商品一覧をcosntで定義しておく 5
// 半額になる時間帯をconstで定義

// 引数の値を取得する
// 商品の合計金額を出す 15
// 税込の金額を加える
// 条件a~cを作っていく
  // a. 玉ねぎは3つ買うと50円引き 15
  // b. 玉ねぎは5つ買うと100円引き
  // c. 弁当と飲み物を一緒に買うと20円引き（ただし適用は一組ずつ） 10
// 時間帯を考慮した関数の作成 10

const ITEMS = [
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

const BENTO_DISCOUNT_START_TIME = '21:00';
const TAX = 10;

function calc(string $time,  array $items): int
{
    $totalPrice = 0;
    $totalPrice += itemsTotalPrices($items);
    $totalPrice -= discountOnion($items);
    $totalPrice -= setPrice($items);
    $totalPrice -= bentoDiscountFiftyPercent($time, $items);
    return (int) $totalPrice * (100 + TAX) / 100;
}

function itemsTotalPrices($items): int
{
  $taxIncludePrices = 0;
  foreach ($items as $item) {
    $taxIncludePrices += ITEMS[$item]['price'];
    }

    return $taxIncludePrices;
}

function discountOnion(array $items): int
{
    $discountOnionPrice = 0;
    $onionCount = 0;
  foreach ($items as $item) {
      if ($item === 1) {
          $onionCount++;
      }
  }

  if ($onionCount >= 5) {
    $discountOnionPrice += 100;
    return $discountOnionPrice;
  } elseif ($onionCount >= 3 ) {
    $discountOnionPrice += 50;
    return $discountOnionPrice;
  } else {
    return 0;
  }
}

function setPrice(array $items): int
{
    $bentoCount = 0;
    $drinkCount = 0;
    $setDiscount = [];
  foreach (ITEMS as $key => $value) {
      if ($value['type'] === 'drink') {
          $drinkCount++;
      } elseif ($value['type'] === 'bento') {
          $bentoCount++;
      }
  }
  $setDiscount = [$bentoCount, $drinkCount];
    return  min($setDiscount) * 20;
}

function bentoDiscountFiftyPercent(string $time, array $items): int
{
    $bentoTotal = 0;
  foreach ($items as $item) {
      if (ITEMS[$item]['type'] === 'bento') {
          $bentoTotal += ITEMS[$item]['price'];
      }
  }


  if ($time >= BENTO_DISCOUNT_START_TIME) {
      $bentoDiscount =  $bentoTotal / 2;
    } else {
      return 0;
    }
    return $bentoDiscount;
}

calc('21:00', [1, 1, 1, 3, 5, 7, 8, 9, 10]);  //=> 1298
