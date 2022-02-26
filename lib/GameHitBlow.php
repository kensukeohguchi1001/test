<?php

function judge(string $predict, string $answer)
{
    $arrayPredict = str_split($predict);
    $arrayAnswer = str_split($answer);
    $hitCount = 0;
    $blowCount = 0;
  foreach ($arrayPredict as $index => $arrayPredict) {
        if (isBlow($arrayPredict, $arrayAnswer)) {
          $blowCount++;
        }
        if (isHit($arrayPredict, $arrayAnswer, $index)) {
          $hitCount++;
        }
  }
    return [$hitCount, $blowCount];
}

function isBlow(string $arrayPredict, array $arrayAnswer): bool
{
    return in_array($arrayPredict,$arrayAnswer);
}

function isHit(string $arrayPredict, array $arrayAnswer,  int $index): bool
{
    return $arrayAnswer[$index]   === $arrayPredict;
}

$test = judge(5678, 1128);
var_dump($test);
// predictを取得し、一つ一つの数字を配列に格納
// 格納した配列と、answerで一致する値の数をカウントしてhitの数を算出する
