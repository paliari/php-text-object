<?php
use Paliari\TextObject\Filters\FDateTime;

/**
 * Class FDateTimeTest
 */
class FDateTimeTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException DomainException
     */
    public function testRequired()
    {
        $f = new FDateTime(true);
        $f('');
    }

    /**
     * Se a data nao e obrigatorio.
     */
    public function testNoRequired()
    {
        $f = new FDateTime();
        $this->assertEquals('', $f(''));
        $this->assertNull($f(''));
        $this->assertNull($f(null));
        $this->assertEquals(new DateTime('2014-01-01 23:45:15'), $f('2014-01-01 23:45:15'));
        $f->setFormat('Y-m-d');
//        $this->assertEquals(new DateTime('2014-01-01'), $f('2014-01-01'));
    }

    /**
     * Se passar uma data invalida.
     *
     * @expectedException DomainException
     */
    public function testInvalid()
    {
        $f = new FDateTime();
        $d = 'lll';
        $f($d);
    }

    /**
     * Testa datas num periodo de 10 anos.
     *
     * @group long1
     */
    public function testPeriodo()
    {
        $stop = date('Y', time()) + 5;
        $ano  = date('Y', time()) - 5;
        $mes  = 1;
        $dia  = 0;
        $f    = new FDateTime();
        while ($ano <= $stop) {
            $timestamp = mktime(0, 0, 0, $mes, $dia + 1, $ano);
            $dia       = date('d', $timestamp);
            $mes       = date('m', $timestamp);
            $ano       = date('Y', $timestamp);
            $dt = new DateTime("$ano-$mes-$dia");
            $dt->setTime(0, 0, 0);
            $f->setFormat('Y-m-d');
            $this->assertEquals($dt, $f("$ano-$mes-$dia"));
            $f->setFormat('d/m/Y');
            $this->assertEquals($dt, $f("$dia-$mes-$ano"));
            $f->setFormat('dmY');
            $this->assertEquals($dt, $f("$dia$mes$ano"));
            $f->setFormat('Ymd');
            $this->assertEquals($dt, $f("$ano$mes$dia"));
        }

    }

    /**
     * testa com data time de um dia inteiro a cada segundo.
     *
     * @group long
     */
    public function testPeriodoTime()
    {
        $y = date('Y', time());
        $m = date('m', time());
        $d = date('d', time());
        $h = 0;
        $i = 0;
        $s = 0;

        $stp = $d + 1;
        $f   = new FDateTime();

        while ($d < $stp) {
            $tmstp = mktime($h, $i, $s + 1, $m, $d, $y);
            $d     = str_pad(date('d', $tmstp), 2, '0', STR_PAD_LEFT);
            $m     = str_pad(date('m', $tmstp), 2, '0', STR_PAD_LEFT);
            $y     = str_pad(date('Y', $tmstp), 2, '0', STR_PAD_LEFT);
            $h     = str_pad(date('H', $tmstp), 2, '0', STR_PAD_LEFT);
            $i     = str_pad(date('i', $tmstp), 2, '0', STR_PAD_LEFT);
            $s     = str_pad(date('s', $tmstp), 2, '0', STR_PAD_LEFT);

            $f->setFormat('YmdHis');
            $this->assertEquals(new DateTime("$y-$m-$d $h:$i:$s"), $f("$y$m$d$h$i$s"));
            $f->setFormat('dmYHis');
            $this->assertEquals(new DateTime("$y-$m-$d $h:$i:$s"), $f("$d$m$y$h$i$s"));
        }
    }
}