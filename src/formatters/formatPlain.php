<?php

namespace Differ\formatters\formatPlain;

function getValue($item)
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

function parsePlain($diff, $path = '')
{
    return array_map(function ($item) use (&$path) {
        $key = $item['key'];

        switch ($item['state']) {
            case 'unchanged':
                if ($item['type'] == 'node') {
                    return implode("\n", array_filter(parsePlain($item['children'], "{$path}{$key}.")));
                }
                return;
            case 'deleted':
                $value = getValue($item['value']);
                return "Property {$path}{$key} was removed";
            case 'added':
                $value = getValue($item['value']);
                return "Property {$path}{$key} was added with value: '{$value}'";
            case 'changed':
                $valueBefore = getValue($item['valueBefore']);
                $valueAfter = getValue($item['valueAfter']);
                return "Property {$path}{$key} was changed. From '{$valueBefore}' to '{$valueAfter}'";
            default:
                throw new \Exception("Unknown state: {$item['state']}!");
        }
    }, $diff);
}

function formatPlain($diff)
{
    return implode("\n", array_filter(parsePlain($diff))) . "\n";
}
