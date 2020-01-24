<?php
use Paliari\TextObject\Filters\FEmail;
use PHPUnit\Framework\TestCase;

class FEmailTest extends TestCase
{
    public function testRequired()
    {
        $this->expectException('DomainException');
        $f = new FEmail(true);
        $f('');
    }

    /**
     * Se o email nao e obrigatorio.
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
     */
    public function testInvalid()
    {
        $this->expectException('DomainException');
        $f     = new FEmail();
        $email = 'x@xx';
        $f($email);
    }

}
