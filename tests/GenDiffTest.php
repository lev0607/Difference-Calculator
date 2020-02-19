<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\genDiff\genDiff;

class GenDiffTest extends TestCase
{
    public function testJson()
    {
        $path1 = 'tests/fixtures/before.json';
        $path2 = 'tests/fixtures/after.json';
        $expected = file_get_contents("tests/fixtures/correctJson");
        $this->assertEquals($expected, genDiff($path1, $path2));
    }
    public function testYaml()
    {
        $path1 = 'tests/fixtures/before.yaml';
        $path2 = 'tests/fixtures/after.yaml';
        $expected = file_get_contents("tests/fixtures/correctJson");
        $this->assertEquals($expected, genDiff($path1, $path2));
    }
}