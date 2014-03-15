<?php

use Paliari\TextObject\Filters\FEmail;

class FEmailTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException DomainException
     */
    public function testRequired()
    {
        $f = new FEmail(true);
        $f('');
    }

    /**
     * Se a data nao e obrigatorio.
     */
    public function testNoRequired()
    {
        $f = new FEmail();
        $this->assertEquals('', $f(''));
        $email = 'xx@xx.xx';
        $this->assertEquals($email, $f($email));
    }

    /**
     * Se passar um email invalido.
     *
     * @expectedException DomainException
     */
    public function testInvalid()
    {
        $f = new FEmail();
        $email = 'x@xx';
        $f($email);
    }

}