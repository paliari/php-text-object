<?php

use Paliari\TextObject\Column,
    Paliari\TextObject\File,
    Paliari\TextObject\RowParams,
    Paliari\TextObject\RowValues,
    Paliari\TextObject\Filters\FInt,
    Paliari\TextObject\Filters\FDate,
    Paliari\TextObject\Filters\FString,
    Paliari\TextObject\Filters\FNumberString,
    Paliari\TextObject\Filters\FDouble,
    Paliari\TextObject\Filters\FEmail,
    Paliari\TextObject\FileFacade;

require_once "vendor/autoload.php";


$result = array();

$rp = new RowParams();
$rp->addColumn('id', new Column(0, 2, new FInt(true)));
$rp->addColumn('c1', new Column(2, 3, new FDouble()));
$rp->addColumn('c2', new Column(5, 10, new FNumberString()));
$rp->addColumn('c3', new Column(15, 5, new FString()));
$rp->addColumn('c4', new Column(20, 10, new FEmail()));
$rp->addColumn('c5', new Column(30, 19, new FDate()));

$file_name = 'teste.txt';
$f = new File($file_name);
$f->load();
foreach ($f->getRows() as $v) {
    $rv = new RowValues($rp, $v);
    $result[] = $rv->parse();
}

var_export($result);

$result = FileFacade::create($file_name)
    ->addColumn('id', 0, 2, new FInt(true))
    ->addColumn('c1', 2, 3, new FDouble())
    ->addColumn('c2', 5, 10, new FNumberString())
    ->addColumn('c2', 15, 5, new FString())
    ->addColumn('c2', 20, 10, new FEmail())
    ->addColumn('c2', 30, 19, new FDate())
    ->exec()
;
var_export($result);