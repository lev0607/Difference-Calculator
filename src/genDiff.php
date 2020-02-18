<?php

namespace Differ\genDiff;

function genDiff($pathToFile1, $pathToFile2)
{
    $jsonBefore = json_decode(file_get_contents("$pathToFile1"), true);
    $jsonAfter = json_decode(file_get_contents("$pathToFile2"), true);
    $result = ["{"];
    foreach ($jsonBefore as $key => $value) {
        if (array_key_exists($key, $jsonAfter)) {
            $result[] = $jsonAfter[$key] === $jsonBefore[$key] ? "    {$key}: {$jsonBefore[$key]}"
             : "  - {$key}: {$jsonBefore[$key]}\n  + {$key}: {$jsonAfter[$key]}";
        } else {
            $result[] = "  - {$key}: {$jsonBefore[$key]}";
        }
    }
    foreach ($jsonAfter as $key => $value) {
        if (!array_key_exists($key, $jsonBefore)) {
            $result[] = "  + {$key}: {$jsonAfter[$key]}";
        }
    }
    $result[] = "}";
    $result[] = "\n";
    return implode("\n", $result);
}

// print_r(genDiff("before.json", "after.json"));
