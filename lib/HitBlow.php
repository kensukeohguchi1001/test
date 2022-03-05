<?php

// 4桁の数を予想する
// 出題者は解答者の予想を判定する。数と桁の療法が同じならヒット、数だけが同じで桁が異なればブローと呼ぶ。例えば正解が1234で回答が2135なら「1ヒット、2ブロー」とな
// 2-3を繰り返し、4桁の数が完全に同じになるまでの回数で勝負を決める
// 次郎と春子は遊ぶうちに計算を毎回行うのが面倒になったため、ヒット数とブロー数を算出するプログラムを作成することにしました。
// 正解と回答を入力し、ヒット数とブロー数を出力するプログラムを作成しましょう。

// ◯仕様

// ヒット数とブロー数を判定するjudgeメソッドを定義してください。
// judgeメソッドは正解と回答を引数に受け取り、ヒット数とブロー数の配列を返します。
// 正解と回答は4桁の整数、ヒット数とブロー数は0〜4の整数とします。

// 理解、ヒット優先、

// ◯実行例

// judge(5678, 5678) //=> [4, 0]
// judge(5678, 7612) //=> [1, 1]
// judge(5678, 8756) //=> [0, 4]
// judge(5678, 1234) //=> [0, 0]

// 1.hitとblowそれぞれの関数を定義
// 2.


function judge(int $guess, int $answer): array
{
    $resultArray = [];

    $resultArray = check($guess, $answer);
    return $resultArray;
}

function check(string $guess, string $answer): array
{
    $guessArray = str_split($guess);
    $answerArray = str_split($answer); // 0 => 4, 1 => 3,,,

    $blowCount = blowCheck($guessArray, $answerArray);;
    $hitCount = hitCheck($guessArray, $answerArray);
    $blowCount -=  $hitCount;
    return [$hitCount, $blowCount];
}

function blowCheck($guessArray, $answerArray)
{
    return count(array_intersect($guessArray, $answerArray));
}

function hitCheck($guessArray, $answerArray)
{
    return count(array_intersect_assoc($guessArray, $answerArray));
}

$test = judge(5678, 7612);
var_dump($test);
