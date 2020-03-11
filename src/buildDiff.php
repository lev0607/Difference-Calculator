<?php

namespace Differ\buildDiff;

function buildDiff($before, $after)
{
    $keys = array_keys(array_merge($before, $after));
    $f = function ($key) use ($before, $after) {
        if (!array_key_exists($key, $before)) {
            return [
                "key" => $key,
                "value" => $after[$key],
                "type" => "added"
                ];
        }
        if (!array_key_exists($key, $after)) {
            return [
                "key" => $key,
                "value" => $before[$key],
                "type" => "deleted"
                ];
        }
        if (array_key_exists($key, $after) && array_key_exists($key, $before)) {
            if (is_array($before[$key]) && is_array($after[$key])) {
                return [
                    "key" => $key,
                    "children" => buildDiff($before[$key], $after[$key]),
                    "type" => "node"
                ];
            }

            if ($before[$key] === $after[$key]) {
                return [
                    "key" => $key,
                    "value" => $before[$key],
                    "type" => "unchanged"
                    ];
            }

            if ($before[$key] !== $after[$key]) {
                return [
                    "key" => $key,
                    "valueBefore" => $before[$key],
                    "valueAfter" => $after[$key],
                    "type" => "changed"
                    ];
            }
        }
    };
    $result = array_map($f, $keys);
    return $result;
}
