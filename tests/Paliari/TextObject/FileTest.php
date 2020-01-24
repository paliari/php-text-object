<?php
use Paliari\TextObject\File;
use PHPUnit\Framework\TestCase;

/**
 * Class FileTest
 */
class FileTest extends TestCase
{

    /**
     * Teste de carregar arquivo.
     */
    public function testLoad()
    {
        $f     = new File(__DIR__ . '/test.txt');
        $lines = $f->load();
        $a     = array(
            '123452umaxxx20140323 0023452 email@dominio.com 0000023.45
',
            '123452umaxxx20140323 0023452 email@dominio.com 0000023.45
',
        );
        $this->assertEquals($a, $lines);
    }

    /**
     * Testa quando o arquivo nao existe.
     */
    public function testNotExist()
    {
        $this->expectException('Exception');
        $f = new File(__DIR__ . '/nofile');
        $f->load();
    }

}
