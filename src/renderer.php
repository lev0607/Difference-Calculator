<?php

namespace Differ\renderer;

use function Differ\formatters\formatPretty\formatPretty;
use function Differ\formatters\formatPlain\formatPlain;
use function Differ\formatters\formatJson\formatJson;
use function Differ\buildDiff\buildDiff;

function renderFormatters($before, $after, $format)
{
    switch ($format) {
        case 'plain':
            return formatPlain(buildDiff($before, $after));
        case 'pretty':
            return formatPretty(buildDiff($before, $after));
        case 'json':
            return formatJson(buildDiff($before, $after));
        default:
            throw new \Exception("Unknown format: {$format}!");
    }
}
