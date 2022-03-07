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

const HIGH_CARD = 'high card';
const STRAIGHT = 'straight';
const PAIR= 'pair';

const HAND_RANK = [
    HIGH_CARD => 1,
    PAIR => 2,
    STRAIGHT => 3,
];

function showDown($card11, $card12, $card21, $card22): array
{
    $cardRanks = convertToCardRanks([$card11, $card12, $card21, $card22]);
    // カードの役を判定する
    $playerCardRanks = array_chunk($cardRanks, 2);
    $hands = array_map(fn ($playerCardRank) =>
        checkHand($playerCardRank[0], $playerCardRank[1])
    , $playerCardRanks);
    // 勝者を判定する
    $winner = winner($hands[0], $hands[1]);
    return [$hands[0]['name'], $hands[1]['name'], $winner];
}

function convertToCardRanks(array $playerCardArray): array
{
    return array_map(fn ($card) => CARD_RANK[substr($card, 1, strlen($card) - 1)], $playerCardArray);
}

function checkHand($card1, $card2): array
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
        }elseif (isPair($card1, $card2)) {
            $name = PAIR;
        }

        return ['name' => $name,
                'rank' => HAND_RANK[$name],
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
    return abs($card1 - $card2) === (max(CARD_RANK) - min(CARD_RANK));
}

function winner($player1, $player2): int
{
    foreach (['rank', 'primary', 'secondary'] as $k) {
        if ($player1[$k] > $player2[$k]) {
            return 1;
        }

        if ($player1[$k] < $player2[$k]) {
            return 2;
        }
    }
    return 0;
}
// どうやって役を判定していくか？（high card pair straight）
// まずどんなデータ構造にしてデータを返却するのか？
// 'rank' => ,
// 'name' =>
// 'primary' =>
// 'secondary' =>

// 考慮すべき点

// high card
// 二枚のカードのランクをMin Maxで二つの変数に格納
// そのまま返す

// straight
// 二枚のカードの差を計算、絶対値が1の場合ストレート、

// Aと2の場合のも別条件で作成する　HOW?
// 二枚のカードの差を計算（ここまでは、上と同じ）
// constで定義しているCardRankのMinとMaxの差を計算
// 差を出した二つの値が等しい場合primaryとseconndaryを逆にする

// pair
// 二枚のカードランクが等しい場合



showDown('CK', 'DJ', 'C10', 'H10');
