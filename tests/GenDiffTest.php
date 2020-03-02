<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\genDiff\genDiff;

class GenDiffTest extends TestCase
{
    public function testPlainJson()
    {
        $path1 = 'tests/fixtures/plain/before.json';
        $path2 = 'tests/fixtures/plain/after.json';

        $expected = file_get_contents("tests/fixtures/plain/correct");
        $this->assertEquals($expected, genDiff($path1, $path2, 'pretty'));

        $expected = file_get_contents("tests/fixtures/plain/correctPlain");
        $this->assertEquals($expected, genDiff($path1, $path2, 'plain'));
    }
    public function testPlainYaml()
    {
        $path1 = 'tests/fixtures/plain/before.yaml';
        $path2 = 'tests/fixtures/plain/after.yaml';

        $expected = file_get_contents("tests/fixtures/plain/correct");
        $this->assertEquals($expected, genDiff($path1, $path2, 'pretty'));

        $expected = file_get_contents("tests/fixtures/plain/correctPlain");
        $this->assertEquals($expected, genDiff($path1, $path2, 'plain'));
    }
    public function testNestedJson()
    {
        $path1 = 'tests/fixtures/nested/before.json';
        $path2 = 'tests/fixtures/nested/after.json';

        $expected = file_get_contents("tests/fixtures/nested/correct");
        $this->assertEquals($expected, genDiff($path1, $path2, 'pretty'));

        $expected = file_get_contents("tests/fixtures/nested/correctNested");
        $this->assertEquals($expected, genDiff($path1, $path2, 'plain'));
    }
    public function testNestedYaml()
    {
        $path1 = 'tests/fixtures/nested/before.yaml';
        $path2 = 'tests/fixtures/nested/after.yaml';

        $expected = file_get_contents("tests/fixtures/nested/correct");
        $this->assertEquals($expected, genDiff($path1, $path2, 'pretty'));

        $expected = file_get_contents("tests/fixtures/nested/correctNested");
        $this->assertEquals($expected, genDiff($path1, $path2, 'plain'));
    }

}