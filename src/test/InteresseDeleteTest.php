<?php

use \PDO;
use sarassoroberto\usm\config\local\AppConfig;
use sarassoroberto\usm\model\InteresseModel;
use sarassoroberto\usm\entity\Interesse;
use sarassoroberto\usm\model\DB;

include "./__autoload.php";

$conn;

$conn = new PDO('mysql:dbname='.AppConfig::DB_NAME.';host='.AppConfig::DB_HOST, AppConfig::DB_USER, AppConfig::DB_PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$sql = "DELETE FROM Interesse WHERE InteresseId=6";

$pdostm = $conn->prepare($sql);

$pdostm->execute();

$prova =  $pdostm->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, Interesse::class, ['','']);

print_r($prova);