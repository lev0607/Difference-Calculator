<?php

namespace Differ\parsers;

use function Differ\formatters\formatPretty\resultPretty;
use function Differ\formatters\formatPlain\resultPlain;
use function Differ\formatters\formatJson\resultJson;
use function Differ\getDiff\getDiff;

function parser($before, $after, $format)
{
    if ($format === 'plain') {
        return resultPlain(getDiff($before, $after));
    }
    if ($format === 'pretty') {
        return resultPretty(getDiff($before, $after));
    }
    if ($format === 'json') {
        return resultJson(getDiff($before, $after));
    }
}
