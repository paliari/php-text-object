<?php

use Paliari\TextObject\File;

/**
 * Class FileTest
 */
class FileTest extends PHPUnit_Framework_TestCase
{

    /**
     * Teste de carregar arquivo.
     */
    public function testLoad()
    {
        $f = new File(__DIR__ . '/test.txt');
        $lines = $f->load();
        $a = array (
            '123452umaxxx20140323 0023452 email@dominio.com 0000023.45
',
            '123452umaxxx20140323 0023452 email@dominio.com 0000023.45
',
        );
        $this->assertEquals($a, $lines);
        var_export($lines);
    }

    /**
     * Testa quando o arquivo nao existe.
     *
     * @expectedException Exception
     */
    public function testNotExist()
    {
        $f = new File(__DIR__ . '/nofile');
        $f->load();
    }
} 