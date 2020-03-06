<?php

namespace Differ\genDiff;

use function Differ\renderer\renderFormatters;
use function Differ\parsers\parseData;

function genDiff($path1, $path2, $format)
{
    $data1 = parseData($path1);
    $data2 = parseData($path2);
    return renderFormatters($data1, $data2, $format);
}
