<?php

// ◯インプット
// 入力は以下の形式で与えられます。

// テレビのチャンネル 視聴分数 テレビのチャンネル 視聴分数 ...

// ただし、同じチャンネルを複数回見た時は、それぞれ分けて記録すること。

// チャンネル：数値を指定すること。1〜12の範囲とする（1ch〜12ch）
// 視聴分数：分数を指定すること。1〜1440の範囲とする

// ◯アウトプット
// テレビの合計視聴時間
// テレビのチャンネル 視聴分数 視聴回数
// テレビのチャンネル 視聴分数 視聴回数
// ...

// ただし、閲覧したチャンネルだけ出力するものとする。

// 視聴時間：時間数を出力すること。小数点一桁までで、端数は四捨五入すること

// ◯インプット例

// 1 30 5 25 2 30 1 15

// ◯アウトプット例

// 1.7
// 1 45 2
// 2 30 1
// 5 25 1

// ◯実行コマンド例
// php quiz.php php quiz.php 1 30 5 25 2 30 1 15


function TvScreenTime($argv): array
{
  $documentArray = $argv;
  $arrayChanelTime = array_chunk(array_slice($documentArray, 1), 2);

  $chanelSeparateTime = chanelSeparateTime($arrayChanelTime);
  $chanelTotalScreen = chanelTotalScreen($chanelSeparateTime);
  return [];
}

// 0 => 1
// 1 => 30

// 1 => 30

// 1 => [30, 15]
function chanelSeparateTime(array $arrayChanelTime): array
{
    $screenTime = [];
    foreach ($arrayChanelTime as $chanelTime) {
        $chanel = $chanelTime[0];
        $time = $chanelTime[1];
        $times = [$time];

        if (array_key_exists($chanel, $screenTime)) {
          $times = array_merge($screenTime[$chanel], $times);
        }
        $screenTime[$chanel] = $times;
    }
    return $screenTime;
}

function chanelTotalScreen(array $chanelSeparateTime): float
{
    // どんなデータ構造にしたいのか？
    // 0 => [30.15.16.16...] みたいにしたい
    // 今の状態
    // 1 => [30,15] 2 => [15] 5 => [30]
    // foreachで回して、30,15,15,だけの値を取り出す、それを合計するじゃだめなの？
    $chanelTotalTime = [];
    foreach ($chanelSeparateTime as $chanel => $times) {
        // var_dump($chanel);
        // var_dump($times);

        $chanelTotalTime = array_merge($chanelTotalTime,$times);
    }
      return round(array_sum($chanelTotalTime) / 60, 1);
}

TvScreenTime($argv);
