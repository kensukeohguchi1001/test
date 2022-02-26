<?php

function sayHello(string $argsString): void
{
  echo "hello" . $argsString . PHP_EOL;
}

sayHello('world');
