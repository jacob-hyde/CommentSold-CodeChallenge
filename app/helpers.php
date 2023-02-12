<?php

function convertCentsToDollars(int $cents): float
{
    return (float) number_format(($cents /100), 2, '.', ' ');
}
