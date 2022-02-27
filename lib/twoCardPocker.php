<?php

// showDown('CK', 'DJ', 'C10', 'H10') => ['high card', 'pair', 2]
// constでカードを定義
// 定義したconstをforeachで回し、ランダムで2つ取得する(array_randを使用)

function showDown ($player1Card1, $player1Card2, $player2Card1, $player2Card2): array
{
    $player1Hand = '';
    $player2Hand = '';
    $winner = '';
    $player1Card = [$player1Card1, $player1Card2];
    $player2Card = [$player2Card1, $player2Card2];
    pairCard($player1Card,$player2Card);



    return [$player1Hand, $player2Hand, $winner];
}

function pairCard(array $card1, array $card2): array
{
    $player1Hand = '';
    $player2Hand = '';
  foreach ($card1 as $card) {
    $cardNumber1[] = substr($card, 1);
    if ($cardNumber1[0] === $cardNumber1[1]) {
        $player1Hand = 'pair';
    }else {
        $player1Hand = '';
    }
  }

  foreach ($card2 as $card) {
    $cardNumber2[] = substr($card, 1);
    if ($cardNumber2[0] === $cardNumber2[1]) {
        $player2Hand = 'pair';
    }else {
        $player2Hand = '';
    }
  }
    var_dump($player1Hand);
    var_dump($player2Hand);

    return [$player1Hand, $player2Hand];
}

showDown('C4', 'D5', 'C10', 'H10');  //=> ['high card', 'pair', 2]
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
