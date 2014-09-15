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
$rp->addColumn('type', new Column(0, 1, new FString(true)));
$rp->addColumn('id', new Column(1, 2, new FInt(true)));
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
$ff = FileFacade::create(1)
    ->addColumn('C', 'type', 0, 1, Types::STRING, true)
    ->addColumn('C', 'id', 1, 2, Types::INT, true)
    ->addColumn('C', 'c1', 2, 3, Types::DOUBLE)
    ->addColumn('C', 'c2', 5, 10, Types::NUMBER_STRING)
    ->addColumn('C', 'c3', 15, 5, Types::STRING)
    ->addColumn('C', 'c4', 20, 10, Types::EMAIL)
    ->addColumn('C', 'c5', 30, 19, Types::DATE_TIME, array('format' => 'Y-m-d H:i:s', 'required' => true))

    ->addColumn('D', 'type', 0, 1, Types::STRING, true)
    ->addColumn('D', 'id', 1, 2, Types::INT, true)
    ->addColumn('D', 'c1', 2, 3, Types::DOUBLE)
    ->addColumn('D', 'c2', 5, 10, Types::NUMBER_STRING)
    ->addColumn('D', 'c3', 15, 5, Types::STRING)
    ->addColumn('D', 'c4', 20, 10, Types::EMAIL)
    ->addColumn('D', 'c5', 30, 19, Types::DATE_TIME, array('format' => 'Y-m-d H:i:s', 'required' => true))

    ->addColumn('', 'type', 0, 1, Types::STRING, true)
    ->addColumn('', 'id', 1, 2, Types::INT, true)
    ->addColumn('', 'c1', 2, 3, Types::DOUBLE)
    ->addColumn('', 'c2', 5, 10, Types::NUMBER_STRING)
    ->addColumn('', 'c3', 15, 5, Types::STRING)
    ->addColumn('', 'c4', 20, 10, Types::EMAIL)
    ->addColumn('', 'c5', 30, 19, Types::DATE_TIME, array('format' => 'Y-m-d H:i:s', 'required' => true))
//    ->exec($file_name)
;
//$result = $ff->exec($file_name);
//var_export($result);


/*
$tipOpe         = substr($reg, 1, 1);
$tipins         = (int)(trim(substr($reg, 2, 2)));
$insmun         = (int)(substr($reg, 4, 15));
$cgcm_id        = (int)(substr($reg, 19, 10));
$nomraz         = utf8_encode(strtoupper(strtr(trim(substr($reg, 29, 60)), "'", "`")));
$tippessoa      = substr($reg, 89, 1);
$cpfcgc         = trim(substr($reg, 90, 14));
$distrito       = (int)(substr($reg, 104, 2));
$zona           = trim(substr($reg, 106, 3));
$quadra         = trim(substr($reg, 109, 15));
$data           = trim(substr($reg, 124, 15));
$complelote     = utf8_encode(strtr(trim(substr($reg, 139, 50)), "'", "`"));
$tiprua         = trim(substr($reg, 189, 10));
$nomrua         = strtoupper(strtr(trim(substr($reg, 199, 60)), "'", "`"));
$numero         = strtr(trim(substr($reg, 259, 10)), "'", "`");
$nombai         = strtoupper(strtr(trim(substr($reg, 269, 50)), "'", "`"));
$cidade         = strtr(trim(substr($reg, 319, 60)), "'", "`");
$excluido       = trim(substr($reg, 379, 1)) == 'S' ? 1 : 0;
$datalt         = $this->dateToPhpValue(trim(substr($reg, 380, 8)), 'Ymd');
$unifed         = trim(substr($reg, 388, 2));
$areatotal      = ((int)substr($reg, 390, 15)) / 100;
$areautil       = ((int)substr($reg, 405, 15)) / 100;
$areaprivativa  = ((int)substr($reg, 420, 15)) / 100;
$areacomum      = ((int)substr($reg, 435, 15)) / 100;
$areaconstruida = ((int)substr($reg, 450, 15)) / 100;
$codcondominio  = (int)(substr($reg, 465, 10));
$condominio     = utf8_encode(addslashes(trim(substr($reg, 475, 100))));
$cep            = $fone = $tipbai = $email = $fonres = $foncom = $foncel = $rg = $orgemi = $codibge = $nomfan = '';
$tipimo         = trim(substr($reg, 575, 1));
$patrimonio     = (int)substr($reg, 576, 3);
$areaverde      = ((int)substr($reg, 579, 15)) / 100;
$id             = $insmun;
$situacao       = $excluido ? 9 : 0;
$comple         = '';
*/
/*

        $tipins     = (int)substr($reg, 1, 2);
        $insmun     = (int)substr($reg, 3, 15);
        $cgcm_id    = (int)substr($reg, 18, 10);
        $nomraz     = utf8_encode(strtoupper(strtr((trim((string)substr($reg, 28, 60))), "'", "`")));
        $tippessoa  = substr($reg, 88, 1);
        $nomrua     = strtr(trim(substr($reg, 89, 60)), "'", "`");
        $numero     = (trim(substr($reg, 149, 10)));
        $comple     = strtr((trim(substr($reg, 159, 40))), "'", "`");
        $nombai     = strtr((trim(substr($reg, 199, 60))), "'", "`");
        $cidadeNome = strtr((trim(substr($reg, 259, 60))), "'", "`");
        $vinculo    = utf8_encode((trim(substr($reg, 319, 30))));
        $principal  = substr($reg, 349, 1) == 'S' ? 1 : 0;
        $percentual = (double)substr($reg, 350, 10) / 1000;
        $cpfcgc     = trim(substr($reg, 360, 14));
        $cep        = preg_replace('/[^0-9]/', '', trim(substr($reg, 374, 8)));
        $cep        = $cep > 0 ? str_pad($cep, 8, '0', STR_PAD_LEFT) : '';
        $fonres     = preg_replace('/[^0-9]/', '', trim(substr($reg, 382, 14)));
        $fonres     = $fonres > 0 ? str_pad($fonres, 10, '0', STR_PAD_LEFT) : '';
        $foncom     = preg_replace('/[^0-9]/', '', trim(substr($reg, 396, 14)));
        $foncom     = $foncom > 0 ? str_pad($foncom, 10, '0', STR_PAD_LEFT) : '';
        $foncel     = preg_replace('/[^0-9]/', '', trim(substr($reg, 410, 14)));
        $foncel     = $foncel > 0 ? str_pad($foncel, 10, '0', STR_PAD_LEFT) : '';
        $unifed     = substr($reg, 424, 2);
        $rg         = (trim(substr($reg, 426, 20)));
        $orgemi     = (trim(substr($reg, 446, 20)));
        $tipvin     = (int)substr($reg, 466, 2);
        $email      = (trim(substr($reg, 468, 100)));
        $tiprua     = (trim(substr($reg, 568, 5)));
 */

$file_name = 'tmp/cadimo_20140912.txt';
$ff = FileFacade::create(1)
    ->addColumn('C', 'typReg', 0, 1, Types::STRING, true)
    ->addColumn('C', 'tipOpe', 1, 1, Types::STRING, true)
    ->addColumn('C', 'tipins', 2, 2, Types::INT, true)
    ->addColumn('C', 'insmun', 4, 15, Types::INT, true)
    ->addColumn('C', 'cgcm_id', 19, 10, Types::INT, true)
    ->addColumn('C', 'nomraz', 29, 60, Types::STRING, true)
    ->addColumn('C', 'tippessoa', 89, 1, Types::STRING, false)
    ->addColumn('C', 'cpfcgc', 90, 14, Types::NUMBER_STRING, false)
    ->addColumn('C', 'distrito', 104, 2, Types::INT, false)
    ->addColumn('C', 'zona', 106, 3, Types::NUMBER_STRING, false)
    ->addColumn('C', 'quadra', 109, 15, Types::NUMBER_STRING, false)
    ->addColumn('C', 'data', 124, 15, Types::NUMBER_STRING, false)
    ->addColumn('C', 'complelote', 139, 50, Types::STRING, false)
    ->addColumn('C', 'tiprua', 189, 10, Types::STRING, false)
    ->addColumn('C', 'nomrua', 199, 60, Types::STRING, false)
    ->addColumn('C', 'numero', 259, 10, Types::STRING, false)
    ->addColumn('C', 'nombai', 269, 50, Types::STRING, false)
    ->addColumn('C', 'cidade', 319, 60, Types::STRING, false)
    ->addColumn('C', 'excluido', 379, 1, Types::BOOL, false)
    ->addColumn('C', 'datalt', 380, 8, Types::DATE_TIME, array('format' => 'Ymd'))
    ->addColumn('C', 'unifed', 388, 2, Types::STRING)
    ->addColumn('C', 'areatotal', 390, 15, Types::INT_2_DOUBLE)
    ->addColumn('C', 'areautil', 405, 15, Types::INT_2_DOUBLE)
    ->addColumn('C', 'areaprivativa', 420, 15, Types::INT_2_DOUBLE)
    ->addColumn('C', 'areacomum', 435, 15, Types::INT_2_DOUBLE)
    ->addColumn('C', 'areaconstruida', 450, 15, Types::INT_2_DOUBLE)
    ->addColumn('C', 'codcondominio', 465, 10, Types::INT)
    ->addColumn('C', 'condominio', 475, 100, Types::STRING)
    ->addColumn('C', 'tipimo', 575, 1, Types::STRING)
    ->addColumn('C', 'patrimonio', 576, 3, Types::INT)
    ->addColumn('C', 'areaverde', 579, 15, Types::INT_2_DOUBLE)

    ->addColumn('S', 'typReg', 0, 1, Types::STRING, true)
    ->addColumn('S', 'tipins', 1, 2, Types::INT, true)
    ->addColumn('S', 'insmun', 3, 15, Types::INT, true)
    ->addColumn('S', 'cgcm_id', 18, 10, Types::INT, true)
    ->addColumn('S', 'nomraz', 28, 60, Types::STRING, true)
    ->addColumn('S', 'tippessoa', 88, 1, Types::STRING, true)
    ->addColumn('S', 'nomrua', 89, 60, Types::STRING, false)
    ->addColumn('S', 'numero', 149, 10, Types::STRING, false)
    ->addColumn('S', 'comple', 159, 40, Types::STRING, false)
    ->addColumn('S', 'nombai', 199, 60, Types::STRING, false)
    ->addColumn('S', 'cidadeNome', 259, 60, Types::STRING, false)
    ->addColumn('S', 'vinculo', 319, 30, Types::STRING, false)
    ->addColumn('S', 'principal', 349, 1, Types::BOOL, false)
    ->addColumn('S', 'percentual', 350, 10, Types::INT_2_DOUBLE, array('divisor' => 1000))
    ->addColumn('S', 'cpfcgc', 360, 14, Types::NUMBER_STRING, false)
    ->addColumn('S', 'fonres', 374, 14, Types::NUMBER_STRING, false)
    ->addColumn('S', 'foncom', 396, 14, Types::NUMBER_STRING, false)
    ->addColumn('S', 'foncel', 410, 14, Types::NUMBER_STRING, false)
    ->addColumn('S', 'unifed', 424, 2, Types::STRING, false)
    ->addColumn('S', 'rg', 426, 20, Types::STRING, false)
    ->addColumn('S', 'orgemi', 446, 20, Types::STRING, false)
    ->addColumn('S', 'tipvin', 466, 2, Types::INT, false)
//    ->addColumn('S', 'email', 468, 100, Types::EMAIL, false)
    ->addColumn('S', 'email', 468, 100, Types::STRING, false)
    ->addColumn('S', 'tiprua', 568, 5, Types::STRING, false)
;
$result = $ff->exec($file_name);
var_export($result);
