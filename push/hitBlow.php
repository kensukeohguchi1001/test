<?php

// 1.出題者は重複した数を含まない4桁の数を決める
// 2.回答者は4桁の数を予想する
// 3.出題者は解答者の予想を判定する。数と桁の療法が同じならヒット、数だけが同じで桁が異なればブローと呼ぶ。例えば正解が1234で回答が2135なら「1ヒット、2ブロー」とな
// 4.2-3を繰り返し、4桁の数が完全に同じになるまでの回数で勝負を決める
// 次郎と春子は遊ぶうちに計算を毎回行うのが面倒になったため、ヒット数とブロー数を算出するプログラムを作成することにしました。
// 正解と回答を入力し、ヒット数とブロー数を出力するプログラムを作成しましょう。

// ◯仕様

// ヒット数とブロー数を判定するjudgeメソッドを定義してください。
// judgeメソッドは正解と回答を引数に受け取り、ヒット数とブロー数の配列を返します。
// 正解と回答は4桁の整数、ヒット数とブロー数は0〜4の整数とします。

// ◯実行例

// judge(5678, 5678) //=> [4, 0]
// judge(5678, 7612) //=> [1, 1]
// judge(5678, 8756) //=> [0, 4]
// judge(5678, 1234) //=> [0, 0]

// 配列を返す[hit数,blow数];
// $result = [$hit,$blow];
// もしこれらの数を配列に入れたとしたら？


function judge (int $result, int $partnerResult):array
{
  $hitCount = 0;
  $blowCount = 0;
  $hitAndBlowResult = [];
  $hitArray = [];
  $blowArray = [];

  $resultArray = str_split((string) $result);
  $partnerArray = str_split((string) $partnerResult);

  foreach($resultArray as $result){
    foreach($partnerArray as $partnerResult){
      if($result === $partnerResult){
        $hitCount++;
      }
    }
    if(in_array($result,$partnerArray)){
      $blowCount++;
    }
  }

  $hitAndBlowResult = [$hitCount,$blowCount];
  return $hitAndBlowResult;
}


$test = judge(0050,5678);
print_r($test);
// judge(5678, 7612);
// judge(5678, 8756);
// judge(5678, 1234);
