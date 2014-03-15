<?php

use Paliari\TextObject\Column,
    Paliari\TextObject\File,
    Paliari\TextObject\RowParams,
    Paliari\TextObject\RowValues,
    Paliari\TextObject\Filters\FDate,
    Paliari\TextObject\Filters\FEmail;

require_once "vendor/autoload.php";

$d = new FDate('12/09/2012');
$d->setFormat('DD/MM/YYYY');

$d = new FEmail('aa@a.z');
$v = '--1';
var_export(filter_var($v, FILTER_VALIDATE_INT));
exit;

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

//$r->addColumn(Column::create()->setInit(0)->setLength(10)->setType('string')->setName('nome'));



//var_export($r->toArray());
