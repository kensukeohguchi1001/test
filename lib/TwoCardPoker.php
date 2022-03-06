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

function showDown($card11, $card12, $card21, $card22): array
{
    $cardRanks = convertToCardRanks([$card11, $card12, $card21, $card22]);
    // カードの役を判定する
    $playerCardRanks = array_chunk($cardRanks, 2);
    $hands = array_map(fn ($playerCardRank) =>
        checkHand($playerCardRank[0], $playerCardRank[1])
    , $playerCardRanks);
    // 勝者を判定する

    return [];
}

function convertToCardRanks(array $playerCardArray): array
{
  return array_map(fn ($card) => CARD_RANK[substr($card, 1, strlen($card) - 1)], $playerCardArray);
}

function checkHand()
{

}

showDown('CK', 'DJ', 'C10', 'H10');
