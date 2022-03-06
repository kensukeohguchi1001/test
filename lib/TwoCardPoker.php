<?php


// プレイヤー二人、カード二枚ずつを引数として受け取る
// それぞれのカードの役で判定をし勝者を決める
// それぞれの役と勝者を戻り値として返す

const CARDS = ['2','3','4','5','6','7','8','9','10','J','Q','K',
'A'];

define('CARD_RANK', (function()
{
    $cardRanks = [];
    foreach (CARDS as $index => $card) {
        $cardRanks[$card] = $index;
    }
    return $cardRanks;
})());



var_dump(CARD_RANK);
