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
    Paliari\TextObject\Filters\FEmail;

require_once "vendor/autoload.php";

$result = array();

$rp = new RowParams();
$rp->addColumn('id', new Column(0, 2, new FInt(true)));
$rp->addColumn('c1', new Column(1, 4, new FDouble()));
$rp->addColumn('c2', new Column(4, 11, new FNumberString()));
$rp->addColumn('c3', new Column(15, 5, new FString()));
$rp->addColumn('c4', new Column(20, 10, new FEmail()));
$rp->addColumn('c5', new Column(30, 19, new FDate()));

$f = new File('teste.txt');
$f->load();
foreach ($f->getRows() as $v) {
    $rv = new RowValues($rp, $v);
    $result[] = $rv->parse();
}

var_export($result);
