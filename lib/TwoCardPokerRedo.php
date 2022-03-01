<?php

const PAIR = 'pair';
const STRAIGHT = 'straight';
const HIGH_CARD = 'high card';

const CARDS = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];
define("CARD_RANKS", (function () {
      $cardRanks= [];
      foreach (CARDS as $index => $card) {
          $cardRanks[$card] = $index;
      }
      return $cardRanks;
})());

function showDown($card11, $card12, $car21, $card22): array
{
    $cardRank = convertToCardRanks([$card11, $card12, $car21, $card22]);
    $playerCardRanks = array_chunk($cardRank, 2);
    $hands = array_map(fn ($playerCardRank) => checkHand($playerCardRank[0], $playerCardRank[1]), $playerCardRanks);
    return [];
}
    // ConvertToNumber関数を作成する('ck'から'k'にする)
    // 役の判定をする関数を作成(straight,pair,high card)、
    // 配列でプレイヤーの役と勝ち負けを返す

function convertToCardRanks(array $cards): array
{
  return array_map(fn ($card) => CARD_RANKS[substr($card, 1, strlen($card) - 1)], $cards);
}

function checkHand(int $checkHands1, int $checkHands2)
{
    $highCard = max($checkHands1, $checkHands2);
    $lowCard = min($checkHands1, $checkHands2);
    $name = HIGH_CARD;
    // それぞれカードの判定を行う
    if (isStraight($checkHands1, $checkHands2)) {
      $name = STRAIGHT;
    } elseif (isPair($checkHands1, $checkHands1)) {
      $name = PAIR;
    }
}

function isStraight($hands1, $hands2): bool
{
    return abs($$hands1 - $hands2) === 1;
}

function isPair($hands1, $hands2): bool
{
    return $hands1 === $hands2;
}

showDown('CK', 'DJ', 'C10', 'H10');  //=> ['high card', 'pair', 2]
showDown('CK', 'DJ', 'C3', 'H4');    //=> ['high card', 'straight', 2]
showDown('C3', 'H4', 'DK', 'SK');    //=> ['straight', 'pair', 1]


// 取得したカードのデータ構造を変更した
// array_chunkでプレイヤー1とプレイヤー2のカードを配列で分割
// これから役の判定に入っていく？
