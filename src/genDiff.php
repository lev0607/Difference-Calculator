<?php

namespace Differ\genDiff;

use function Differ\parsers\parsers;
use Symfony\Component\Yaml\Yaml;

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

    return parsers($before, $after);
}

function getData($pathToFile)
{
    if (!is_readable($pathToFile)) {
        throw new \Exception("'{$pathToFile}' is not readble");
    }

    $extension = pathinfo($pathToFile, PATHINFO_EXTENSION);

    if ($extension === 'json') {
        return json_decode(file_get_contents("$pathToFile"), true);
    } elseif ($extension === 'yaml') {
        return Yaml::parse(file_get_contents("$pathToFile"));
    } else {
        throw new \Exception("'{$extension}' - this extension is not supported");
    }
}


