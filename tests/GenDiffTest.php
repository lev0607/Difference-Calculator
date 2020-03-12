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

    /**
     * @dataProvider additionProvider
     */

    public function testDiff($fixture, $extention, $format)
    {
        $expected = $this->readFile($fixture);
        $actual = genDiff(
            $this->getFixturePath('before.' . $extention),
            $this->getFixturePath('after.' . $extention),
            $format
        );
        $this->assertEquals($expected, $actual);
    }
    
    public function additionProvider()
    {
        return [
            ['correctPretty', 'json', 'pretty'],
            ['correctPlain','json', 'plain'],
            ['correctJson','json', 'json'],
            ['correctPretty','yaml', 'pretty'],
            ['correctPlain','yaml', 'plain'],
            ['correctJson','yaml', 'json']
        ];
    }
}
