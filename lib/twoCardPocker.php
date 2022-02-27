<?php

// showDown('CK', 'DJ', 'C10', 'H10') => ['high card', 'pair', 2]
// constでカードを定義
// 定義したconstをforeachで回し、ランダムで2つ取得する(array_randを使用)

// ストレート、、連続する数字を確認する。
// そのために必要なこと、
// int型に変換する
// 数字を取得する→substrを使って一文字削除する
// 削除したのちに型変換でint型に変換
// 連続しているか確認する→foreachなのかarrayなんとかを使って行うのか
// foreachを前提として
// 一週目で取得した値と二週目で取得した値を比較する
// 一週目で取得した値をプラス1した値が二週目で取得した値と等しい場合（もしくは逆）
//



function showDown ($player1Card1, $player1Card2, $player2Card1, $player2Card2): array
{
    $player1Hand = '';
    $player2Hand = '';
    $winner = '';
    $player1Card = [$player1Card1, $player1Card2];
    $player2Card = [$player2Card1, $player2Card2];
    $pairCard = pairCard($player1Card, $player2Card);
    $straightCard = straightCard($player1Card, $player2Card);

    var_dump($pairCard);
    var_dump($straightCard);

    return [$player1Hand, $player2Hand, $winner];
}


// ⭐️確認ポイント
// foreachやifを使いすぎいている。
// そもそもこのやり方であっているのか？
// もっとすらっと書くにはどうしたらいいのかを考えた上で回答を見る

function pairCard(array $card1, array $card2): array
{
    $player1Hand = '';
    $player2Hand = '';

    $player1Card1 = $card1[0];
    $player1Card2 = $card1[1];
  if (substr($player1Card1, 1) === substr($player1Card2, 1)) {
    $player1Hand = 'pair';
  } else {
    $player1Hand = '';
  }

    $player2Card1 = $card2[0];
    $player2Card2 = $card2[1];
  if (substr($player2Card1, 1) === substr($player2Card2, 1)) {
    $player2Hand = 'pair';
  } else {
    $player2Hand = '';
  }

    return [$player1Hand, $player2Hand];
}

// ⭐️確認ポイントどうやって連続した整数を判断しているのか、割り当ても含めて

// 数字が連続する分についてはいける
// 何がしたいか？
// foreachで取り出した値が連続する整数の場合、ストレートとして返す
// AceやQueenやKingの場合どうしたらいいのか迷っている
// A = 1という風に割り振りをしていくのか？


function straightCard (array $card1, array $card2): array
{
    $player1Hand = '';
    $player2Hand = '';

    $player1Card1 = $card1[0];
    $player1Card2 = $card1[1];

    if ((int)substr($player1Card1, 1) === (int) substr($player1Card2, 1) - 1 || (int) substr($player1Card1, 1) - 1 === (int) substr($player1Card2, 1)) {
      $player1Hand = 'straight';
    } else {
      $player1Hand = '';
    }

    $player2Card1 = $card2[0];
    $player2Card2 = $card2[1];
    if ((int) substr($player2Card1, 1) === (int) substr($player2Card2, 1) - 1 || (int) substr($player2Card1, 1) - 1 === (int) substr($player2Card2, 1)) {
      $player2Hand = 'straight';
    } else {
      $player2Hand = '';
    }
    var_dump($player1Hand);
    var_dump($player2Hand);
    return [$player1Hand, $player2Hand];


  //   $player1Hand = '';
  //   $player2Hand = '';
  // foreach ($card1 as $card) {
  //   $cardNumber1[] = (int) substr($card, 1);
  //   if ($cardNumber1[0] === $cardNumber1[1] - 1) {

  //     $player1Hand = 'straight';
  //   } else {
  //     $player1Hand = '';
  //   }
  // }

  // foreach ($card2 as $card) {
  //   $cardNumber2[] = (int) substr($card, 1);
  //   if ($cardNumber2[0] === $cardNumber2[1] - 1) {
  //     var_dump($cardNumber2);
  //     $player2Hand = 'straight';
  //   } else {
  //     $player2Hand = '';
  //   }
  }



showDown('C7', 'D6', 'C7', 'H7');  //=> ['high card', 'pair', 2]
// showDown('CK', 'DJ', 'C3', 'H4');    //=> ['high card', 'straight', 2]
// showDown('C3', 'H4', 'DK', 'SK');    //=> ['straight', 'pair', 1]
// showDown('HJ', 'SK', 'DQ', 'D10');   //=> ['high card', 'high card', 1]
// showDown('H9', 'SK', 'DK', 'D10');   //=> ['high card', 'high card', 2]
// showDown('H3', 'S5', 'D5', 'D3');    //=> ['high card', 'high card', 0]
// showDown('CA', 'DA', 'C2', 'D2');    //=> ['pair', 'pair', 1]
// showDown('CK', 'DK', 'CA', 'DA');    //=> ['pair', 'pair', 2]
// showDown('C4', 'D4', 'H4', 'S4');    //=> ['pair', 'pair', 0]
// showDown('SA', 'DK', 'C2', 'CA');    //=> ['straight', 'straight', 1]

// showDown('C2', 'CA', 'S2', 'D3');    //=> ['straight', 'straight', 2]
// showDown('S2', 'D3', 'C2', 'H3');    //=> ['straight', 'straight', 0]


