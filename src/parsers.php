<?php

namespace Differ\parsers;

function parsers($before, $after)
{
    $result = ["{"];
    foreach ($before as $key => $value) {
        if (array_key_exists($key, $after)) {
            $result[] = $after[$key] === $before[$key] ? "    {$key}: {$before[$key]}"
             : "  - {$key}: {$before[$key]}\n  + {$key}: {$after[$key]}";
        } else {
            $result[] = "  - {$key}: {$before[$key]}";
        }
    }
    foreach ($after as $key => $value) {
        if (!array_key_exists($key, $before)) {
            $result[] = "  + {$key}: {$after[$key]}";
        }
    }
    $result[] = "}";
    return implode("\n", $result) . "\n";
}