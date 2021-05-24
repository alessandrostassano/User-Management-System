<?php
use sarassoroberto\usm\model\InteresseModel;
use sarassoroberto\usm\entity\Interesse;

include "./__autoload.php";

$int= new InteresseModel();
$interesse = new Interesse('', 'Viaggiare');
$int->create($interesse);