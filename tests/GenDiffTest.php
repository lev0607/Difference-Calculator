<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\genDiff\genDiff;

class GenDiffTest extends TestCase
{
    private function getFixturePath($fileName)
    {
        return __DIR__ . DIRECTORY_SEPARATOR
            . 'fixtures' . DIRECTORY_SEPARATOR
            . $fileName;
    }

    private function readFile($fileName)
    {
        return file_get_contents($this->getFixturePath($fileName));
    }

    public function testJson()
    {
        $expected = $this->readFile('correct');
        $actual = genDiff(
            $this->getFixturePath('before.json'),
            $this->getFixturePath('after.json'),
            'pretty'
        );
        $this->assertEquals($expected, $actual);

        $expected = $this->readFile("correctNested");
        $actual = genDiff(
            $this->getFixturePath('before.json'),
            $this->getFixturePath('after.json'),
            'plain'
        );
        $this->assertEquals($expected, $actual);

        $expected = $this->readFile("correctJson");
        $actual = genDiff(
            $this->getFixturePath('before.json'),
            $this->getFixturePath('after.json'),
            'json'
        );
        $this->assertEquals($expected, $actual);
    }
    public function testYaml()
    {
        $expected = $this->readFile('correct');
        $actual = genDiff(
            $this->getFixturePath('before.yaml'),
            $this->getFixturePath('after.yaml'),
            'pretty'
        );
        $this->assertEquals($expected, $actual);

        $expected = $this->readFile("correctNested");
        $actual = genDiff(
            $this->getFixturePath('before.yaml'),
            $this->getFixturePath('after.yaml'),
            'plain'
        );
        $this->assertEquals($expected, $actual);

        $expected = $this->readFile("correctJson");
        $actual = genDiff(
            $this->getFixturePath('before.yaml'),
            $this->getFixturePath('after.yaml'),
            'json'
        );
        $this->assertEquals($expected, $actual);
    }
}
