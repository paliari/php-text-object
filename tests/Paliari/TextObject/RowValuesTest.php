<?php
use Paliari\TextObject\RowValues,
    Paliari\TextObject\RowParams,
    Paliari\TextObject\Column,
    Paliari\TextObject\Filters\FInt,
    Paliari\TextObject\Filters\FString;

/**
 * Class RowValuesTest
 */
class RowValuesTest extends PHPUnit_Framework_TestCase
{

    public function testParse()
    {
        $rp = new RowParams();
        $rp->addColumn('c1', new Column(0, 2, new FInt()))
            ->addColumn('c2', new Column(2, 3, new FString()));
        $content = '23abc   iii';
        $rv      = new RowValues($rp, $content);
        $this->assertEquals($content, $rv->getContent());
        $expected = array(
            'c1' => 23,
            'c2' => 'abc',
        );
        $this->assertEquals($expected, $rv->parse());
    }
} 