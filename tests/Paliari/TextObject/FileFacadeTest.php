<?php
use Paliari\TextObject\FileFacade,
    Paliari\TextObject\Filters\FInt,
    Paliari\TextObject\Filters\FDouble,
    Paliari\TextObject\Filters\FNumberString,
    Paliari\TextObject\Filters\FEmail,
    Paliari\TextObject\Filters\FString,
    Paliari\TextObject\Filters\FDateTime;
use PHPUnit\Framework\TestCase;

/**
 * Class FileFacadeTest
 */
class FileFacadeTest extends TestCase
{
    public function testExec()
    {
        $file_name = __DIR__ . '/test_facade.txt';
        $result    = $this->prepareFileFacade()->exec($file_name);
        $this->assertEquals($this->expected(), $result);
    }

    public function testExecRowByRow()
    {
        $file_name = __DIR__ . '/test_facade.txt';
        $ff        = $this->prepareFileFacade();
        $rows      = [];
        $ff->execRowByRow($file_name, function ($row, $ln) use (&$rows) {
            $rows[] = $row;
        });
        $this->assertEquals($this->expected(), $rows);
    }

    protected function expected()
    {
        return [
            [
                'id' => 11,
                'c1' => 2.4,
                'c2' => '5678912323',
                'c3' => 'abcdz',
                'c4' => 'xxx@xxx.xx',
                'c5' => new DateTime('2014-03-23 14:23:32'),
            ],
            [
                'id' => 11,
                'c1' => 2.4,
                'c2' => '5678912323',
                'c3' => 'abcdz',
                'c4' => 'xxx@xxx.xx',
                'c5' => new DateTime('2014-03-23 14:23:32')
            ],
            [
                'id' => 11,
                'c1' => 2.4,
                'c2' => '5678912323',
                'c3' => 'abcdz',
                'c4' => 'aaa@bbb.br',
                'c5' => new DateTime('2014-03-23 14:23:32'),
            ],
        ];
    }

    protected function prepareFileFacade()
    {
        return FileFacade::create()
                         ->addColumn('', 'id', 0, 2, new FInt(true))
                         ->addColumn('', 'c1', 2, 3, new FDouble())
                         ->addColumn('', 'c2', 5, 10, new FNumberString())
                         ->addColumn('', 'c3', 15, 5, new FString())
                         ->addColumn('', 'c4', 20, 10, new FEmail())
                         ->addColumn('', 'c5', 30, 19, new FDateTime())
            ;
    }
}
