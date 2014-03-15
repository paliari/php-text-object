<?php

use Paliari\TextObject\Column,
    Paliari\TextObject\File,
    Paliari\TextObject\RowParams,
    Paliari\TextObject\RowValues,
    Paliari\TextObject\Filters\FDate,
    Paliari\TextObject\Filters\FEmail;

require_once "vendor/autoload.php";

$result = array();

$rp = new RowParams();
$rp->addColumn('tipo', new Column(0, 1));
$rp->addColumn('id', new Column(1, 3));
$rp->addColumn('va', new Column(4, 3));
$rp->addColumn('x', new Column(7, 3));
$rp->addColumn('descricao', new Column(10, 14));
$rp->addColumn('nome', new Column(24, 9));

$f = new File('teste.txt');
$f->load();
foreach ($f->getRows() as $v) {
    $rv = new RowValues($rp, $v);
    $result[] = $rv->parse();
}

var_export($result);
