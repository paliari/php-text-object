<?php
use Paliari\TextObject\Filters\FDateTime,
    Paliari\TextObject\Filters\FEmail,
    Paliari\TextObject\Filters\FString,
    Paliari\TextObject\Filters\FDouble,
    Paliari\TextObject\Filters\FInt,
    Paliari\TextObject\Filters\FNumberString;
use PHPUnit\Framework\TestCase;

/**
 * Class FDateTime
 */
class FiltersTest extends TestCase
{

    /**
     * Testa se todos os models estão sendo instanciados.
     */
    public function testInstance()
    {
        $diretorio = ROOT . '/src/Filters';
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
        $f = new FDateTime();
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

    public function testRequiredDate()
    {
        $this->expectException('DomainException');
        $d = new FDateTime(true);
        $this->assertEquals('', $d(''));
    }

    public function testRequiredDouble()
    {
        $this->expectException('DomainException');
        $d = new FDouble(true);
        $this->assertEquals('', $d(''));
    }

    public function testRequiredEmail()
    {
        $this->expectException('DomainException');
        $d = new FEmail(true);
        $this->assertEquals('', $d(''));
    }

    public function testRequiredInt()
    {
        $this->expectException('DomainException');
        $d = new FInt(true);
        $this->assertEquals(0, $d(''));
    }

    public function testRequiredNumericString()
    {
        $this->expectException('DomainException');
        $d = new FNumberString(true);
        $this->assertEquals('', $d(''));
    }

    public function testRequiredString()
    {
        $this->expectException('DomainException');
        $d = new FString(true);
        $this->assertEquals('', $d(''));
    }
}
