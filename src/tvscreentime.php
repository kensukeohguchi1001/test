<?php

while (true)
{
  echo 'チャンネルを入力してください' . PHP_EOL;
  $chanel= trim(fgets(STDIN));
  echo '視聴時間を入力してください' . PHP_EOL;
  $time = trim(fgets(STDIN));

// $timeの数を数える処理





  $screenTime[] = [
    'chanel' => $chanel,
    'time' => $time
  ];

  foreach( $screenTime as $key => $val)
  {
    if($val['chanel'] > 12 || $val['chanel'] < 1){
      echo '1から12の数字を入力してください';
      return;
    }
    if ($val['time'] > 1440 || $val['time'] < 1)
    {
      echo '1から1440の数字を入力してください';
      return;
    }
    echo $val['chanel'] . ' ' .$val['time'] . $count . PHP_EOL;
  }
}






// 時間を受け取って、プラスしていく
// プラスする際に分数をhに直す（/60）
