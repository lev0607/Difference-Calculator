<?php

namespace Differ\genDiff;

function genDiff($pathToFile1, $pathToFile2)
{
    try {
        $jsonBefore = getData($pathToFile1);
    } catch (\Exception $e) {
        echo $e;
    }
    try {
        $jsonAfter = getData($pathToFile2);
    } catch (\Exception $e) {
        echo $e;
    }

    return getDiff($jsonBefore, $jsonAfter);

}

function getData($pathToFile)
{
    if (!is_readable($pathToFile)) {
        throw new \Exception("'{$pathToFile}' is not readble");
    }

    return json_decode(file_get_contents("$pathToFile"), true);
}

function getDiff($jsonBefore, $jsonAfter)
{
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
    return implode("\n", $result) . "\n"; 
}
// print_r(genDiff("before.json", "after.json"));
