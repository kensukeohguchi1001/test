<?php

// 暗記でもいい、とりあえずツーカードポーカーの復習しよう
// 50分から
// 一文字目のアルファベットを削除する
//    substrとstrlenを使用する、それをarray_mapを使って処理を行う
//
// 役を判定するために、カードをランクに変換する
//    四枚のカード情報が入った配列をarray_mapを使ってランクに変換する
//    変換したものをarray_chunkで分ける（プレイヤー1のカード, プレイヤー２のカード）
// 役を判定する、
//    3つの役をそれぞれ判定する関数を宣言する
//    ストレートの場合考えないといけないことが一点、Aと2もストレートになるということ
//    そのパターンのみ別処理を行う
// 役の判定情報から勝者を判定する、
//    役の強さを数字で表すconstを定義する
//    役の強さを判定する、foreachを使って比較する
// showDownメソッドを呼び出し、指定された内容を戻り値としてかえす

const PAIR = 'pair';
const STRAIGHT = 'straight';
const HIGH_CARD = 'high_card';

const CARDS = ['1', '2', '3', '4', '5' , '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];

define("CARD_RANKS",(function () {
    $cardRanks = [];
    foreach (CARDS as $index => $card) {
        $cardRanks[$card] = $index;
    }
    return $cardRanks;
})());

const HANDS_RANK = [
    HIGH_CARD => 1,
    PAIR => 2,
    STRAIGHT => 3
];

function showDown($card11, $card12, $card21, $card22): array
{
    $substrCardNumber = substrCardNumber([$card11, $card12, $card21, $card22]);
    $playerCards = array_chunk($substrCardNumber, 2);
    $hands = array_map(fn ($playerCard) => checkHands($playerCard[0], $playerCard[1]), $playerCards);
    return [];
}

function substrCardNumber(array $cards): array
{
    return array_map(fn ($card) => CARD_RANKS[substr($card, 1)] , $cards);
}
// 名前の付け方が微妙

function checkHands($card1, $card2): array
{
    $primary = max($card1, $card2);
    $secondary = min($card1, $card2);
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
        'rank' => HANDS_RANK[$name],
        'primary' => $primary,
        'secondary' => $secondary,
    ];
}

function isStraight($card1, $card2): bool
{
    return abs($card1 - $card2) === 1 || isMinMax($card1, $card2);
}
function isPair($card1, $card2): bool
{
    return $card1 === $card2;
}

function isMinMax($card1, $card2): bool
{
    return abs($card1 - $card2) === abs(min(CARD_RANKS) - max(CARD_RANKS));
}

showDown('CK', 'DJ', 'C10', 'H10');  //=> ['high card', 'pair', 2]
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
