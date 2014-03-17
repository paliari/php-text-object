<?php

use Paliari\TextObject\Column,
    Paliari\TextObject\File,
    Paliari\TextObject\RowParams,
    Paliari\TextObject\RowValues,
    Paliari\TextObject\Filters\FInt,
    Paliari\TextObject\Filters\FDateTime,
    Paliari\TextObject\Filters\FString,
    Paliari\TextObject\Filters\FNumberString,
    Paliari\TextObject\Filters\FDouble,
    Paliari\TextObject\Filters\FEmail,
    Paliari\TextObject\FileFacade,
    Paliari\TextObject\Filters\Types;

require_once "vendor/autoload.php";

// exempo de uso da maneira manual.
$result = array();

$rp = new RowParams();
$rp->addColumn('id', new Column(0, 2, new FInt(true)));
$rp->addColumn('c1', new Column(2, 3, new FDouble()));
$rp->addColumn('c2', new Column(5, 10, new FNumberString()));
$rp->addColumn('c3', new Column(15, 5, new FString()));
$rp->addColumn('c4', new Column(20, 10, new FEmail()));
$rp->addColumn('c5', new Column(30, 19, new FDateTime()));

$file_name = 'teste.txt';
$f = new File($file_name);
$f->load();
foreach ($f->getRows() as $v) {
    $rv = new RowValues($rp, $v);
    $result[] = $rv->parse();
}

//var_export($result);

echo PHP_EOL;
echo PHP_EOL;


// exempo de uso da maneira facil (recomendado).
$result = FileFacade::create($file_name)
    ->addColumn('id', 0, 2, Types::INT, true)
    ->addColumn('c1', 2, 3, Types::DOUBLE)
    ->addColumn('c2', 5, 10, Types::NUMBER_STRING)
    ->addColumn('c3', 15, 5, Types::STRING)
    ->addColumn('c4', 20, 10, Types::EMAIL)
    ->addColumn('c5', 30, 19, Types::DATE_TIME, array('format' => 'Y-m-d H:i:s', 'required' => true))
    ->exec()
;
var_export($result);