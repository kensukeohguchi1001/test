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
      if ($hitCount === 4) {
        $blowCount = 0;
      }
    return [$hitCount, $blowCount];
}

function isBlow(string $arrayPredict, array $arrayAnswer): bool
{
    var_dump($arrayAnswer);
    return in_array($arrayPredict,$arrayAnswer);
}

function isHit(string $arrayPredict, array $arrayAnswer,  int $index): bool
{
    return $arrayAnswer[$index]   === $arrayPredict;
}

judge(5678, 5678); //=> [4, 0]
$test = judge(5678, 7612); //=> [1, 1]
var_dump($test);
judge(5678, 8756); //=> [0, 4]
judge(5678, 1234); //=> [0, 0]
