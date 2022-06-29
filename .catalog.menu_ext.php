<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) { die(); }
/** @var array $aMenuLinks */
//if (!defined('CATALOG_IBLOCK')) {
//    define ('CATALOG_IBLOCK',13);
//}
//\Bitrix\Main\Loader::includeModule('iblock');
//
//$query = \Bitrix\Iblock\SectionTable::getList(array(
//    'select' => array('ID', 'NAME', 'SECTION_PAGE_URL_RAW' => 'IBLOCK.SECTION_PAGE_URL'),
//    'filter' => array('IBLOCK_ID' => CATALOG_IBLOCK,'ACTIVE'=>'Y','DEPTH_LEVEL'=>1),
//    'cache' => array(
//        'ttl' => 600,
//        'cache_joins' => true,
//    ),
//    'order' => array('SORT' => 'ASC'),
//));
//while ($section = $query->fetch()) {
//    if (!empty($section['NAME'])) {
//        $aMenuLinksExt[] = [$section['NAME'],\CIBlock::ReplaceDetailUrl($section['SECTION_PAGE_URL_RAW'], $section, true,
//            'S'),[],[],''];
//    }
//}


$arFilter = Array('IBLOCK_ID'=>13, 'GLOBAL_ACTIVE'=>'Y', "DEPTH_LEVEL" => 1);
$db_list = CIBlockSection::GetList(Array("SORT" => "ASC"), $arFilter, true);
while($ar_result = $db_list->GetNext())
{
//    dump($ar_result);
    $aMenuLinksExt[] = [$ar_result['NAME'],$ar_result['SECTION_PAGE_URL']];
}


$aMenuLinks = $aMenuLinksExt;