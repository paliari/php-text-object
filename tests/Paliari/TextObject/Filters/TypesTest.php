<?php

use Paliari\TextObject\Filters\Types;

/**
 * Class TypesTest
 */
class TypesTest extends PHPUnit_Framework_TestCase
{

    /**
     * Testa se está buscando todos types.
     */
    public function testGetType()
    {
        foreach (Types::getTypes() as $k => $v) {
            $t = Types::getType($k);
            $this->assertInstanceOf('Paliari\TextObject\Filters\AbstractFilter', $t);
            $this->assertFalse((bool)$t(''));
        }
    }

    /**
     * Testa a instancia de todos types e compara quando required.
     */
    public function testGetTypeRequired()
    {
        foreach (Types::getTypes() as $k => $v) {
            $t = Types::getType($k);
            $this->assertInstanceOf('Paliari\TextObject\Filters\AbstractFilter', $t);
            $r = Types::getType($k, true);
            $this->assertInstanceOf('Paliari\TextObject\Filters\AbstractFilter', $r);
            $this->assertNotEquals($t, $r);

            $t2 = Types::getType($k);
            $this->assertEquals($t, $t2);
            $r2 = Types::getType($k, true);
            $this->assertEquals($r, $r2);
        }
    }

    /**
     * teste de types customizados.
     */
    public function testAddType()
    {
        $type = 'custon';
        Types::addType($type, 'CustonFilter');
        $t = Types::getType($type);
        $this->assertInstanceOf('CustonFilter', $t);
        $r = Types::getType($type, true);
        $this->assertNotEquals($t, $r);

        $t2 = Types::getType($type);
        $this->assertEquals($t, $t2);
        $r2 = Types::getType($type, true);
        $this->assertEquals($r, $r2);
    }

    /**
     * Teste validacao de type existente.
     *
     * @expectedException DomainException
     */
    public function testAddTypeExistente()
    {
        Types::addType('string', 'CustonFilter');
    }

    /**
     * Teste validacao de type duplicado.
     *
     * @expectedException DomainException
     */
    public function testAddTypeDuplicado()
    {
        Types::addType('custon', 'CustonFilter');
        Types::addType('custon', 'CustonFilter');
    }

    /**
     * Testa hasType.
     */
    public function testHasType()
    {
        $this->assertFalse(Types::hasType('custon1'));
        $this->assertTrue(Types::hasType('string'));
        Types::addType('custon1', 'CustonFilter');
        $this->assertTrue(Types::hasType('custon1'));
    }
}

/**
 * Class CustonFilte para teste de type customisado.
 */
class CustonFilter extends \Paliari\TextObject\Filters\AbstractFilter
{

}