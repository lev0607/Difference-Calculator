<?php

namespace Differ\parsers;

use Symfony\Component\Yaml\Yaml;

function parseData($path)
{
    if (!is_readable($path)) {
        throw new \Exception("'{$path}' is not readble");
    }

    $extension = pathinfo($path, PATHINFO_EXTENSION);

    if ($extension === 'json') {
        return json_decode(file_get_contents("$path"), true);
    } elseif ($extension === 'yaml') {
        return Yaml::parse(file_get_contents("$path"));
    } else {
        throw new \Exception("'{$extension}' - this extension is not supported");
    }
}
