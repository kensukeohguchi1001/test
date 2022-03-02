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
        if (isMinMax($checkHands1, $checkHands2)) {
            $highCard = min(CARD_RANKS);
            $lowCard = max(CARD_RANKS);
            $nama = STRAIGHT;
        }
    } elseif (isPair($checkHands1, $checkHands1)) {
      $name = PAIR;
    }
    var_dump($name);
}

function isStraight($hands1, $hands2): bool
{
    return abs($hands1 - $hands2) === 1;
}

function isMinMax($hands1, $hands2): bool
{
    return abs($hands1 - $hands2) === 1 || (min(CARD_RANKS) - max(CARD_RANKS));
}

function isPair($hands1, $hands2): bool
{
    return $hands1 === $hands2;
}

showDown('CK', 'DJ', 'C10', 'H8');  //=> ['high card', 'pair', 2]
