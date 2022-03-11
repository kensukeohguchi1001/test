<?php


// カードはH1〜H13（ハート）、S1〜S13（スペード）、D1〜D13（ダイヤ）、C1〜C13（クラブ）、となります。ただし、Jは11、Qは12、Kは13、Aは1とします。
// showDownメソッドは返り値として、プレイヤー1の役、プレイヤー2の役、勝利したプレイヤーの番号、を返します。引き分けの場合、プレイヤーの番号は0とします。


const CARDS = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];

define('CARD_RANK', (function () {
    $cardRanks = [];
    foreach (CARDS as $index => $card) {
        $cardRanks[$card] = $index;
    }
    return $cardRanks;
})());

const PAIR = 'pair';
const HIGH_CARD = 'high card';
const STRAIGHT = 'straight';

const HAND_RANK = [
    HIGH_CARD => 1,
    PAIR => 2,
    STRAIGHT => 3,
];

function showDown($card11, $card12, $card21, $card22): array
{
    $cardRanks = convertToCardRank([$card11, $card12, $card21, $card22]);
    $playerCardRanks = array_chunk($cardRanks, 2);
    $hands = array_map(fn ($playerCardRank) => checkHand($playerCardRank[0], $playerCardRank[1]), $playerCardRanks);
    $winner = decideWinner($hands);
    return [$hands[0]['name'], $hands[1]['name'], $winner];
}

function convertToCardRank(array $cards): array
{
    return array_map(fn ($card) => CARD_RANK[substr($card, 1, strlen($card) - 1)], $cards);
}
// 0 => [1枚目のカード, 2枚目のカード];
// 1 => [1枚目のカード, 2枚目のカード];
function checkHand(int $card1, int $card2): array
{
    $primary = max($card1, $card2);
    $secondary  = min($card1, $card2);
    $name = HIGH_CARD;

    if (isStraight($card1, $card2)) {
        $name = STRAIGHT;
        if (isMinMax($card1, $card2)) {
            $primary = min($card1, $card2);
            $secondary = max($card1, $card2);
        }
    } elseif (isPair($card1, $card2)) {
        $name = PAIR;
    }

    return [
        'name' => $name,
        'rank' => HAND_RANK[$name],
        'primary' => $primary,
        'secondary' =>$secondary
    ];
}

function isStraight(int  $card1, int $card2): bool
{
    return abs($card1 - $card2) === 1 || isMinMax($card1,$card2);
}
function isPair(int  $card1, int $card2): bool
{
    return $card1 === $card2;
}

function isMinMax(int $card1, int $card2): bool
{
    return abs($card1 - $card2) === abs(max(CARD_RANK) - min(CARD_RANK));
}

function decideWinner(array $playerCard): int
{
    foreach(['rank', 'primary', 'secondary'] as $key) {
        if ($playerCard[0][$key] > $playerCard[1][$key]) {
            return 1;
        }
        if ($playerCard[0][$key] < $playerCard[1][$key]) {
            return 2;
        }
    }
    return 0;
}
// まずは役の判定、STRAIGHTなのかpairなのか、high_cardなのか？
// 役が同じ場合primary.secondaryを比較する
// 引き分け

showDown('CK', 'DJ', 'C10', 'H10'); //=> ['high card', 'pair', 2]
showDown('C5', 'D2', 'C5', 'H4'); //=> ['high card', 'pair', 2]
