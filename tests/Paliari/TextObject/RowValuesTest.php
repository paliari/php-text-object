<?php
use Paliari\TextObject\RowValues,
    Paliari\TextObject\RowParams,
    Paliari\TextObject\Column,
    Paliari\TextObject\Filters\FInt,
    Paliari\TextObject\Filters\FString;
use PHPUnit\Framework\TestCase;

/**
 * Class RowValuesTest
 */
class RowValuesTest extends TestCase
{

    public function testParse()
    {
        $rp = new RowParams();
        $rp->addColumn('c1', new Column(0, 2, new FInt()))
           ->addColumn('c2', new Column(2, 3, new FString()))
        ;
        $content = '23abc   iii';
        $rv      = new RowValues($rp, $content);
        $this->assertEquals($content, $rv->getContent());
        $expected = array(
            'c1' => 23,
            'c2' => 'abc',
        );
        $this->assertEquals($expected, $rv->parse());
    }

    /**
     * Conteudo em ISO-8859-1 eh convertido para UTF-8.
     */
    public function testContentLatin1()
    {
        $rp = new RowParams();
        $rp->addColumn('c1', new Column(0, 4, new FString()));
        $content = mb_convert_encoding('ação', 'ISO-8859-1', 'UTF-8');
        $rv      = new RowValues($rp, $content);
        $this->assertSame('ação', $rv->getContent());
        $this->assertSame(['c1' => 'ação'], $rv->parse());
    }
} 
