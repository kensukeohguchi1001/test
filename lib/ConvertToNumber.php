<?php

function convertToNumber(string ...$cardHands): array
{
    $resultCard = array_map(fn ($card) => substr($card,1) , $cardHands);
    var_dump($resultCard);
    return $resultCard;
}

convertToNumber('C7');               // => ['7']
convertToNumber('H3', 'S10', 'DA');  // => ['3', '10', 'A']
