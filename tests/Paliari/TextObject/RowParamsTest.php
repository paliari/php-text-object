<?php

use Paliari\TextObject\RowParams,
    Paliari\TextObject\Column,
    Paliari\TextObject\Filters\FInt,
    Paliari\TextObject\Filters\FString;

/**
 * Class RowParamsTest
 */
class RowParamsTest extends PHPUnit_Framework_TestCase
{

    /**
     * Test add cols.
     */
    public function testAdd()
    {
        $rp = new RowParams();
        $c1 = new Column(0, 2, new FInt());
        $c2 = new Column(2, 3, new FString());
        $rp->addColumn('c1', $c1)
            ->addColumn('c2', $c2);
        $cols = array(
            'c1' => $c1,
            'c2' => $c2,
        );
        $this->assertEquals($cols, $rp->getColumns());
    }
} 