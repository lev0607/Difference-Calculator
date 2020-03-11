<?php

namespace Differ\genDiff;

use function Differ\renderer\renderFormatters;
use function Differ\parsers\parseData;
use function Differ\buildDiff\buildDiff;

function genDiff($path1, $path2, $format)
{
    $data1 = parseData($path1);
    $data2 = parseData($path2);
    $diff = buildDiff($data1, $data2);
    return renderFormatters($diff, $format);
}
