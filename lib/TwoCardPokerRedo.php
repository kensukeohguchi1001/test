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
    $cards = convertToNumber($card11, $card12, $car21, $card22);
    $divideCard = array_chunk($cards, 2);
    
    return [];
}
    // ConvertToNumber関数を作成する('ck'から'k'にする)
    // 役の判定をする関数を作成(straight,pair,high card)、
    // 配列でプレイヤーの役と勝ち負けを返す

function convertToNumber(string ...$cards): array
{
    $convertToNumber = array_map(fn ($card) => substr($card, 1), $cards); // 要修正 strlenを追加
    return $convertToNumber;
}


showDown('CK', 'DJ', 'C10', 'H10');  //=> ['high card', 'pair', 2]
showDown('CK', 'DJ', 'C3', 'H4');    //=> ['high card', 'straight', 2]
showDown('C3', 'H4', 'DK', 'SK');    //=> ['straight', 'pair', 1]
