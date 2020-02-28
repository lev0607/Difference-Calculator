<?php

namespace Differ\parsers;

function parser($diff, $depth = 0)
{
    return array_map(function ($item) use (&$parser, &$depth) {
        $key = $item['key'];
        $offsets = [
            "base" => "    ",
            "deleted" => "  - ",
            "added" => "  + ",
            "depth" => str_repeat("    ", $depth)
        ];

        switch ($item['state']) {
            case 'unchanged':
                if ($item['type'] == 'node') {
                    $value = implode("\n", parser($item['children'], $depth + 1)) . "\n{$offsets["base"]}}";
                    return "{$offsets["depth"]}{$offsets["base"]}{$key}: {\n{$value}";
                }
                $value = formatDiff($item['value'], $offsets);
                return "{$offsets['depth']}{$offsets['base']}{$key}: {$value}";
            case 'deleted':
                $value = formatDiff($item['value'], $offsets);
                return "{$offsets['depth']}{$offsets['deleted']}{$key}: {$value}";
            case 'added':
                $value = formatDiff($item['value'], $offsets);
                return "{$offsets['depth']}{$offsets['added']}{$key}: {$value}";
            case 'changed':
                $valueBefore = formatDiff($item['valueBefore'], $offsets);
                $valueAfter = formatDiff($item['valueAfter'], $offsets);
                return "{$offsets['depth']}{$offsets['deleted']}{$key}: {$valueBefore}\n" .
                "{$offsets['depth']}{$offsets['added']}{$key}: {$valueAfter}";
        }
    }, $diff);
}

function formatDiff($item, $offsets)
{
    if (is_array($item)) {
        $prettyValue = json_encode($item, JSON_PRETTY_PRINT);
        $deleteСharacters = str_replace(['"', ','], '', $prettyValue);
        $addOffset = str_replace(
            "\n{$offsets['base']}",
            "\n{$offsets['depth']}{$offsets['base']}{$offsets['base']}",
            $deleteСharacters
        );
        $value = str_replace("\n}", "\n{$offsets['depth']}{$offsets['base']}}", $addOffset);
        return $value;
    }

    if (is_bool($item)) {
        $value = json_encode($item);
        return $value;
    }

    return $item;
}

function resultParsing($diff)
{
    return "{\n"  . implode("\n", parser($diff)) . "\n}\n";
}
