<?php
global $APPLICATION;
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
use Bitrix\Main\Entity;
use Bitrix\Iblock;
\Bitrix\Main\Loader::includeModule('iblock');


$res = \Bitrix\Iblock\SectionPropertyTable::getList(array('select'=>['PROP_NAME'=>'PROPERTY.NAME','PROP_CODE'=>'PROPERTY.CODE','PROP_ID'=>'PROPERTY.ID'],
                                                          "filter"=>array("=SECTION_ID"=>34)));
$rows = $res->fetchAll();
// TODO Убрать отладку!
echo "<pre>";
echo "==++ 11 ++==<br>";
var_dump($rows);
echo "</pre>";

require ($_SERVER['DOCUMENT_ROOT']. '/bitrix/footer.php');

