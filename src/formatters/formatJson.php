<?php

namespace Differ\formatters\formatJson;

function resultJson($diff)
{
    return json_encode($diff, JSON_PRETTY_PRINT) . "\n";
}
