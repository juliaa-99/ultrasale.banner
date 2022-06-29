<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;
//$aMenuLinksExt = $APPLICATION->IncludeComponent(
//    "bitrix:menu.sections",
//    "",
//    Array(
//        "ID" => $_REQUEST["ID"],
//        "IBLOCK_TYPE" => "ultrasale",
//        "IBLOCK_ID" => "11",
//        "SECTION_URL" => "",
//        "DEPTH_LEVEL" => "1",
//        "CACHE_TYPE" => "A",
//        "CACHE_TIME" => "3600"
//    )
//);

$arFilter = Array('IBLOCK_ID'=>19, 'GLOBAL_ACTIVE'=>'Y', "DEPTH_LEVEL" => 1);
$db_list = CIBlockSection::GetList(Array("SORT" => "ASC"), $arFilter, true, ['UF_REDIRECT_URL']);
while($ar_result = $db_list->GetNext())
{
//    dump($ar_result);

    if (!empty($ar_result['UF_REDIRECT_URL'])) $ar_result['SECTION_PAGE_URL'] = $ar_result['UF_REDIRECT_URL'];
    $aMenuLinksExt[] = [$ar_result['NAME'],$ar_result['SECTION_PAGE_URL']];
}

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>
