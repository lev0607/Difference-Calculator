<?php

namespace Differ\formatters\formatPlain;

function parserPlain($diff, $path = '')
{
    return array_map(function ($item) use (&$parser, &$path) {
        $key = $item['key'];

        switch ($item['state']) {
            case 'unchanged':
                if ($item['type'] == 'node') {
                    return implode("\n", array_filter(parserPlain($item['children'], "{$path}{$key}.")));
                }
                return;
            case 'deleted':
                $value = formatDiff($item['value']);
                return "Property {$path}{$key} was removed";
            case 'added':
                $value = formatDiff($item['value']);
                return "Property {$path}{$key} was added with value: '{$value}'";
            case 'changed':
                $valueBefore = formatDiff($item['valueBefore']);
                $valueAfter = formatDiff($item['valueAfter']);
                return "Property {$path}{$key} was. changed From '{$valueBefore}' to '{$valueAfter}'";
        }
    }, $diff);
}

function formatDiff($item)
{
    if (is_array($item)) {
        return 'complex value';
    }

    if (is_bool($item)) {
        $value = json_encode($item);
        return $value;
    }

    return $item;
}

function resultPlain($diff)
{
    return implode("\n", array_filter(parserPlain($diff))) . "\n";
}
