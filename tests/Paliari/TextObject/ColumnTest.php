<?php
use Paliari\TextObject\Column,
    Paliari\TextObject\Filters\FInt,
    Paliari\TextObject\Filters\FString;

/**
 * Class ColumnTest
 * @package Paliari\TextObject
 *
 */
class ColumnTest extends PHPUnit_Framework_TestCase
{

    public function testExtractValue()
    {
        $c = new Column(0, 2, new FInt(true));
        $this->assertEquals(12, $c->extractValue('12jdfklasjfla'));
        $this->assertEquals(45, $c->extractValue('45jdfklasjfla'));
        $c = new Column(3, 2, new FInt(true));
        $this->assertEquals(45, $c->extractValue('xxx45jdfklasjfla'));
        $this->assertEquals(45, $c->extractValue('   45   '));

        $c = new Column(3, 2, new FString(true));
        $this->assertEquals('xa', $c->extractValue('   xa   '));
    }

    public function testExtractValues()
    {
        $line = 'abcdefghijklmnopqrstuvxz';
        $c = new Column(3, 2, new FString(true));
        $this->assertEquals('de', $c->extractValue($line));
        for ($i = 0; $i < strlen($line); $i++) {
            $v = substr($line, $i, 2);
            $c = new Column($i, 2, new FString(true));
            $this->assertEquals($v, $c->extractValue($line));
        }
    }
}