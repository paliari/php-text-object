<?php
use Paliari\TextObject\Filters\FDate,
    Paliari\TextObject\Filters\FEmail,
    Paliari\TextObject\Filters\FString,
    Paliari\TextObject\Filters\FDouble,
    Paliari\TextObject\Filters\FInt,
    Paliari\TextObject\Filters\FNumberString;

/**
 * Class FDate
 */
class FiltersTest extends PHPUnit_Framework_TestCase
{

    /**
     * Testa se todos os models estão sendo instanciados.
     */
    public function testInstance()
    {
        $diretorio = ROOT . '/src/Paliari/TextObject/Filters';
        $ponteiro  = opendir($diretorio);

        while ($nome_itens = readdir($ponteiro)) {
            $className = explode('.', $nome_itens)[0];
            if ('' !== $className && 'AbstractFilter' !== $className && 'Types' !== $className) {
                $className = "Paliari\\TextObject\\Filters\\$className";
                $classe = new $className();
                $this->assertTrue($classe instanceof $className);
                $this->assertFalse((bool)$classe(''));
            }
        }
    }

    /**
     * Testa para campos nao obrigatorios
     */
    public function testNoRequired()
    {
        $f = new FDate();
        $this->assertEquals('', $f(''));
        $f = new FEmail();
        $this->assertEquals('', $f(''));
        $f = new FString();
        $this->assertEquals('', $f(''));
        $f = new FNumberString();
        $this->assertEquals('', $f(''));
        $f = new FInt();
        $this->assertEquals(0, $f(''));
        $f = new FDouble();
        $this->assertEquals(0, $f(''));
    }

    /**
     * @expectedException DomainException
     */
    public function testRequiredDate()
    {
        $d = new FDate(true);
        $this->assertEquals('', $d(''));
    }

    /**
     * @expectedException DomainException
     */
    public function testRequiredDouble()
    {
        $d = new FDouble(true);
        $this->assertEquals('', $d(''));
    }

    /**
     * @expectedException DomainException
     */
    public function testRequiredEmail()
    {
        $d = new FEmail(true);
        $this->assertEquals('', $d(''));
    }

    /**
     * @expectedException DomainException
     */
    public function testRequiredInt()
    {
        $d = new FInt(true);
        $this->assertEquals(0, $d(''));
    }

    /**
     * @expectedException DomainException
     */
    public function testRequiredNumericString()
    {
        $d = new FNumberString(true);
        $this->assertEquals('', $d(''));
    }

    /**
     * @expectedException DomainException
     */
    public function testRequiredString()
    {
        $d = new FString(true);
        $this->assertEquals('', $d(''));
    }
}