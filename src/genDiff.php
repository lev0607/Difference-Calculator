<?php

namespace Differ\genDiff;

function genDiff($pathToFile1, $pathToFile2)
{
    try {
        $before = getData($pathToFile1);
    } catch (\Exception $e) {
        echo $e;
    }
    try {
        $after = getData($pathToFile2);
    } catch (\Exception $e) {
        echo $e;
    }

    return getDiff($before, $after);
}

function getData($pathToFile)
{
    if (!is_readable($pathToFile)) {
        throw new \Exception("'{$pathToFile}' is not readble");
    }

    return json_decode(file_get_contents("$pathToFile"), true);
}

function getDiff($before, $after)
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
