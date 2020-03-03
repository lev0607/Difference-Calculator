<?php

namespace Differ\buildDiff;

function buildDiff($before, $after)
{
    $keys = array_keys(array_merge($before, $after));
    $f = function ($key) use (&$before, &$after, &$getDiff) {
        if (!array_key_exists($key, $before)) {
            return [
                "key" => $key,
                "value" => $after[$key],
                "state" => "added",
                "type" => "leaf"
                ];
        }
        if (!array_key_exists($key, $after)) {
            return [
                "key" => $key,
                "value" => $before[$key],
                "state" => "deleted",
                "type" => "leaf"
                ];
        }
        if (array_key_exists($key, $after) && array_key_exists($key, $before)) {
            if (is_array($before[$key]) && is_array($after[$key])) {
                return [
                    "key" => $key,
                    "children" => buildDiff($before[$key], $after[$key]),
                    "state" => "unchanged",
                    "type" => "node"
                ];
            }

            if ($before[$key] === $after[$key]) {
                return [
                    "key" => $key,
                    "value" => $before[$key],
                    "state" => "unchanged",
                    "type" => "leaf"
                    ];
            }

            if ($before[$key] !== $after[$key]) {
                return [
                    "key" => $key,
                    "valueBefore" => $before[$key],
                    "valueAfter" => $after[$key],
                    "state" => "changed",
                    "type" => "leaf"
                    ];
            }
        }
    };
    $result = array_map($f, $keys);
    return $result;
}
