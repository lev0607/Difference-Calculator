<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\genDiff\genDiff;

class GenDiffTest extends TestCase
{
    public function testNestedJson()
    {
        $path1 = 'tests/fixtures/nested/before.json';
        $path2 = 'tests/fixtures/nested/after.json';

        $expected = file_get_contents("tests/fixtures/nested/correct");
        $this->assertEquals($expected, genDiff($path1, $path2, 'pretty'));

        $expected = file_get_contents("tests/fixtures/nested/correctNested");
        $this->assertEquals($expected, genDiff($path1, $path2, 'plain'));

        $expected = file_get_contents("tests/fixtures/nested/correctJson");
        $this->assertEquals($expected, genDiff($path1, $path2, 'json'));
    }
    public function testNestedYaml()
    {
        $path1 = 'tests/fixtures/nested/before.yaml';
        $path2 = 'tests/fixtures/nested/after.yaml';

        $expected = file_get_contents("tests/fixtures/nested/correct");
        $this->assertEquals($expected, genDiff($path1, $path2, 'pretty'));

        $expected = file_get_contents("tests/fixtures/nested/correctNested");
        $this->assertEquals($expected, genDiff($path1, $path2, 'plain'));

        $expected = file_get_contents("tests/fixtures/nested/correctJson");
        $this->assertEquals($expected, genDiff($path1, $path2, 'json'));
    }
}
