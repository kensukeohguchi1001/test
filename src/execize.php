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
//

// タスクばらし

// インプットの値を受け取る
// データ構造の形に変更する [ch] => [min,min]
// [1] => [30,25] [2] => [30]...
// チャンネルごとの視聴分数と視聴回数を算出する
// 表示する

const chunkNumber = 2;

function getInput():array
{
  $input = array_slice($_SERVER['argv'],1);
  $inputs = array_chunk($input, chunkNumber);
  return $inputs;
}

function groupChannelViewingPeriods (array $inputs): array
{
  $channelViewingPeriods = [];
  foreach($inputs as $input ){
      $chan = $input[0];
      $min = $input[1];
      $mins = (array) $min;
      if (array_key_exists($chan, $channelViewingPeriods)){
        $mins = array_merge($mins, $channelViewingPeriods[$chan]);
      }
      $channelViewingPeriods[$chan] =  $mins;
    }
    return $channelViewingPeriods;
  }

function ViewingTimeSum(array $channelViewingPeriods):float
{
  $viewingTime = [];
  foreach($channelViewingPeriods as $period) {
    $viewingTime = array_merge($viewingTime,$period);
  }
  $viewingSum = array_sum($viewingTime);
  return round($viewingSum/60,1);
}
// データ構造を考える
// [1] => [45].
function displayViewingTimes(array $channelViewingPeriods):void
{
  $viewingSum = ViewingTimeSum($channelViewingPeriods);
  echo $viewingSum . PHP_EOL;
  foreach($channelViewingPeriods as $chan => $mins){
    echo $chan . ' ' . array_sum($mins) . PHP_EOL;
  }
}

$inputs = getInput();
$channelViewingPeriods = groupChannelViewingPeriods($inputs);
displayViewingTimes($channelViewingPeriods);
// 配列
